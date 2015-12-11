<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/libs/jquery/jquery.js"></script>
        <style>
            #mover{
                background-color: red;
                width: 50px;
                height: 50px;
                position: absolute;
                top:50px;
                left: 50px;
            }
        </style>
    </head>
    <body>
        <p>Poner un cuadrado posicionarlo con css en el medio y moverlo con las flechas</p>
        <p>Cada vez que pulsemos una fecha envia un requete por ajax con las coordenadas</p>
        <p>poner un segundo cuadrado que se mueva desde otra web</p>
        <?php
        // put your code here
        ?>
        <div id="loescrito"></div>
        <div id="mover"></div>
        <script>
            
            function operaEvento(evento){
   $("#loescrito").html($("#loescrito").html() + evento.type + ": " + evento.which + ", ")
}
            posicionTop = 50;
    $(document).ready(function(){
       $(document).keypress(operaEvento);
       $(document).keydown($('#mover').css('top','60'););
       $(document).keyup($('#mover').css('top','40'););
    })

        </script>
    </body>
</html>
