<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var_dump($_POST);

$background_color = '#fff';
$H1title = '';

if(isset($_POST['background-color'])){
    $background_color = $_POST['background-color'];
}
if(isset($_POST['H1Load'])){
    $H1title = $_POST['H1Load'];
}

$js='
$().ready(function(){

    // cambiar estos datos por valores por defecto
    if (typeof (Storage) !== "undefined") {
        if (localStorage.color == "undefined") {
            localStorage.setItem("color", "#FFF");
        }
        if (localStorage.inicio == "undefined") {
            localStorage.setItem("inicio", "el mio");
        }
    } else {
        console.log("no storage");
    }
    
    localStorage.colorload = "'.$background_color.'";
    localStorage.H1tile = "'.$H1title.'";

    $("body").css("background-color",localStorage.colorload);
    $("h1").html(localStorage.H1tile);
});

    ';

fileJavascript($js);

function fileJavascript($data) {
    if (($file = fopen('../resultat/js/generado.js', "w+")) != false) {
        fwrite($file, $data);
        fclose($file);
    }
}



////tomo el valor de un elemento de tipo texto del formulario 
//$cadenatexto = $_POST["cadenatexto"]; 
//echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>"; 

//datos del arhivo 
$nombre_archivo = $_FILES['userfile']['name']; 
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 100000))) { 
   	echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>"; 
}else{ 
   	if (move_uploaded_file($_FILES['userfile']['tmp_name'], '../resultat/img/splash.png')){ 
      	echo "El archivo ha sido cargado correctamente."; 
   	}else{ 
      	echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
   	} 
} 