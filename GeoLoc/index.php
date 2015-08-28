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
    </head>
    <body>
        
        <form method="get">
            <input name ="direccion" type="text">
            <input type="submit" title="buscar" value="Buscar">
        </form>
        
        
        
        <?php
        
        if(isset($_GET['direccion'])){
            echo  $_GET['direccion'];
            $direccion =  $_GET['direccion'];
            $direccion = trim($direccion);
            $direccion = str_replace(' ', '%20', $direccion);
            
            $contenido = file_get_contents("http://api-adresse.data.gouv.fr/search/?q=$direccion&autocomplete=0&limit=15");
        }else{
            $contenido = file_get_contents("http://api-adresse.data.gouv.fr/search/?q=8%20bd%20du%20port&postcode=44380");
        }
            
            
            
        
        $ContenidoNojson =json_decode($contenido);
//        var_dump($ContenidoNojson);
        
        $aAdress = $ContenidoNojson->features;
//        var_dump($aAdress);
        
        foreach ($aAdress as $value) {
            echo ("<p> ".$value->properties->label." <p>");
//            var_dump($value->geometry->coordinates);
            ?>
                    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo "http://www.openstreetmap.org/export/embed.html?bbox=". $value->geometry->coordinates[0] ."%2C". $value->geometry->coordinates[1] ."%2C". $value->geometry->coordinates[0] ."%2C". $value->geometry->coordinates[1] ."&amp;layer=mapnik"?>" style="border: 1px solid black"></iframe><br/><small><a href="http://www.openstreetmap.org/#map=19/47.25899/-2.34096">Ver mapa más grande</a></small>
<!--                    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=0.6923478841781616%2C47.40352697926442%2C0.6941932439804077%2C47.40678007792241&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="http://www.openstreetmap.org/#map=18/47.40515/0.69327">Ver mapa más grande</a></small>-->
<!--                    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo "http://www.openstreetmap.org/export/embed.html?bbox=". $value->geometry->coordinates[0] ."%2C". $value->geometry->coordinates[1] ."%2C0.6941932439804077%2C47.40678007792241&amp;layer=mapnik" ?>" style="border: 1px solid black"></iframe><br/><small><a href="http://www.openstreetmap.org/#map=18/47.40515/0.69327">Ver mapa más grande</a></small>-->
        
            <?php
        }
        
        ?>

        
        <footer>Licencia: CC-BY-SA-2.0 © Contribuidores de OpenStreetMap</footer>
    </body>
</html>
