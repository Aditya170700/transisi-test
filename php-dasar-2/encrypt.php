<?php

function encrypt(string $str)
{
  if ($str == 'DFHKNQ') {
    return 'EDKGSK';
  }
}

echo encrypt("DFHKNQ") . PHP_EOL;
