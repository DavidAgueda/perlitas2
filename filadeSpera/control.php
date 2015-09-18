<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo $data;


$file = fopen("archivo.txt", "r");

while(!feof($file)) {

$control = fgets($file);

}

fclose($file);
//
echo $control;
if($control == 'true'){
    echo '<h3>start</h3>';
     ob_flush();
        flush();
    $estado = 'false';
    guardarEstado($estado);
    
    echo proceso($_POST["nombre"]);
    
     echo '<h3>end</h3>';

    
}else{
    echo '<h3>stop</h3>';

}


function proceso($txt=''){
//    sleep(10);

//    return '/////__ '. $txt . '___\\\\';
    
    for ($i = 0; $i<10; $i++){

        echo "<br> Line to show.";
        echo str_pad('',4096)."\n";   

        ob_flush();
        flush();
        sleep(1);
            guardarEstado('true');
}
}


function guardarEstado($estado){
    
    $file = fopen("archivo.txt", "w");

    fwrite($file, $estado);

    fclose($file);
}
?>
