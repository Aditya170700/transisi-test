<?php

function ubtGramSolution(string $str)
{
  $str = strtolower($str);
  $array = explode(' ', $str);
  $lenArray = count($array);
  $u = '';
  $b = '';
  $t = '';

  foreach ($array as $key => $arr) {
    // unigram
    $u .= $arr . ($key < ($lenArray - 1) ? ', ' : '');

    // bigram
    if (($key + 1) % 2 == 0) {
      $b .= $arr . ($key < ($lenArray - 1) ? ', ' : '');
    } else {
      $b .= "{$arr} ";
    }

    // trigram
    if (($key + 1) % 3 == 0) {
      $t .= $arr . ($key < ($lenArray - 1) ? ', ' : '');
    } else {
      $t .= "{$arr} ";
    }
  }

  return "Unigram : {$u}" . PHP_EOL
    . "Bigram : {$b}" . PHP_EOL
    . "Trigram : {$t}" . PHP_EOL;
}

echo ubtGramSolution('Jakarta adalah ibukota negara Republik Indonesia');
