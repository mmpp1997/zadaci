<?php

$arrayA = ['a', 'b', 'c', 'dd', '234', '22', 'rc'];
$arrayB = ['a', 'b2', 'c', 'dad', 'rc', '24', '222'];
$arrayC = ['222', 'a', 'be', 'rc', 'dd', '234', '22', 'pp'];

echo "U sva tri niza: [" . implode(",", array_intersect($arrayA, $arrayB, $arrayC)) . "]\n";

echo "Samo u nizu \$arrayA = [" . implode(',', array_diff($arrayA, $arrayB, $arrayC)) . "]\n";
echo "Samo u nizu \$arrayB = [" . implode(',', array_diff($arrayB, $arrayA, $arrayC)) . "]\n";
echo "Samo u nizu \$arrayC = [" . implode(',', array_diff($arrayC, $arrayA, $arrayB)) . "]\n";
