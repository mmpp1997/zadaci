<?php
class Predracun {
    public $broj;
    public $oznaka;
    public $datumPocetka;
    public $datumZavrsetka;
    public $brojOsoba;
    public $cijena;
    public $akontacija;
    public $ostatak;

    public function __construct($broj, $oznaka, $datumPocetka, $datumZavrsetka, $brojOsoba, $cijena, $akontacija,$ostatak) {
        $this->broj = $broj;
        $this->oznaka = $oznaka;
        $this->datumPocetka = $datumPocetka;
        $this->datumZavrsetka = $datumZavrsetka;
        $this->brojOsoba = $brojOsoba;
        $this->cijena = $cijena;
        $this->akontacija = $akontacija;
        $this->ostatak = $ostatak;
    }
}

class DinamikaPlacanja {
    public $uplata;
    public $nacinPlacanja;
    public $iznos;

    public function __construct($uplata, $nacinPlacanja, $iznos) {
        $this->uplata = $uplata;
        $this->nacinPlacanja = $nacinPlacanja;
        $this->iznos = $iznos;
    }
}

// Create an instance of Predracun
$predracun = new Predracun(
    "2022-16950-63",
    "AS-16850-a",
    "08.08.2022",
    "15.08.2022",
    "2",
    "104.48 €",
    new DinamikaPlacanja(
        "Akontacija",
        "Kreditnom karticom (Visa, EC/MC, Maestro)",
        "364.00 €"
    ),
    new DinamikaPlacanja(
        "Ostatak iznosa",
        "Kreditnom karticom (Visa, EC/MC, Maestro)",
        ""
    )
);
