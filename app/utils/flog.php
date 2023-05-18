<?php

function flog($msg)
{
  $filename = "/var/www/html/logs/" . date("Y-m-d") . ".log";
  $head = date("H:i :: ");
  $msg = $msg . "\n";

  if ($file = fopen($filename, 'a')) {
    fwrite($file, $head . $msg);
    fclose($file);
  }
}
