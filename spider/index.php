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

        function spider($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            curl_close($ch);

            //var_dump($html);
            if (strpos($html, ' 404 ') === false) {
                $dom = new DOMDocument();
                @$dom->loadHTML($html);

                $xpath = new DOMXPath($dom);
                $imgs = $xpath->evaluate("/html/body//a");

                for ($i = 0; $i < $imgs->length; $i++) {
                    $img = $imgs->item($i);
                    $image[$i]['Anchortext'] = $img->textContent;
                    $image[$i]['enlace'] = $img->getAttribute('href');

                    $rest = substr($image[$i]['enlace'], 0, 4);
                    if (strpos($image[$i]['enlace'], 'http') === false) {
                        $image[$i]['enlaceDominio'] = $url . $img->getAttribute('href');
                    }
                    else {
                        $image[$i]['enlaceDominio'] = $img->getAttribute('href');
                    }

                    foreach ($image as $link) {
                        if (in_array('spider2/', $link)) {
                            $image[$i]['seguir'] = '<h4>esta</h4>';
                        } else {
                            if (strpos($image[$i]['enlaceDominio'], saca_dominio($url)) !== false) {
                                // $image[$i]['visitar'] = saca_dominio($url);
         //                        if ($nivel <1){
                                     $image[$i]['hijos'] = spider($image[$i]['enlaceDominio']);
         //                        }

                             }
                        }
                    }
                    
                }
            } else {
                return 'Error 404';
            }
            if(isset($image)){
                 return $image;
            }else{
                 return 'vacio';
            }
//            return $image;
        }

        //var_dump(spider ($url1));
//        var_dump($resultado = spider('http://localhost/projets/Perlitas/'));
        echo '<hr>';
        
        $resultado = spider('http://localhost/projets/test/public_html/');
        
        var_dump($resultado);
        var_dump($resultado[0]['hijos']);

        function dameURL() {
            $url = "http://" . $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
            return $url;
        }

        function saca_dominio($url) {
            $protocolos = array('http://', 'https://', 'ftp://', 'www.');
            $url = explode('/', str_replace($protocolos, '', $url));
            return $url[0];
        }

        ?>


    </body>
</html>
