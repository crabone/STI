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
class user {
    private $id;
    private $login;
    private $pass;
    private $actif;
    private $estAdmin;
        
    function __construct($id, $login, $pass, $actif, $estAdmin) {
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

?>
