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
        <p> http://stackoverflow.com/questions/2313107/how-do-i-make-a-simple-crawler-in-php </p>
        <p> Descomentar </p>
        <?php

        function crawl_page($url, $depth = 5) {
            static $seen = array();
            if (isset($seen[$url]) || $depth === 0) {
                return;
            }

            $seen[$url] = true;

            // Cargamos el documento
            $dom = new DOMDocument('1.0');
            @$dom->loadHTMLFile($url);

            // extrahemos los enlaces
            $anchors = $dom->getElementsByTagName('a');
            foreach ($anchors as $element) {
                $href = $element->getAttribute('href');
                if (0 !== strpos($href, 'http')) {
                    $path = '/' . ltrim($href, '/');
                    if (extension_loaded('http')) {
                        $href = http_build_url($url, array('path' => $path));
                    } else {
                        $parts = parse_url($url);
                        $href = $parts['scheme'] . '://';
                        if (isset($parts['user']) && isset($parts['pass'])) {
                            $href .= $parts['user'] . ':' . $parts['pass'] . '@';
                        }
                        $href .= $parts['host'];
                        if (isset($parts['port'])) {
                            $href .= ':' . $parts['port'];
                        }
                        $href .= $path;
                    }
                }
                crawl_page($href, $depth - 1);
            }
//            echo "URL:", $url, PHP_EOL, "CONTENT:", PHP_EOL, $dom->saveHTML(), PHP_EOL, PHP_EOL;
            echo "URL:", $url, PHP_EOL .'<br />';
        }

//        crawl_page("https://www.youtube.com/user/motenai82", 2);
        ?>
    </body>
</html>
