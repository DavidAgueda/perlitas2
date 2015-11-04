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
class log {

    var $id;
    var $date;
    var $namePC;
    var $nameFile;
    var $encode;
    var $numberRows;
    var $processingTime;
    var $error;
    var $db;

    public function __construct(PDO $db, $date = '', $namePC = '', $nameFile = '', $encode = '', $numberRows = '', $processingTime = '', $error = '') {
        $this->db = $db;

        $this->date             = $date;
        $this->namePC           = $namePC;
        $this->nameFile         = $nameFile;
        $this->encode           = $encode;
        $this->numberRows       = $numberRows;
        $this->processingTime   = $processingTime;
        $this->error            = $error;
    }

    public function login() {
        $count = $this->_checkCredentials();
        if ($count == 1) {
            return true;
        }
        return false;
    }

//    protected function _checkCredentials() {
//        $conn = $this->db;
//
//        $sql = 'SELECT idrow FROM `user` WHERE '
//                . 'pass = \'' . $this->pass . '\' '
//                . 'AND user = \'' . $this->user . '\'';
//        $result = $conn->query($sql)->rowCount();
//        if (!$result) {
//            return 0;
//        }
//        return $result;
//    }

    public function getLog($idrow) {
        $conn = $this->db;
        $sql = 'SELECT * FROM `log` WHERE idrow=' . $idrow;
        $result = $conn->query($sql);
        if ($result) {
            foreach ($result as $row) {
                $this->id               = $row['idrow'];
                $this->date             = $row['date'];
                $this->namePC           = $row['namePC'];
                $this->nameFile         = $row['nameFile'];
                $this->encode           = $row['encode'];
                $this->numberRows       = $row['numberRows'];
                $this->processingTime   = $row['processingTime'];
                $this->error            = $row['error'];
                return array($row['idrow'], $row['date'], $row['namePC'], 
                    $row['nameFile'], $row['encode'], $row['numberRows'],
                    $row['processingTime'], $row['error']);
            }
        }
        return false;
    }

    public function setInDB() {
        $conn = $this->db;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO `log`(`date`, `namePC`, `nameFile`, `encode`, `numberRows`, `processingTime`, `error`) '
                . 'VALUES ('
                . '\'' . $this->date . '\','
                . '\'' . $this->namePC . '\','
                . '\'' . $this->nameFile . '\','
                . '\'' . $this->encode . '\','
                . '\'' . $this->numberRows .'\','
                . '\'' . $this->processingTime . '\','
                . '\'' . $this->error .'\''
                . ')'
                ;
        try {
            $requete = $conn->prepare($sql);
            $rel = $requete->execute();
        } catch (Exception $exc) {
            echo 'Error : ' . $exc->getMessage();
        }
    }

}
