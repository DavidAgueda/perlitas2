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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!--Plugin para usar web service soap-->
        <script src="jquery.soap.js"></script>
    </head>
    <body>
        <p>Escribir un url</p>
        <form action="" method="GET">
            <input type="text" name="url">
            <input type="submit" name="enviar">
        </form>
        <button onclick="AjaxCall()">ajax</button>
        <div id="toto"></div>
            
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


        if (isset($_GET['url'])) {
            echo '---' . $_GET['url'] . '---';
            $resultado1 = $cliente->call('TestURL', array('url' => $_GET['url']));
            var_dump($resultado1);
        }

//        var_dump(file_get_contents('http://validator.w3.org/nu/?doc=http://www.w3schools.com'));
//        var_dump(file_get_contents('https://validator.w3.org/check?uri=https://example.com/&output=json'));
//        var_dump(json_decode (file_get_contents('https://validator.w3.org/check?uri=http://www.w3schools.com/&output=json')));
        ?>

        <script>
//            function AjaxCall() {
//                $.ajax({
//                    type: "POST",
////                    url: "test.php?TestURL",
//                    url: "test.php",
////                    data: "{'method': 'estURL', 'url' : 'http://www.comocreartuweb.com/'}",
//                    data: "{'url' : 'http://www.comocreartuweb.com/'}",
//                    contentType: "application/json",
//                    dataType: "json",
//                    success: succeeded,
//                    error: queryError
//                });
//            }
//            function succeeded(data, textStatus, request) {
//                console.log(data)
////                var result = $.parseJSON(data.d);
//            }
//            function queryError(request, textStatus, errorThrown) {
//                alert(request.responseText, textStatus + " " + errorThrown);
//            }
function AjaxCall(){
//     $('#toto').html("hola");
            $.soap({
                    url: 'http://localhost/projets/Perlitas/webservice/test.php/',
                    method: 'TestURL',
                    data: {
                        url : $('input[name="url"]').val()
                    },
                    success: function (soapResponse) {
                        // Some code 
                        // Tomo el resultado y lo paso a xml
                        xmlDoc = $.parseXML( soapResponse.toString() );
                        $xml = $( xmlDoc );
                        // busco el elemento return
                        $return = $xml.find( "return" );
                        // muestra rapida del resultado
                        $('#toto').html($return[0].innerHTML);
                        // paso el resultado a json para poder recorrerlo
//                        console.log($.parseJSON( $return[0].innerHTML));
                        
                    },
                    error: function (SOAPResponse) {
                       // Some code
                       console.log(SOAPResponse.content);
                       $('#toto').html(SOAPResponse.content);
                    }
            });
        }
        </script>
    </body>
</html>
