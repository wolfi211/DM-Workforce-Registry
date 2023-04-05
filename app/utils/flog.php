<?php

function flog($msg)
{
  $filename = "../logs/" . date("Y-m-d") . ".log";
  $head = date("H:i :: ");
  $msg = $msg . "\n";

  if ($file = fopen($filename, 'a')) {
    fwrite($file, $head . $msg);
    fclose($file);
  }
}
