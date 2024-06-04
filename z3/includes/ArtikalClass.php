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
