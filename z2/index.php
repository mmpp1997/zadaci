<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css">
  <title>Predračun</title>
</head>

<body>
  <?php
  include 'classes.php';
  $pocetak = new DateTime($predracun->datumPocetka);
  $kraj = new DateTime($predracun->datumZavrsetka);
  $kolicina = $pocetak->diff($kraj)->d;
  $ukupno = $kolicina * floatval($predracun->cijena);
  ?>
  <div class="page">
    <h3>PREDRAČUN BR. <?php echo $predracun->broj; ?> ZA USLUGU SMJEŠTAJA</h3>
    <table>
      <tr>
        <th colspan="3">Usluga</th>
        <th>Cijena</th>
        <th>Količina</th>
        <th>Ukupno</th>
      </tr>
      <tr>
        <td><?php echo $predracun->oznaka; ?></td>
        <td><?php echo $predracun->datumPocetka . " - " . $predracun->datumZavrsetka; ?></td>
        <td><?php echo $predracun->brojOsoba; ?> (osobe)</td>
        <td><?php echo $predracun->cijena; ?></td>
        <td><?php echo $kolicina; ?> (noćenja)</td>
        <td><?php echo $ukupno; ?> €</td>
      </tr>
      <tr>
        <td colspan="6"> </td>
      </tr>
      <tr style="background-color: rgba(129,191,237,255);">
        <td colspan="5" style="text-align: left;">Ukupno</td>
        <td style="font-weight: 800;"><?php echo $ukupno; ?> €</td>
      </tr>
    </table>
    <p>Uključeno u cijenu (bez dodatne naplate): turistička pristojba</p>
    <h3>DINAMIKA PLAĆANJA</h3>
    <table>
      <tr>
        <th>Uplata</th>
        <th>Način plačanja</th>
        <th>Vrijeme plačanja</th>
        <th>Iznos</th>
      </tr>
      <tr>
        <td style='font-weight: 800;'><?php echo $predracun->akontacija->uplata ?></td>
        <td><?php echo $predracun->akontacija->nacinPlacanja ?></td>
        <td><?php echo $predracun->datumPocetka ?> do 11:00</td>
        <td style='font-weight: 800;'><?php echo $predracun->akontacija->iznos ?></td>
      </tr>
      <tr>
        <td style='font-weight: 800;'><?php echo $predracun->ostatak->uplata ?></td>
        <td><?php echo $predracun->ostatak->nacinPlacanja ?></td>
        <td><?php echo $predracun->datumPocetka ?> do 15:00</td>
        <td style='font-weight: 800;'><?php echo $ukupno-(float)$predracun->akontacija->iznos?> €</td>
      </tr> 
    </table>
    <p>Uplatom akontacije gost potvrđuje da je upoznat te se slaže s Općim uvjetima pružanja usluga smještaja u privatnim kapacitetima</p>
  </div>
</body>

</html>