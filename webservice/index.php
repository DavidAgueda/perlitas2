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
        <form action="" method="GET">
            <input type="text" name="url">
            <input type="submit" name="enviar">
        </form>
        <?php
        header('Content-type: text/html; charset=UTF-8');
        require_once('./nusoap-0.9.5/lib/nusoap.php');
        $cliente = new nusoap_client('http://localhost/projets/Perlitas/webservice/test.php/');
//        $resultado = $cliente->call('calculadora', array('x' => '3', 'y' => 4, 'operacion' => 'multiplica'));
//        $resultado1 = $cliente->call('TestURL', array('url' => 'http://www.comocreartuweb.com/curso-de-html/estructura-semantica-html5/ejemplos-de-codigo.html'));
//        echo $resultado;
//        echo '<pre>';
//        var_dump ($resultado1);
//        echo '</pre>';
        
        
        if (isset($_GET['url'])){
            echo '---'.$_GET['url'].'---';
            $resultado1 = $cliente->call('TestURL', array('url' => $_GET['url']));
            var_dump ($resultado1);
        }
        
//        var_dump(file_get_contents('http://validator.w3.org/nu/?doc=http://www.w3schools.com'));
//        var_dump(file_get_contents('https://validator.w3.org/check?uri=https://example.com/&output=json'));
//        var_dump(json_decode (file_get_contents('https://validator.w3.org/check?uri=http://www.w3schools.com/&output=json')));
        ?>
    </body>
</html>
