<?php

function intersect($arrayA, $arrayB, $arrayC)
{
  $common = [];
  for ($i = 0; $i < count($arrayA); $i++) {

    $flagB = false;
    for ($j = 0; $j < count($arrayB); $j++) {
      if ($arrayA[$i] == $arrayB[$j]) {
        $flagB = true;
        break;
      }
    }
    if ($flagB != false) {
      $flagC = false;
      for ($k = 0; $k < count($arrayC); $k++) {
        if ($arrayA[$i] == $arrayC[$k]) {
          $flagC = true;
          break;
        }
      }
    }

    if ($flagB  && $flagC) {
      $common[] = $arrayA[$i];
    }
    $flagB = $flagB = false;
  }
  return $common;
}

function differance($firstArray, $seccondArray, $thirdArray)
{
  $onlyInfirst = [];
  for ($i = 0; $i < count($firstArray); $i++) {

    $flagB = true;
    for ($j = 0; $j < count($seccondArray); $j++) {
      if ($firstArray[$i] == $seccondArray[$j]) {
        $flagB = false;
        break;
      }
    }
    if ($flagB != false) {
      $flagC = true;
      for ($k = 0; $k < count($thirdArray); $k++) {
        if ($firstArray[$i] == $thirdArray[$k]) {
          $flagC = false;
          break;
        }
      }
    }

    if ($flagB  && $flagC) {
      $onlyInfirst[] = $firstArray[$i];
    }
  }
  return $onlyInfirst;
}


$arrayA = ['a', 'b', 'c', 'dd', '234', '22', 'rc'];
$arrayB = ['a', 'b2', 'c', 'dad', 'rc', '24', '222'];
$arrayC = ['222', 'a', 'be', 'rc', 'dd', '234', '22', 'pp'];

echo "U sva tri niza: [" . implode(",", intersect($arrayA, $arrayB, $arrayC)) . "]\n";


echo "Samo u nizu \$arrayA = [" . implode(',', differance($arrayA, $arrayB, $arrayC)) . "]\n";
echo "Samo u nizu \$arrayB = [" . implode(',', differance($arrayB, $arrayA, $arrayC)) . "]\n";
echo "Samo u nizu \$arrayC = [" . implode(',', differance($arrayC, $arrayA, $arrayB)) . "]\n";
