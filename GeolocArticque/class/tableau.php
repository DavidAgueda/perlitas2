<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tableau
 *
 * @author dagueda
 */
//include_once './log.php';

class tableau {
    var $arrayLogs = array();
    var $db;
    var $dbRow;
    var $sizePage = 10;
    var $start;
    
    public function __construct(PDO $db){
        $conn = $db;
        $this->db = $db;

        $sql = 'SELECT idrow FROM `log` ';
        $result = $this->db->query($sql);
        $this->dbRow = $result->rowCount();
    }
    
    public function printTableau($start = 0 ) {
        

        $this->start = $start;
        
        $this->arrayLogs = array(); 
        $sql = 'SELECT idrow FROM `log` LIMIT '.$start .','.$this->sizePage;
        
        $result = $this->db->query($sql);
        if ($result) {
            foreach ($result as $row) {
                $tempLog = new log($this->db);
                $tempLog->getLog($row['idrow']);
                $this->arrayLogs[] = $tempLog;
                $tempLog = null;
            }
        }
        
        $print = '<table class="table" id="tableau">';
//        $print .= '<caption><h2>logs list</h2></caption>';
        $print .= '<thead>'
                    . '<tr>'
                        //. '<th>id</th>'
                        . '<th>Date</th>'
                        . '<th>PC name</th>'
                        . '<th>File name</th>'
                        . '<th>File encode</th>'
                        . '<th>Line numbers</th>'
                        . '<th>Process time</th>'
                        . '<th>Error</th>'
                    . '</tr>'
                . '</thead>';
        for ($i = 0; $i < count($this->arrayLogs); $i++) {
            $print .= '<tr>';
                //$print .= '<td>'. $this->arrayLogs[$i]->id              .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->date            .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->namePC          .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->nameFile        .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->encode          .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->numberRows      .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->processingTime  .'</td>';
                $print .= '<td>'. $this->arrayLogs[$i]->error           .'</td>';
            $print .= '</tr>';
        }
        
        $print .= '</table>';
        
        return $print;
    }

}
