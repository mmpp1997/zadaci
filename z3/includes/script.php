<?php
class Artikal
{
    public $artikal;
    public $stanjeNaSkladistu;
    public $cijena;
    public $mjernaJedinica;
    public $potrebnoNabaviti;
    public $cijenaUNabavi;
    public $krajnjiRokNabave;

    public function __construct($artikal, $stanjeNaSkladistu, $cijena, $mjernaJedinica, $potrebnoNabaviti, $cijenaUNabavi, $krajnjiRokNabave)
    {
        $this->artikal = $artikal;
        $this->stanjeNaSkladistu = $stanjeNaSkladistu;
        $this->cijena = $cijena;
        $this->mjernaJedinica = $mjernaJedinica;
        $this->potrebnoNabaviti = $potrebnoNabaviti;
        $this->cijenaUNabavi = $cijenaUNabavi;
        $this->krajnjiRokNabave = $krajnjiRokNabave;
    }
}

$artikli = [
    new Artikal("paprika", 1225.25, 0.89, "kg", null, null, null),
    new Artikal("krumpir crveni", 600, 0.57, "kg", 3000, 0.35, "2024-08-24"),
    new Artikal("krumpir žuti", 0, null, "kg", 1200, 0.48, "2024-06-12"),
    new Artikal("krumpir mladi", 260.83, 0.94, "kg", 6500, 0.50, "2024-04-15"),
    new Artikal("žarulja 20W", 250, 2.74, "komad", 300, 1.25, "2024-04-20"),
];

// Database connection
include 'includes/config/database.php';

$create = "CREATE TABLE tablica_artikala (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artikal VARCHAR(255) NOT NULL,
    stanje_na_skladistu DECIMAL(10, 2) NOT NULL,
    cijena DECIMAL(10, 2),
    mjerna_jedinica VARCHAR(255),
    potrebno_nabaviti INT,
    cijena_u_nabavi DECIMAL(10, 2),
    krajnji_rok_nabave DATE
);";
$conn->query($create);

$stmt = $conn->prepare("INSERT INTO tablica_artikala (artikal, stanje_na_skladistu, cijena, mjerna_jedinica, potrebno_nabaviti, cijena_u_nabavi, krajnji_rok_nabave) 
VALUES (?, ?, ?, ?, ?, ?, ?)");

foreach ($artikli as $artikal) {
    $stmt->bind_param(
        "sddsdds",
        $artikal->artikal,
        $artikal->stanjeNaSkladistu,
        $artikal->cijena,
        $artikal->mjernaJedinica,
        $artikal->potrebnoNabaviti,
        $artikal->cijenaUNabavi,
        $artikal->krajnjiRokNabave
    );
    $stmt->execute();
}

$stmt->close();
$conn->close();
