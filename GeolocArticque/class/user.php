<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author dagueda
 */
class user {

    var $id;
    var $user;
    var $pass;
    var $name;
    var $date;
    var $db;

    public function __construct(PDO $db, $user = '', $pass = '', $name = '') {
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->name = $name;
    }

    public function login() {
        $count = $this->_checkCredentials();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    protected function _checkCredentials() {
        $conn = $this->db;
        
        $sql = 'SELECT idrow FROM `user` WHERE '
                . 'pass = \'' . $this->pass . '\' '
                . 'AND user = \'' . $this->user . '\'';
        $result = $conn->query($sql)->rowCount();
        if (!$result) {
            return 0;
        }
        return $result;
    }

    public function getUser() {
        $conn = $this->db;
        $sql = 'SELECT * FROM `user` WHERE pass = \'' . $this->pass . '\' and user = \'' . $this->user . '\'';
        $result = $conn->query($sql);
        if ($result) {
            foreach ($result as $row) {
                $this->user = $row['user'];
                $this->pass = $row['pass'];
                $this->name = $row['name'];
                return array($row['user'], $row['pass'], $row['name']);
            }
        }
        return false;
    }

    public function setInDB() {
        $conn = $this->db;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO user(user, pass, name, creationDate) VALUES (\'' . $this->user . '\',\'' . $this->pass . '\',\'' . $this->name . '\',\'' . date('Y-m-d') . '\')';
        try {
            $requete = $conn->prepare($sql);
            $rel = $requete->execute();
        } catch (Exception $exc) {
            echo 'Error : ' . $exc->getMessage();
        }
    }

}
