<?php

function tableSolution(int $number)
{
  $row = sqrt($number);
  $white = 1;
  $result = '';

  for ($r = 0; $r < $row; $r++) {
    $result .= '<tr>';
    for ($c = 0; $c < $row; $c++) {
      if ($white % 3 == 0 || $white % 4 == 0) {
        $result .= '<td>' . $white++ . '</td>';
      } else {
        $result .= '<td style="background-color: black; color: white;">' . $white++ . '</td>';
      }
    }
    $result .= '</tr>';
  }

  return $result;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table Black White</title>
</head>

<body>
  <table>
    <tbody>
      <?= tableSolution(64); ?>
    </tbody>
  </table>
</body>

</html>