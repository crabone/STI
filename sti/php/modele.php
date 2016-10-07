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
    private $loginExpediteur;
    private $idDestinataire;
    private $loginDestinataire;

    function __construct($id, $sujet, $corps, $idExpediteur, $loginExpediteur, $idDestinataire, $loginDestinataire) {
        $this->id = $id;
        $this->sujet = $sujet;
        $this->corps = $corps;
        $this->idExpediteur = $idExpediteur;
        $this->loginExpediteur = $loginExpediteur;
        $this->idDestinataire = $idDestinataire;
        $this->loginDestinataire = $loginDestinataire;
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

    function getLoginExpediteur() {
        return $this->loginExpediteur;
    }

    function getIdDestinataire() {
        return $this->idDestinataire;
    }

    function getLoginDestinataire() {
        return $this->loginDestinataire;
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

    function setLoginExpediteur($loginExpediteur) {
        $this->loginExpediteur = $loginExpediteur;
    }

    function setIdDestinataire($idDestinataire) {
        $this->idDestinataire = $idDestinataire;
    }

    function setLoginDestinataire($loginDestinataire) {
        $this->loginDestinataire = $loginDestinataire;
    }

}

class ConnexionDB {

    private static function connexion() {
        if ($dbPDO = new PDO('sqlite:../../STI.db')) {
            return $dbPDO;
        } else {
            return NULL;
        }
    }

    public static function getIdMembre($login) {

        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("select id_membre from membres where login=?");
        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($result)  > 0) {
            return $result['id_membre'];
        }
        return -1;
    }

    public static function connexionMembre($login, $pass) {

        $dbClient = self::connexion();

        $stmt = $dbClient->prepare("select id_membre, login, actif, estAdmin from membres where login=? and pass=? limit 1");

        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->bindParam(2, $pass, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            if ($result['actif'] == 1) {
               
                return new Membre($result['id_membre'], $result['login'], $result['actif'], $result['estAdmin']);
            }
        }
        $db_client->close();
        return NULL;
    }

    public static function listeMessagesMembre($idMembre) {
        $dbClient = self::connexion();
        $messages = array();
        $stmt = $dbClient->prepare("select msg.*, exp.login as expLogin, dest.login as destLogin "
                . "from messages msg "
                . "left join membres exp on msg.id_expediteur = exp.id_membre "
                . "left join membres dest on msg.id_destinataire = dest.id_membre "
                . "where msg.id_destinataire=?");

        $stmt->bindParam(1, $idMembre, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
        foreach ($result as $value) {
		
            $messages[]= new Message($result['id_message'], $result['sujet'], $result['corps'], $result['id_expediteur'], $result['expLogin'],$result['id_destinataire'], $result['destLogin']);
        }
	
	
        //$dbClient->close();
        return $messages;
    }

    public static function ajouterMessage($sujet, $corps, $idMembreExp, $idMembreDest) {
	
        $dbClient = self::connexion();

        $stmt = $dbClient->prepare("insert into  messages (sujet, corps, id_expediteur, id_destinataire) values (?, ?, ?, ?)");
       
	$stmt->bindParam(1, $sujet, PDO::PARAM_STR);
        $stmt->bindParam(2, $corps, PDO::PARAM_STR);
	$stmt->bindParam(3, $idMembreExp, PDO::PARAM_INT);
        $stmt->bindParam(4, $idMembreDest, PDO::PARAM_INT);

        $result = $stmt->execute();
	return $result;
    }

    public static function listeMembres() {
	$dbClient = self::connexion();
	$membres = array();
        $stmt = $dbClient->prepare("select id_membre, login, actif, estAdmin from membres");
	$stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
	foreach ($result as $value) {
		
		$membres[] = new Membre($result['id'], $result['login'], $result['actif'], $result['estAdmin']);
	}
	return $membres;
	
    }

}

?>
