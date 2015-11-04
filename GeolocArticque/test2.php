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
        <h1>Test 2 connection</h1>
        <?php
        require_once './class/connection.php';
//        require_once './class/user.php';
        require_once './class/log.php';
        require_once './class/tableau.php';
        
        $con = new connection();
        $con->connect();
        $con->test();
        
        $log = new log($con->gbd,'03/11/2015','testNamePC','testNameFile','testEncode', '100','00:00','testError' );
//        $log->setInDB();
        $log = null;
        $log = new log($con->gbd);
        var_dump($log->getLog(1));
        var_dump($log);
        
        $tableu = new tableau($con->gbd);
        $table = $tableu->printTableau();
        
        print $table;
                
        
//        $user = new user($con->gbd,'david','david','David Agueda');
//        $user->login();
//        var_dump($user->getUser());
//        $user->setInDB();
        // put your code here
        ?>
    </body>
</html>
