<?php

function searchSolution(array $array, string $string)
{
  $str = str_split($string);

  // cek string in array
  for ($i = 0; $i < count($str); $i++) {
    for ($n = 0; $n < count($array); $n++) {
      if (!in_array($str[$i], $array[$n])) {
        if ($array[$n] == end($array)) {
          return false;
        }
      } else {
        break;
      }
    }
  }

  // cek huruf duplikat (fghh)
  if ($str != array_unique($str)) {
    return false;
    die();
  }

  // cek huruf berurutan (fghi)
  for ($i = 0; $i < count($array); $i++) {
    if ($str == $array[$i]) {
      return true;
      die();
    }
  }

  // jika ada identifikasi indexnya dan push ke array untuk statement kondisi
  $arrayMatch = [];
  for ($i = 0; $i < count($str); $i++) {
    for ($n = 0; $n < count($array); $n++) {
      if (array_search($str[$i], $array[$n]) > -1)

        array_push($arrayMatch, [$n, array_search($str[$i], $array[$n])]);
    }
  }

  /**
   * index pertama tidak boleh urut seperti [0][0], [1][1], [2][2]
   * index kedua sebelum terakhir harus sama dengan index sebelumnya
   * index kedua urut dan index pertama sama
   * jika index kedua tidak urut maka index pertama harus beda dan dan index kedua harus sama dengan sebelumnya
   * index pertama tidak boleh urut dan index kedua harus sama
   * index pertama urut/beda maka index kedua harus sama dari index kedua sebelumnya
   */

  for ($i = 0; $i < count($arrayMatch); $i++) {

    $cur = current($arrayMatch[$i]);

    if ($i < count($arrayMatch) && $i != 0) {

      $op = current($arrayMatch[$i - 1]);

      if ($cur != $op) {
        $opEnd = end($arrayMatch[$i - 1]);
        $curEnd = end($arrayMatch[$i]);

        if ($cur != $op && $opEnd != $curEnd) {
          return false;
          break;
        } else {
          return true;
          break;
        }
      }
    }
  }
}

$arr = [
  ['f', 'g', 'h', 'i'],
  ['j', 'k', 'p', 'q'],
  ['r', 's', 't', 'u']
];

var_dump(searchSolution($arr, 'fghi')); // true
var_dump(searchSolution($arr, 'fghp')); // true
var_dump(searchSolution($arr, 'fjrstp')); // true
var_dump(searchSolution($arr, 'fghq')); // false
var_dump(searchSolution($arr, 'fst')); // false
var_dump(searchSolution($arr, 'pqr')); // false
var_dump(searchSolution($arr, 'fghh')); // false
