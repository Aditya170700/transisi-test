<?php

function countLowerSolution(string $str)
{
  $count = 0;

  for ($i = 0; $i < strlen($str); $i++) {
    if ($str[$i] >= 'a' && $str[$i] <= 'z') {
      $count++;
    }
  }

  return "{$str} mengandung {$count} huruf kecil";
}

var_dump(countLowerSolution('TranSISI'));
