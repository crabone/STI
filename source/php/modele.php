<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author at
 */
class Membre {
    private $id;
    private $login;
    private $pass;
    private $actif;
    private $estAdmin;
        
    function __construct($id, $login, $actif, $estAdmin) {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
        $this->actif = $actif;
        $this->estAdmin = $estAdmin;
    }
    
    
    
    function getId() {
        return $this->id;
    }
    
    function getLogin() {
        return $this->login;
    }

    function getPass() {
        return $this->pass;
    }

    function getActif() {
        return $this->actif;
    }

    function getEstAdmin() {
        return $this->estAdmin;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setActif($actif) {
        $this->actif = $actif;
    }

    function setEstAdmin($estAdmin) {
        $this->estAdmin = $estAdmin;
    }

}


class Message {

    private $id;
    private $sujet;
    private $corps;
    private $idExpediteur;
    private $idDestinataire;
    
    
    function __construct($id, $sujet, $corps, $idExpediteur, $idDestinataire) {
        $this->id = $id;
        $this->sujet = $sujet;
        $this->corps = $corps;
        $this->idExpediteur = $idExpediteur;
        $this->idDestinataire = $idDestinataire;
    }
    
    function getId() {
        return $this->id;
    }

    function getSujet() {
        return $this->sujet;
    }

    function getCorps() {
        return $this->corps;
    }

    function getIdExpediteur() {
        return $this->idExpediteur;
    }

    function getIdDestinataire() {
        return $this->idDestinataire;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function setCorps($corps) {
        $this->corps = $corps;
    }

    function setIdExpediteur($idExpediteur) {
        $this->idExpediteur = $idExpediteur;
    }

    function setIdDestinataire($idDestinataire) {
        $this->idDestinataire = $idDestinataire;
    }
    
}


class ConnexionDB{
    
    private static function connect() {
        if ($dbPDO = new PDO('sqlite:../../STI.db'))
        {
            echo 'Connected to the database.';
            return $dbPDO;
        } else {
            echo 'Connection failed: ' . htmlspecialchars;
            ($error);
          return NULL;
        }
    }
    
    public static function connexionMembre($login, $pass){
        
        $dbClient = self::connect();
        $stmt = $dbClient->prepare("select id_membre, login, actif, admin from membre where login =". $login ." and pass=" . $pass. "limit 1");
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result->rowCount() > 0){
            if($result['actif'] == 1)
                return new Membre($result['id_membre'], $result['login'], $result['actif'], $result['estAdmin']);
        }
        
        return NULL;
    }

}



?>
