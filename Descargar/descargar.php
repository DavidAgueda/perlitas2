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
        <?php
        
        ini_set('memory_limit', '-1');
        
        
        download('http://static.forosdelweb.com/customavatars/avatar84545_1.gif', './');
        function download($url, $path) { 
            if ((@$f = fopen($url, 'r')) != false) { 
                fclose($f); 
                $res = join(file($url)); 

                if((@$f = fopen( $path . basename($url), "w" )) != false) {  
                    fwrite($f, $res); 
                    fclose( $f ); 
                }  
            } 
        }  
        ?>
    </body>
</html>
