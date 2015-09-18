<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$file = fopen("archivo.txt", "w");
fwrite($file, 'true');
fclose($file);
$findme = $_GET['findme'];

$resource = 'uploads/temp/';
$file = scandir($resource);

    $resource = 'uploads/temp/';
    $file = scandir($resource);


    for ($i = 0; $i < count($file); $i++) {
        if ($i > 1) {
            if ( strpos($file[$i], $findme)!== false ){
                unlink($resource . $file[$i]);
            }
        }
    }
    