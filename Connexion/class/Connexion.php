<?php
require_once dirname(__FILE__ ). '/../functions/registerLog.php';
/**
 * Description of Conection
 *
 * @author dagueda
 */
class Connexion {

    //put your code here
    var $dataBaseName = '';
    var $host = '';
    var $user = '';
    var $pass = '';
    var $db = '';
    var $dsn = '';
    var $error = '';

    //global $gbd;
    // start connexion 
    public function __construct($dataBaseName, $host, $user, $pass, $error) {
        $this->dataBaseName = $dataBaseName;
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->error = $error;
        $this->dsn = 'mysql:dbname=' . $this->dataBaseName . ';host=' . $this->host;
//        connexion();
        try {
            $this->db = new PDO($this->dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            $this->insertLog('Error: ' . $e->getMessage(). PHP_EOL);
        }
    }

    // insert to table log
    public function insertLog($string, $file = 'undefined', $request = '') {
        $rel = false;
        $sql = 'INSERT INTO `log`( `stringLog`,`file`,`request`) VALUES (\'' . addslashes($string) . '\',\'' . addslashes($file) . '\',\'' . addslashes($request) . '\')';
        fileLog($string);
        return $rel = $this->commit($sql);
    }

    // save to database
    public function commit($sql) {

        $rel = false;
        try {
            $requete = $this->db->prepare($sql);
            $rel = $requete->execute();
        } catch (Exception $exc) {
            echo 'Error : ' . $exc->getMessage();
            $this->insertLog('Error: ' . $exc->getMessage(). PHP_EOL);
        }
        return $rel;
    }
    
    // read database
    public function commitSelect($sql) {

        $rel = false;
        try {
            $requete = $this->db->prepare($sql);
            $rel = $requete->execute();
            $red = $requete->fetchAll();
        } catch (Exception $exc) {
            echo 'Error : ' . $exc->getMessage();
            $this->insertLog('Error: ' . $exc->getMessage(). PHP_EOL);
        }
        return $red;
    }
    
    // insert Date in table date_maj
    public function insertDate($type_circonscription, $id_circonscription, $tour, $date_maj, $complet='') {

        $date_maj = str_replace('/', '-', $date_maj);
        
//        var_dump($date_maj);
        $date = strtotime($date_maj);
        $date = date('Y-m-d H:i:s', $date);

        $rel = false;
        $sql = 'INSERT INTO `date_maj`( `type_circonscription`,`id_circonscription`,`tour`,`traite`,`date_maj` ) '
                . 'VALUES ( \'' . addslashes($type_circonscription) . '\',\''
                . addslashes($id_circonscription) . '\',\'' . addslashes($tour) . '\','
                . '\'0\',\'' . addslashes($date) . '\' )';
        $sql.= 'ON DUPLICATE KEY UPDATE ';
        $sql.= '`type_circonscription` = \'' . addslashes($type_circonscription) . '\',';
        $sql.= '`id_circonscription` = \'' . addslashes($id_circonscription) . '\',';
        $sql.= '`tour` = \'' . addslashes($tour) . '\',';
        $sql.= '`traite` = \'0\',';
        $sql.= '`date_maj` = \'' . addslashes($date) . '\',';
        $sql.= '`complet` = \'' . addslashes($complet) . '\'';

        return $rel = $this->commit($sql);
    }

    // Update Date in table parametres
    public function updateDateMj($date) {
        $sql = 'INSERT INTO `parametres`(`dateMaj`, `id`) VALUES (\''.date('d-m-Y H:i:s').'\', 1) ';
        $sql .= 'ON DUPLICATE KEY UPDATE ';
        $sql .= '`dateMaj` = \'' .$date . '\', id = 1';
        //var_dump($sql);
        return $rel = $this->commit($sql);
    }

    // Read Date 
    public function selectDernirDateMj() {
        $sql = 'SELECT dateMaj FROM `parametres` WHERE id = 1';
        return $rel = $this->commitSelect($sql);
    }

    // insert to table vote pour le fichier FE.xml qui est légèrement différent
    public function insertVoteFrance($valueMentions = '', $valueResultats = '', $type = '', $id_circonscription = '', $Tour, $file) {

        //var_dump($valueSection);
        //echo "<br/>type=$type, id_circonscription=$id_circonscription";

        $rel = false;
        if ($valueMentions != '' || $valueResultats != '' || $type != '' || $id_circonscription != '') {

            $nb_sap = str_replaceFloat((String)$valueResultats->NbSap);
            if ($nb_sap == '') {
                $nb_sap = "''";
            }

            $sql = 'INSERT INTO `vote`('
                    . '`type_circonscription`, '
                    . '`id_circonscription`, '
                    . '`tour`, '
                    . '`nb_inscrits`, '
                    . '`nb_abstentions`, '
                    . '`rap_abs_inscrits`, '
                    . '`nb_votants`, '
                    . '`rap_vot_inscrits`, '
                    . '`nb_blancs`, '
                    . '`rap_bla_inscrits`, '
                    . '`rap_bla_votants`, '
                    . '`nb_nuls`, '
                    . '`rap_nul_inscrits`, '
                    . '`rap_nul_votants`, '
                    . '`nb_exprimes`, '
                    . '`rap_exp_inscrits`, '
                    . '`rap_exp_votants`, '
                    . '`nb_sap`, '
                    . '`nb_sie_pourvus` '
                    . ') VALUES ('
                    . '\'' . $type . '\','
                    . '\'' . $id_circonscription . '\','
                    . $Tour . ','
                    . (String)$valueMentions->Inscrits->Nombre . ','
                    . (String)$valueMentions->Abstentions->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Abstentions->RapportInscrit) . ','
                    . (String)$valueMentions->Votants->Nombre. ','
                    . str_replaceFloat((String)$valueMentions->Votants->RapportInscrit) . ','
                    . (String)$valueMentions->Blancs->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Blancs->RapportInscrit) . ','
                    . str_replaceFloat((String)$valueMentions->Blancs->RapportVotant) . ','
                    . (String)$valueMentions->Nuls->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Nuls->RapportInscrit) . ','
                    . str_replaceFloat((String)$valueMentions->Nuls->RapportVotant) . ','
                    . str_replaceFloat((String)$valueMentions->Exprimes->Nombre) . ','
                    . str_replaceFloat((String)$valueMentions->Exprimes->RapportInscrit) . ','
                    . str_replaceFloat((String)$valueMentions->Exprimes->RapportVotant) . ','
                    . (String)$valueResultats->NbSap . ','
                    . (String)$valueResultats->NbSiePourvus . ''
                    . ')';
            $sql .= ' ON DUPLICATE KEY UPDATE '
                    . 'nb_inscrits=' . (String)$valueMentions->Inscrits->Nombre . ','
                    . 'nb_abstentions=' . (String)$valueMentions->Abstentions->Nombre . ','
                    . 'rap_abs_inscrits=' . str_replaceFloat((String)$valueMentions->Abstentions->RapportInscrit) . ','
                    . 'nb_votants=' . (String)$valueMentions->Votants->Nombre . ','
                    . 'rap_vot_inscrits=' . str_replaceFloat((String)$valueMentions->Votants->RapportInscrit) . ','
                    . 'nb_blancs=' . (String)$valueMentions->Blancs->Nombre . ','
                    . 'rap_bla_inscrits=' . str_replaceFloat((String)$valueMentions->Blancs->RapportInscrit) . ','
                    . 'rap_bla_votants=' . str_replaceFloat((String)$valueMentions->Blancs->RapportVotant) . ','
                    . 'nb_nuls=' . (String)$valueMentions->Nuls->Nombre . ','
                    . 'rap_nul_inscrits=' . str_replaceFloat((String)$valueMentions->Nuls->RapportInscrit) . ','
                    . 'rap_nul_votants=' . str_replaceFloat((String)$valueMentions->Nuls->RapportVotant) . ','
                    . 'nb_exprimes=' . str_replaceFloat((String)$valueMentions->Exprimes->Nombre) . ','
                    . 'rap_exp_inscrits=' . str_replaceFloat((String)$valueMentions->Exprimes->RapportInscrit) . ','
                    . 'rap_exp_votants=' . str_replaceFloat((String)$valueMentions->Exprimes->RapportVotant) . ','
                    . 'nb_sap=' . (String)$valueResultats->NbSap . ','
                    . 'nb_sie_pourvus=' . (String)$valueResultats->NbSiePourvus;


