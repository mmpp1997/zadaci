<?php

class ArtikalService
{
    public function UkupnaVrijednost()
    {
        include "database.php";

        $sql = "SELECT stanje_na_skladistu, cijena FROM tablica_artikala";
        $result = $conn->query($sql);

        $sum = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["stanje_na_skladistu"] * $row["cijena"];
            }
        }

        return number_format($sum, 2);
    }

    public function NarudbaDoDatuma()
    {
        if (isset($_GET['selectedDate'])) {
            $selectedDate = $_GET['selectedDate'];
        } else {
            $selectedDate = '2024-04-15';
        }
        $selectedDate = htmlspecialchars($selectedDate);

        include "database.php";

        $sql = "SELECT potrebno_nabaviti, cijena_u_nabavi FROM tablica_artikala WHERE krajnji_rok_nabave <= '$selectedDate';";
        $result = $conn->query($sql);

        $sum = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["potrebno_nabaviti"] * $row["cijena_u_nabavi"];
            }
        }

        return [$selectedDate, number_format($sum * 1.03, 2)];
    }
    public function NoviUnos()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include "database.php";
            // Get input values from the form
            $noviArtikal = $_POST['noviArtikal'];
            $stanje = $_POST['stanje'];
            $cijena = $_POST['cijena'];
            $mjernaJedinica = $_POST['mjernaJedinica'];
            $potrebnoNabaviti = $_POST['potrebnoNabaviti'];
            $cijenaUNabavi = $_POST['cijenaUNabavi'];
            $krajnjiRok = $_POST['krajnjiRok'];

            

            $sql = "INSERT INTO tablica_artikala (artikal, stanje_na_skladistu, cijena, mjerna_jedinica, potrebno_nabaviti, cijena_u_nabavi, krajnji_rok_nabave) 
                VALUES ('$noviArtikal', '$stanje', '$cijena','$mjernaJedinica', '$potrebnoNabaviti', '$cijenaUNabavi', '$krajnjiRok')";
            
            $conn->query($sql);
            $conn->close();
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance of ArtikalService
    $service = new ArtikalService();
    // Call the NoviUnos method
    $service->NoviUnos();
}

