<?php

function checkElement($element, $array)
{
  foreach ($array as $value) {
    if ($element == $value) {
      return true;
    }
  }
  return false;
}

function intersect($firstArray, $secondArray, $thirdArray)
{
  $common = [];

  foreach ($firstArray as $element) {
    if (checkElement($element, $secondArray) && checkElement($element, $thirdArray)) {
      $common[] = $element;
    }
  }

  return $common;
}

function differance($firstArray, $secondArray, $thirdArray)
{
  $onlyInFirst = [];

  foreach ($firstArray as $element) {
    if (!checkElement($element, $secondArray) && !checkElement($element, $thirdArray)) {
      $onlyInFirst[] = $element;
    }
  }
  
  return $onlyInFirst;
}


$arrayA = ['a', 'b', 'c', 'dd', '234', '22', 'rc'];
$arrayB = ['a', 'b2', 'c', 'dad', 'rc', '24', '222'];
$arrayC = ['222', 'a', 'be', 'rc', 'dd', '234', '22', 'pp'];

echo "U sva tri niza: [" . implode(",", intersect($arrayA, $arrayB, $arrayC)) . "]\n";


echo "Samo u nizu \$arrayA = [" . implode(',', differance($arrayA, $arrayB, $arrayC)) . "]\n";
echo "Samo u nizu \$arrayB = [" . implode(',', differance($arrayB, $arrayA, $arrayC)) . "]\n";
echo "Samo u nizu \$arrayC = [" . implode(',', differance($arrayC, $arrayA, $arrayB)) . "]\n";
