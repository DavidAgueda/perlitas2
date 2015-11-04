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
        <h1>Instalation de MYSQL</h1>
        <?php
        // put your code here
        $dsn = 'mysql:host=127.0.0.1';
        $user = 'root';
        $pass = '';

        try {
            $gbd = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $databaseName = 'geoloc';
        $sql = 'CREATE DATABASE IF NOT EXISTS ' . $databaseName . ';';
        try {
            $requete = $gbd->prepare($sql);
            $rel = $requete->execute();
        } catch (Exception $exc) {
            echo 'Error : ' . $exc->getMessage();
        }

        $dsn = 'mysql:dbname=' . $databaseName . ';host=127.0.0.1';
        $user = 'root';
        $pass = '';
        try {
            $gbd = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $linea = '';

        $fp = fopen("dump/geoloc.sql", "r");
        while (!feof($fp)) {
            $linea .= fgets($fp) . "\n";
        }

//        var_dump($linea);

        try {
            $requete = $gbd->prepare($linea);
            $rel = $requete->execute();
        } catch (Exception $exc) {
            echo 'Error : ' . $exc->getMessage();
        }

        fclose($fp);
        header('Location: index.html');
        ?>
    </body>
</html>
