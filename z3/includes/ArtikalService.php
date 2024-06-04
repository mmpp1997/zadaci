<?php

class ArtikalService
{
    public function UkupnaVrijednost()
    {
        require 'config/database.php';

        $sql = "SELECT stanje_na_skladistu, cijena FROM tablica_artikala";
        $result = $conn->query($sql);

        $sum = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["stanje_na_skladistu"] * $row["cijena"];
            }
        }

        $conn->close();
        return number_format($sum, 2);
    }

    public function NarudbaDoDatuma()
    {
        if (isset($_GET['odabraniDatum'])) {
            $odabraniDatum = $_GET['odabraniDatum'];
        } else {
            $odabraniDatum = date("Y/m/d");
        }
        $odabraniDatum = htmlspecialchars($odabraniDatum);

        require 'config/database.php';

        $sql = "SELECT potrebno_nabaviti, cijena_u_nabavi FROM tablica_artikala WHERE krajnji_rok_nabave <= '$odabraniDatum';";
        $result = $conn->query($sql);

        $sum = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["potrebno_nabaviti"] * $row["cijena_u_nabavi"];
            }
        }

        $conn->close();
        return [$odabraniDatum, number_format($sum * 1.03, 2)];
    }
    public function NoviUnos()
    {
        if (isset($_POST['noviArtikal']) && ($_POST['noviArtikal']) != "") {

            $noviArtikal = htmlspecialchars($_POST['noviArtikal']);
            $stanje = htmlspecialchars($_POST['stanje']);
            $cijena = htmlspecialchars($_POST['cijena']);
            $mjernaJedinica = htmlspecialchars($_POST['mjernaJedinica']);
            $potrebnoNabaviti = htmlspecialchars($_POST['potrebnoNabaviti']);
            $cijenaUNabavi = htmlspecialchars($_POST['cijenaUNabavi']);
            $krajnjiRok = htmlspecialchars($_POST['krajnjiRok']);

            try {
                require 'config/database.php';

                $sql = "INSERT INTO tablica_artikala (artikal, stanje_na_skladistu, cijena, mjerna_jedinica, potrebno_nabaviti, cijena_u_nabavi, krajnji_rok_nabave) 
                VALUES ('$noviArtikal', '$stanje', '$cijena','$mjernaJedinica', '$potrebnoNabaviti', '$cijenaUNabavi', '$krajnjiRok')";

                $conn->query($sql);
                $conn->close();
            } catch (mysqli_sql_exception $error) {
                die("Greška: " . $error);
            }
        } else {
            die("Molimo unesite naziv artikla");
        }
    }
    public function IzmjeniStanje()
    {
        if (isset($_POST['novoStanje']) && is_numeric($_POST['novoStanje'])) {

            $artikalId = $_POST['artikalId'];
            $novoStanje = $_POST['novoStanje'];

            try {
                require 'config/database.php';
                $sql = "UPDATE tablica_artikala SET stanje_na_skladistu = $novoStanje WHERE id=$artikalId;";
                $conn->query($sql);
                $conn->close();
            } catch (mysqli_sql_exception $error) {
                die("Greška: " . $error);
            }

        } else {
            die("Molimo unesite novo stanje artikla");
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['_method']) && $_POST['_method'] === 'POST') {
    $service = new ArtikalService();
    $service->NoviUnos();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    $service = new ArtikalService();
    $service->IzmjeniStanje();
}
