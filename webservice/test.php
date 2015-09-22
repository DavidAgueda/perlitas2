<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./nusoap-0.9.5/lib/nusoap.php');
$server = new nusoap_server();
$server->register('calculadora');
$server->register('TestURL');

function calculadora( $x='', $y='', $operacion =''){
    return $x . $operacion . $y;
}
function TestURL($url){
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $result = curl_exec($ch);
//    curl_close($ch);
//    return $result;
//    return $url;
//    $html = htmlentities(file_get_contents($url));
    $html = file_get_contents($url);
    libxml_use_internal_errors(true);
//    var_dump($html);
    
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $dom->saveHTML();
    $result = array(
        'Titulo' =>'no',
        'Descripcion' =>'no',
        'H1' =>array(),
        'H2' =>array(),
        'H3' =>array(),
        'H4' =>array(),
        'Strong' =>array(),
        'W3C' => 'No contiene Errores'
        
    );
    
    foreach ($dom->getElementsByTagName('title') as $title) {
        $result['Titulo'] = $title->nodeValue;
    }
    foreach ($dom->getElementsByTagName('meta') as $meta) {
        if($meta->getAttribute('name') == 'description'){
            $result['Descripcion'] = $meta->getAttribute('content');
        }
    }
    foreach ($dom->getElementsByTagName('h1') as $h1) {
        $result['H1'][] = $h1->nodeValue;
    }
    foreach ($dom->getElementsByTagName('h2') as $h2) {
        $result['H2'][] = $h2->nodeValue;
    }
    foreach ($dom->getElementsByTagName('h3') as $h3) {
        $result['H3'][] = $h3->nodeValue;
    }
    foreach ($dom->getElementsByTagName('h4') as $h4) {
        $result['H4'][] = $h4->nodeValue;
    }
    foreach ($dom->getElementsByTagName('strong') as $Strong) {
        $result['Strong'][] = $Strong->nodeValue;
    }
    
    $validW3C = json_decode (file_get_contents('https://validator.w3.org/check?uri='.$url.'/&output=json'));
    foreach ($validW3C->messages as $message){
        if ($message->type == 'error'){
            $result['W3C'] = 'Contiene Errores';
            break;
        }
    }


    return $result;
}

//var_dump(TestURL('http://www.comocreartuweb.com'));

    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);
    
