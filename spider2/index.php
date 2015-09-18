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
        <ul>
            <li>detectar si es un enlace interno o externo</li>
            <li>deterctar si es un error 40</li>
            <li>si es un enlace interno y no es un error 404 entrar en el enlace si repetir proceso</li>
        </ul>
        <?php
        $url1 = "http://localhost/projets/Perlitas/";

        function spider($url, $Enlaces= array()) {
            //$Enlaces= array();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            curl_close($ch);
            
            
            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            $xpath = new DOMXPath($dom);
            $as = $xpath->evaluate("/html/body//a");
            for ($i = 0; $i < $as->length; $i++) {
                $a = $as->item($i);
                
                    if (strpos($a->getAttribute('href'), 'http') === false) {
                        $Enlaces[$i]['enlace'] = $url . $a->getAttribute('href');
                    }
                    else {
                        $Enlaces[$i]['enlace'] = $a->getAttribute('href');
                    }
            }
           // $Enlaces = array_unique($Enlaces);
            $Enlaces = unique_multidim_array($Enlaces,'enlace');
            
            $index = 0;
            $EnlacesTmp = array();
            foreach ($Enlaces as $Enlace) {
                if(strpos($Enlace['enlace'], saca_dominio($url))=== false){
                    $EnlacesTmp[$index]['enlace'] = $Enlace['enlace'];
                } else {
                    $EnlacesTmp[$index]['enlace'] = $Enlace['enlace'];
                    $EnlacesTmp[$index]['hijos'] = spider($Enlace['enlace']);
                }
                
                $index++;
            }
            $Enlaces = $EnlacesTmp;
            return $Enlaces;
        }
          
        echo '<hr>';
        
        $resultado = spider( 'http://www.gitesdesejour.com/web/accueil');
        
        var_dump($resultado);
        var_dump($resultado[0]['hijos'][0]);
        //var_dump($resultado[0]['hijos']);

        function dameURL() {
            $url = "http://" . $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
            return $url;
        }

        function saca_dominio($url) {
            $protocolos = array('http://', 'https://', 'ftp://', 'www.');
            $url = explode('/', str_replace($protocolos, '', $url));
            return $url[0];
        }

        
        function unique_multidim_array($array, $key){
            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach($array as $val){
                if(!in_array($val[$key],$key_array)){
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
            return $temp_array;
        }
        foreach ($resultado as $value) {
            echo '<hr>';
             print_r($value);
        }
        //print_r($resultado);
        ?>


    </body>
</html>
