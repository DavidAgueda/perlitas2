<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_GET['file'])){
    $file = $_GET['file'];
}
    
downloadFile($file);
function downloadFile($fichero ='') {
    $basefichero = basename($fichero);
    header( "Content-Type: application/octet-stream");
    header( "Content-Length: ".filesize($fichero));
    header( "Content-Disposition:attachment;filename=" .$basefichero);
    readfile($fichero);
}


