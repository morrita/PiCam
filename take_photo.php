<?php

    $width = $_GET[width];
    $height = $_GET[height];

    $basename = '/var/www/html';
    $filename = '/img/testfile'  . date('m-d-Y_H:i:s') . w . $width . h . $height . '.jpg';

    $command = "/usr/bin/raspistill -w " .  $width . " -h " .  $height . " -o " . $basename . $filename;
    system("$command");

    echo $filename;

?>
