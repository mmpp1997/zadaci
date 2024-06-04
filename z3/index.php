<?php

// Database connection
include 'includes/config/database.php';

include 'includes/service.php';
$artikalService = new ArtikalService();

// Retrieve data from the database
$sql = "SELECT artikal, stanje_na_skladistu, cijena, mjerna_jedinica, potrebno_nabaviti, cijena_u_nabavi, krajnji_rok_nabave FROM tablica_artikala";
$result = $conn->query($sql);

$sql_2 = "SELECT id, artikal FROM tablica_artikala";
$result_2 = $conn->query($sql_2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/styles.css">
  <title>Stanje</title>
</head>

<body>
  <h3>Zadatak 1</h3>
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
  <hr />
  <h3>Zadatak 2</h3>
  <?php
  echo "<h4>Ukupna vrijednost skladista: " . $artikalService->UkupnaVrijednost() . " €</h4>";
  $conn->close();
  ?>
  <hr />
  <h3>Zadatak 3</h3>
  <form action="index.php" method="GET">
    <label for="selectedDate">Odaberi datum :</label>
    <input type="date" id="selectedDate" name="selectedDate">
    <button type="submit">Odabir</button>
  </form>
  <?php
  echo "<h4>Nabava do " . $artikalService->NarudbaDoDatuma()[0] . " u dolarima: " . $artikalService->NarudbaDoDatuma()[1] . " $</h4>";
  ?>
  <hr />
  <h3>Zadatak 4 - Dodaj novi artikal</h3>
  <div class="novi-unos">
    <form action="index.php" method="POST">
      <input type="hidden" name="_method" value="POST">
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
  <hr />
  <h3>Zadatak 5</h3>

  <form action="index.php" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <label for="artikalId">Odaberite artikal:</label>
    <select name="artikalId" id="artikalId">
      <?php
      if ($result_2->num_rows > 0) {
        while ($row = $result_2->fetch_assoc()) {
          $id = $row["id"];
          echo "<option value=$id>" . $row["artikal"] .  "</option>";
        }
      }
      ?>
    </select>
    <label for="novoStanje"> | Novo stanje: </label>
    <input type="input" id="novoStanje" name="novoStanje">
    <input type="submit" value="Izmjeni">
  </form>
  <hr />
</body>
</html>