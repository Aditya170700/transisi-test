<?php

function avgMaxMinSolution(string $str)
{
  // make array
  $array = explode(' ', $str);

  // count avg
  $avg = array_sum($array) / count($array);

  // sort desc, get 7 item
  rsort($array);
  $max = array_splice($array, 0, 7);

  // sort acs, get 7 item
  sort($array);
  $min = array_splice($array, 0, 7);

  return [
    'avg' => $avg,
    'max' => $max,
    'min' => $min,
  ];
}

var_dump(avgMaxMinSolution('72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86'));
