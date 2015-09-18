<?php

// Fonction qui effacé les fichier temporaire
function cleanFilesTemp($findme) {
    $resource = 'uploads/temp/';
    $file = scandir($resource);

    for ($i = 0; $i < count($file); $i++) {
        if ($i > 1) {
            if (strpos($file[$i], $findme) !== false) {
                unlink($resource . $file[$i]);
            }
        }
    }
}

// Fonction qui efface les fichiers âge de plus d'un mois ou si le dossier 
// downloads contien plus de vingt fichiers
function cleanFiles() {
    $resource = 'downloads/';
    $file = scandir($resource);

    for ($i = 0; $i < count($file); $i++) {
        if ($i > 1) {
            $fileDate = filectime($resource . $file[$i]);
            $lastMonth = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
            if ($lastMonth > $fileDate) {
                if ($file[$i] != '.' && $file[$i] != '..') {
                    unlink($resource . $file[$i]);
                }
            }
        }
    }
    if (count($file) > 20) {
        for ($j = 0; $j < 10; $j++) {
            if ($file[$j] != '.' && $file[$j] != '..') {
                unlink($resource . $file[$j]);
            }
        }
    }
}

// Fonction qui permet de vérifier si un fichier est un fichier csv 
// $string = mimeType
//
function testCSV($string) {
    $mimeType = array('text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext');
    for ($i = 0; $i < count($mimeType); $i++) {
        if ($mimeType[$i] == $string) {
            return true;
        }
    }
    return false;
}

// Ressources obtenues sur le site Web
// https://yeehuichan.wordpress.com/2011/08/07/sending-multiple-values-with-the-same-namekey-in-curl-post/
// Fonction qui permet faire rêquete dans curl

function curl_setopt_custom_postfields($ch, $postfields, $headers = null) {
    $algos = hash_algos();
    $hashAlgo = null;
    foreach (array('sha1', 'md5') as $preferred) {
        if (in_array($preferred, $algos)) {
            $hashAlgo = $preferred;
            break;
        }
    }
    if ($hashAlgo === null) {
        list($hashAlgo) = $algos;
    }
    $boundary = '----------------------------' .
            substr(hash($hashAlgo, 'cURL-php-multiple-value-same-key-support' . microtime()), 0, 12);

    $body = array();
    $crlf = "\r\n";
    $fields = array();
    foreach ($postfields as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $v) {
                $fields[] = array($key, $v);
            }
        } else {
            $fields[] = array($key, $value);
        }
    }
    foreach ($fields as $field) {
        list($key, $value) = $field;
        if (strpos($value, '@') === 0) {
            preg_match('/^@(.*?)$/', $value, $matches);
            list($dummy, $filename) = $matches;
            $body[] = '--' . $boundary;
            $body[] = 'Content-Disposition: form-data; name="' . $key . '"; filename="' . basename($filename) . '"';
            $body[] = 'Content-Type: application/octet-stream';
            $body[] = '';
            $body[] = file_get_contents($filename);
        } else {
            $body[] = '--' . $boundary;
            $body[] = 'Content-Disposition: form-data; name="' . $key . '"';
            $body[] = '';
            $body[] = $value;
        }
    }
    $body[] = '--' . $boundary . '--';
    $body[] = '';
    $contentType = 'multipart/form-data; boundary=' . $boundary;
    $content = join($crlf, $body);
    $contentLength = strlen($content);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Length: ' . $contentLength,
        'Expect: 100-continue',
        'Content-Type: ' . $contentType,
    ));

    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
}

function pastHours($tiempo_en_segundos) {
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
    return $horas . ':' . $minutos . ":" . $segundos;
}

function filePastToUtf8($updateTemp) {
    $enclist = array(
        'UTF-8', 'ASCII',
        'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5',
        'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10',
        'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16',
        'Windows-1251', 'Windows-1252', 'Windows-1254',
    );

    if (mb_detect_encoding(file_get_contents($updateTemp), $enclist) == 'ISO-8859-1') {
        $str = mb_convert_encoding(file_get_contents($updateTemp), 'UTF-8');
        $file = fopen($updateTemp, "c+");
        fwrite($file, $str);
        fclose($file);
    }
}