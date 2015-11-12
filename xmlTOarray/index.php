<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

class AminoAcid {

    var $name;  // nombre aa 
    var $symbol;    // símbolo de tres letras
    var $code;  // código de una letra
    var $type;  // hidrofóbico, cargado or neutral

    function AminoAcid($aa) {
        foreach ($aa as $k => $v)
            $this->$k = $aa[$k];
    }

}

function readDatabase($filename) {
    // read the XML database of aminoacids
    $data = implode("", file($filename));
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $data, $values, $tags);
    xml_parser_free($parser);

//    var_dump($tags);
//    var_dump($values);
    // repetir a través de las extructuras
    foreach ($tags as $key => $val) {
        if ($key == "molecule") {
            $molranges = $val;
            // cada par contiguo de netradas de array son los 
            // rangos altos y bajos para cada definición de molécula
            for ($i = 0; $i < count($molranges); $i+=2) {
                $offset = $molranges[$i] + 1;
                $len = $molranges[$i + 1] - $offset;
                $tdb[] = parseMol(array_slice($values, $offset, $len));
            }
        } else {
            continue;
        }
    }
    return $tdb;
}

function parseMol($mvalues) {
    for ($i = 0; $i < count($mvalues); $i++) {
        $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
    }
    return new AminoAcid($mol);
}

$db = readDatabase("moldb.xml");
echo "** Database of AminoAcid objects:\n";
var_dump($db);
?>

<?php
class Canton {

    var $CodCan;  
    var $LibCan;    
    var $Pourvu;  
//    var $type;  // hidrofóbico, cargado or neutral

    function Canton($aa) {
        foreach ($aa as $k => $v)
            $this->$k = $aa[$k];
    }

}
class Departement {

    var $CodMinDpt;  
    var $CodDpt3Car;    
    var $LibDpt;
    var $arrayCanton;

    function Departement($aa) {
        foreach ($aa as $k => $v)
            $this->$k = $aa[$k];
    }
    
    public function Chillar(){
        echo '<h1>**' .$this->LibDpt. '**</h1>';
    }
}

function readDatabaseC($filename) {
    // read the XML database of aminoacids
    $data = implode("", file($filename));
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $data, $values, $tags);
    xml_parser_free($parser);

    var_dump($tags);
    var_dump($values);
    // repetir a través de las extructuras
    foreach ($tags as $key => $val) {
        if ($key == "Canton") {
            $molranges = $val;
            // cada par contiguo de netradas de array son los 
            // rangos altos y bajos para cada definición de molécula
            for ($i = 0; $i < count($molranges); $i+=2) {
                $offset = $molranges[$i] + 1;
                $len = $molranges[$i + 1] - $offset;
//                                var_dump(array_slice($values, $offset, $len));

                $tdbC[] = parseMolC(array_slice($values, $offset, $len));
            }
        } else {
            continue;
        }
    }
    foreach ($tags as $keyD => $valD) {
        if ($keyD == "Departement") {
            $molranges = $valD;
//            var_dump($molranges);
            // cada par contiguo de netradas de array son los 
            // rangos altos y bajos para cada definición de molécula
            for ($i = 0; $i < count($molranges); $i+=2) {
                $offset = $molranges[$i] + 1;
                $len = $molranges[$i + 1] - $offset;
                
//                var_dump(array_slice($values, $offset, $len));
                $tdbD = parseMolD(array_slice($values, $offset, $len));
            }
        } else {
            continue;
        }
    }

//    $tdb['Canton']=$tdbC;
    $tdbD->arrayCanton = $tdbC;
    $tdb=$tdbD;
    return $tdb;
}

function parseMolC($mvalues) {
    for ($i = 0; $i < count($mvalues); $i++) {
        $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
    }
    return new Canton($mol);
}
function parseMolD($mvalues) {
    
//    var_dump($mvalues);
    for ($i = 0; $i < count($mvalues); $i++) {
        if( isset($mvalues[$i]["value"])){
            $mol[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
        
        }
    }
    return new Departement($mol);
}

//$db = readDatabaseC("C1001.xml");
$db = readDatabaseC("http://www.interieur.gouv.fr/avotreservice/elections/telechargements/DP2015/candidatsT1/001/C1001.xml");
echo "** Database of AminoAcid objects:\n";
var_dump($db);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
$db->Chillar();
?>
    </body>
</html>
