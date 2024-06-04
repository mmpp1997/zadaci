<?php
// Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "artikli";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Greška pri spajanju sa bazom: " . $conn->connect_error);
}
