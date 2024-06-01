<?php

// Database connection
include "database.php";

include 'service.php';
$artikalService = new ArtikalService();

// Retrieve data from the database
$sql = "SELECT artikal, stanje_na_skladistu, cijena, mjerna_jedinica, potrebno_nabaviti, cijena_u_nabavi, krajnji_rok_nabave FROM tablica_artikala";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Stanje</title>
</head>

<body>
  <table>
    <tr>
      <th>Artikal</th>
      <th>Stanje na Skladištu</th>
      <th>Cijena</th>
      <th>Potrebno Nabaviti</th>
      <th>Cijena u Nabavi</th>
      <th>Krajnji Rok Nabave</th>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["artikal"] . "</td>";
        echo "<td>" . $row["stanje_na_skladistu"] . " " . $row["mjerna_jedinica"] . "</td>";
        if ($row["cijena"] !== null) {
          echo "<td>" . $row["cijena"] . " €/" . $row["mjerna_jedinica"] . "</td>";
        } else {
          echo "<td style='text-align: center;'>-</td>";
        }
        if ($row["potrebno_nabaviti"] !== null) {
          echo "<td>" . $row["potrebno_nabaviti"] . " " . $row["mjerna_jedinica"] . "</td>";
        } else {
          echo "<td style='text-align: center;'>-</td>";
        }
        if ($row["cijena_u_nabavi"] !== null) {
          echo "<td>" . $row["cijena_u_nabavi"] . " €/" . $row["mjerna_jedinica"] . "</td>";
        } else {
          echo "<td style='text-align: center;'>-</td>";
        }
        if ($row["krajnji_rok_nabave"] !== null) {
          echo "<td>" . $row["krajnji_rok_nabave"] . "</td>";
        } else {
          echo "<td style='text-align: center;'>-</td>";
        }
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>Nema podataka</td></tr>";
    }
    ?>
  </table>
  <form action="index.php" method="GET">
    <label for="selectedDate">Odaberi datum :</label>
    <input type="date" id="selectedDate" name="selectedDate">
    <button type="submit">Odabir</button>
  </form>
  <div class="novi-unos">
    <h2>dodaj novi artikal</h2>
    <form action="index.php" method="POST">

      <label for="noviArtikal">Novi artikal:</label>
      <input type="input" id="noviArtikal" name="noviArtikal">

      <label for="stanje">Stanje:</label>
      <input type="input" id="stanje" name="stanje">

      <label for="mjernaJedinica">Mjerna jedinica:</label>
      <input type="input" id="mjernaJedinica" name="mjernaJedinica">

      <label for="cijena">Cijena:</label>
      <input type="input" id="cijena" name="cijena">

      <label for="cijena">Potrebno Nabaviti:</label>
      <input type="potrebnoNabaviti" id="potrebnoNabaviti" name="potrebnoNabaviti">

      <label for="cijenaUNabavi">Cijena U Nabavi:</label>
      <input type="input" id="cijenaUNabavi" name="cijenaUNabavi">

      <label for="krajnjiRok">Krajnji Rok :</label>
      <input type="date" id="krajnjiRok" name="krajnjiRok">

      <button type="submit">Odabir</button>
    </form>
  </div>
  <?php
  echo "<h2>Ukupna vrijednost skladista: " . $artikalService->UkupnaVrijednost() . " €</h2>";
  echo "<h2>Nabava do " . $artikalService->NarudbaDoDatuma()[0] . " u dolarima: " . $artikalService->NarudbaDoDatuma()[1] . " $</h2>";
  $conn->close();
  ?>
</body>

</html>