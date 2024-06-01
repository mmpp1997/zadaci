<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "artikli";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
          echo "<td></td>";
        }
        if ($row["potrebno_nabaviti"] !== null) {
          echo "<td>" . $row["potrebno_nabaviti"] . " " . $row["mjerna_jedinica"] . "</td>";
        } else {
          echo "<td></td>";
        }
        if ($row["cijena_u_nabavi"] !== null) {
          echo "<td>" . $row["cijena_u_nabavi"] . " €/" . $row["mjerna_jedinica"] . "</td>";
        } else {
          echo "<td></td>";
        }
        echo "<td>" . $row["krajnji_rok_nabave"] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='7'>Nema podataka</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>

</html>