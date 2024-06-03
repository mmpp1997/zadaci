<?php
//url
$url = "private_url";
//potrebna sifra
$pass = file_get_contents($url);

if ($pass === FALSE) {
    die("Error getting a pass");
}
//potpuni url sa "pass"
$downloadUrl = $url . "&pass=" . urlencode($pass);

//dohvacanje datoteke i spremanje
$file = file_get_contents($downloadUrl);

if ($file === FALSE) {
    die("Error getting the file.");
}

$filePath = 'zadatak.odt';
file_put_contents($filePath, $file);
