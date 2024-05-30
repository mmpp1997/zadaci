<?php

function find($arrayA, $arrayB, $arrayC) {

  $common = array_intersect($arrayA, $arrayB, $arrayC);

  $uniqueA= array_diff($arrayA, $arrayB, $arrayC);
  $uniqueB= array_diff($arrayB, $arrayA, $arrayC);
  $uniqueC= array_diff($arrayC, $arrayA, $arrayB);

  echo "U sva tri niza: [" . implode(",", $common) . "]\n";

  echo "Samo u nizu \$arrayA = [" . implode(',', $uniqueA) . "]\n";
  echo "Samo u nizu \$arrayB = [" . implode(',', $uniqueB) . "]\n";
  echo "Samo u nizu \$arrayC = [" . implode(',', $uniqueC) . "]\n";
}

$arrayA = ['a', 'b', 'c', 'dd', '234', '22', 'rc'];
$arrayB = ['a', 'b2', 'c', 'dad', 'rc', '24', '222'];
$arrayC = ['222', 'a', 'be', 'rc', 'dd', '234', '22', 'pp'];

find($arrayA, $arrayB, $arrayC);

?> 