            return $rel = $this->commit($sql);
        } else {
            return false;
        }
    }

    // insert to table Liste
    public function insertNuance($valueListe = '', $Tour, $file) {

        //var_dump($valueListe);

        $rel = false;
        if ($valueListe != '') {

            $nb_sieges = (String)$valueListe->NbSieges;
            if ($nb_sieges == '') {
                $nb_sieges = "0";
            }

            $sql = 'INSERT INTO `resultat_nuance`('
                    . '`fk_cod_nua`,'
                    . '`tour`, '
                    . '`nb_voix`, '
                    . '`rap_exprimes`, '
                    . '`rap_inscrits`, '
                    . '`nb_sieges`'
                    . ') '
                    . 'VALUES ('
                    . '\'' . (String)$valueListe->CodNuaListe . '\','
                    . $Tour . ','
                    . (String)$valueListe->NbVoix . ','
                    . str_replaceFloat((String)$valueListe->RapportExprime) . ','
                    . str_replaceFloat((String)$valueListe->RapportInscrit) . ','
                    . $nb_sieges . ')';
            $sql .= ' ON DUPLICATE KEY UPDATE '
                    . 'nb_voix=' . (String)$valueListe->NbVoix . ','
                    . 'rap_exprimes=' . str_replaceFloat((String)$valueListe->RapportExprime) . ','
                    . 'rap_inscrits=' . str_replaceFloat((String)$valueListe->RapportInscrit) . ','
                    . 'nb_sieges=' . $nb_sieges;

            return $rel = $this->commit($sql);
        } else {
            return false;
        }
    }

    // insert to table Liste
    public function insertListe($valueListe = '', $type = '', $id_circonscription = '', $Tour, $file) {

        $rel = false;
        if ($valueListe != '' || $type != '' || $id_circonscription != '') {

            $nb_sieges = str_replaceFloat((String)$valueListe->NbSieges);
            if ($nb_sieges == '') {
                $nb_sieges = "''";
            }

            $sql = 'INSERT INTO `resultat_liste`('
                    . '`type_circonscription`,'
                    . '`id_circonscription`, '
                    . '`fk_tour`, '
                    . '`fk_cod_seq_liste`, '
                    . '`nb_voix`, '
                    . '`rap_exprimes`, '
                    . '`rap_inscrits`, '
                    . '`nb_sieges`'
                    . ') '
                    . 'VALUES ('
                    . '\'' . $type . '\','
                    . '\'' . $id_circonscription . '\','
                    . $Tour . ','
                    . '\'' . (String)$valueListe->CodSeqListe. '\','
                    . (String)$valueListe->NbVoix . ','
                    . str_replaceFloat((String)$valueListe->RapportExprime) . ','
                    . str_replaceFloat((String)$valueListe->RapportInscrit) . ','
                    . $nb_sieges . ')';
            $sql .= ' ON DUPLICATE KEY UPDATE '
                    . 'nb_voix=' . (String)$valueListe->NbVoix . ','
                    . 'rap_exprimes=' . str_replaceFloat((String)$valueListe->RapportExprime) . ','
                    . 'rap_inscrits=' . str_replaceFloat((String)$valueListe->RapportInscrit) . ','
                    . 'nb_sieges=' . $nb_sieges;

            return $rel = $this->commit($sql);
        } else {
            return false;
        }
    }

    // insert to table vote
    public function insertVote($valueMentions = '', $type = '', $id_circonscription = '', $nb_sap, $Tour, $file) {

        //var_dump($valueSection);
        //echo "<br/>type=$type, id_circonscription=$id_circonscription";

        $rel = false;
        if (empty($valueMentions->Inscrits)) {
            return false;
        }
        if ($valueMentions != '' || $type != '' || $id_circonscription != '') {

            //$nb_sap = str_replaceFloat($valueSection->NbSap->__toString());
            if ($nb_sap == '') {
                $nb_sap = "''";
            }

            $sql = 'INSERT INTO `vote`('
                    . '`type_circonscription`, '
                    . '`id_circonscription`, '
                    . '`tour`, '
                    . '`nb_inscrits`, '
                    . '`nb_abstentions`, '
                    . '`rap_abs_inscrits`, '
                    . '`nb_votants`, '
                    . '`rap_vot_inscrits`, '
                    . '`nb_blancs`, '
                    . '`rap_bla_inscrits`, '
                    . '`rap_bla_votants`, '
                    . '`nb_nuls`, '
                    . '`rap_nul_inscrits`, '
                    . '`rap_nul_votants`, '
                    . '`nb_exprimes`, '
                    . '`rap_exp_inscrits`, '
                    . '`rap_exp_votants`, '
                    . '`nb_sap` '
                    . ') VALUES ('
                    . '\'' . $type . '\','
                    . '\'' . $id_circonscription . '\','
                    . $Tour . ','
                    . (String)$valueMentions->Inscrits->Nombre . ','
                    . (String)$valueMentions->Abstentions->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Abstentions->RapportInscrit) . ','
                    . (String)$valueMentions->Votants->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Votants->RapportInscrit) . ','
                    . (String)$valueMentions->Blancs->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Blancs->RapportInscrit) . ','
                    . str_replaceFloat((String)$valueMentions->Blancs->RapportVotant) . ','
                    . (String)$valueMentions->Nuls->Nombre . ','
                    . str_replaceFloat((String)$valueMentions->Nuls->RapportInscrit) . ','
                    . str_replaceFloat((String)$valueMentions->Nuls->RapportVotant) . ','
                    . str_replaceFloat((String)$valueMentions->Exprimes->Nombre) . ','
                    . str_replaceFloat((String)$valueMentions->Exprimes->RapportInscrit) . ','
                    . str_replaceFloat((String)$valueMentions->Exprimes->RapportVotant) . ','
                    . $nb_sap . ''
                    . ')';
            $sql .= ' ON DUPLICATE KEY UPDATE '
                    . 'nb_inscrits=' . (String)$valueMentions->Inscrits->Nombre . ','
                    . 'nb_abstentions=' . (String)$valueMentions->Abstentions->Nombre . ','
                    . 'rap_abs_inscrits=' . str_replaceFloat((String)$valueMentions->Abstentions->RapportInscrit) . ','
                    . 'nb_votants=' . (String)$valueMentions->Votants->Nombre . ','
                    . 'rap_vot_inscrits=' . str_replaceFloat((String)$valueMentions->Votants->RapportInscrit) . ','
                    . 'nb_blancs=' . (String)$valueMentions->Blancs->Nombre. ','
                    . 'rap_bla_inscrits=' . str_replaceFloat((String)$valueMentions->Blancs->RapportInscrit) . ','
                    . 'rap_bla_votants=' . str_replaceFloat((String)$valueMentions->Blancs->RapportVotant) . ','
                    . 'nb_nuls=' . (String)$valueMentions->Nuls->Nombre . ','
                    . 'rap_nul_inscrits=' . str_replaceFloat((String)$valueMentions->Nuls->RapportInscrit) . ','
                    . 'rap_nul_votants=' . str_replaceFloat((String)$valueMentions->Nuls->RapportVotant) . ','
                    . 'nb_exprimes=' . str_replaceFloat((String)$valueMentions->Exprimes->Nombre) . ','
                    . 'rap_exp_inscrits=' . str_replaceFloat((String)$valueMentions->Exprimes->RapportInscrit) . ','
                    . 'rap_exp_votants=' . str_replaceFloat((String)$valueMentions->Exprimes->RapportVotant) . ','
                    . 'nb_sap=' . $nb_sap;

            return  $rel = $this->commit($sql);
        } else {
            return false;
        }
    }

    // Insert Elus
    public function insertElus($Elu, $id_candidat) {
        // Insertion dans la table Liste
        $sql = 'UPDATE '
                . ' `candidat` '
                . ' SET elu = \'' . $Elu . '\' '
                . ' WHERE id_candidat = \'' . $id_candidat . '\'';

        return $rel = $this->commit($sql);
    }

}
