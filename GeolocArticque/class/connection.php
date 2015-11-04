<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connection
 *
 * @author dagueda
 */
class connection {
    /**
     * dsn value
     * @var string 
     */
    var $dsn;
    /**
     * user value
     * @var string
     */
    var $user;
    /**
     * pass value
     * @var string The password for database
     */
    var $pass;
    /**
     * gbd value
     * @var object PDO
     */
    var $gbd;

    function __construct($dsn = 'mysql:dbname=geoloc;host=127.0.0.1', $user = 'root', $pass = '') {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->pass = $pass;
       
    }

    public function connect() {
        try {
            $this->gbd = new PDO($this->dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->gbd;
    }
    
    public function test() {
        $conn = $this->gbd;
        $sql = 'Show full tables';
//        $sql = 'SHOW COLUMNS FROM user';
        foreach ($conn->query($sql)as $row){
            var_dump($row);
        }
        
    }

//put your code here
}
