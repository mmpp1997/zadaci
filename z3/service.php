<?php

class ArtikalService
{
    public function UkupnaVrijednost()
    {
        include 'database.php';

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
        }
        else{
            $selectedDate='2024-04-15';
        }
        $selectedDate = htmlspecialchars($selectedDate);

        include 'database.php';

        $sql = "SELECT potrebno_nabaviti, cijena_u_nabavi FROM tablica_artikala WHERE krajnji_rok_nabave <= '$selectedDate';";
        $result = $conn->query($sql);

        $sum = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sum += $row["potrebno_nabaviti"] * $row["cijena_u_nabavi"];
            }
        }

        return [$selectedDate,number_format($sum*1.03, 2)];
    }
}
