<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Amine Tayaa
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
    private $date;
    private $sujet;
    private $corps;
    private $idExpediteur;
    private $loginExpediteur;
    private $idDestinataire;
    private $loginDestinataire;

    function __construct($id, $date, $sujet, $corps, $idExpediteur, $loginExpediteur, $idDestinataire, $loginDestinataire) {
        $this->id = $id;
        $this->date = $date;
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

    function getDate() {
        return $this->date;
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
        if ($dbPDO = new PDO('sqlite:/var/www/databases/STI.db')) {
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
        if ($result) {
            return $result['id_membre'];
        }

        return -1;
    }

    public static function getMembre($idMembre) {
        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("select login, actif, estAdmin from membres where id_membre=? limit 1");
        $stmt->bindParam(1, $idMembre, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return new Membre($idMembre, $result['login'], $result['actif'], $result['estAdmin']);
        }
        return false;
    }

    public static function modifierPassMembre($idMembre, $pass) {
        $dbClient = self::connexion();

        $stmt = $dbClient->prepare("update membres set pass=? where id_membre=?");
        $stmt->bindParam(1, $pass, PDO::PARAM_STR);
        $stmt->bindParam(2, $idMembre, PDO::PARAM_INT);
        $ret = $stmt->execute();
        $dbClient = NULL;
        return $ret;
    }

    public static function modifierMembre($idMembre, $estAdmin, $actif) {
        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("select count(*) as nbrAdmin from membres where estAdmin=1 and actif=1 and id_membre <> ?");
        $stmt->bindParam(1, $idMembre, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['nbrAdmin'] !== 1 && $estAdmin == 0 && $actif == 0) {
            $dbClient = NULL;
            return false;
        } else {
          $stmt = NULL;
          try {
            $dbClient = NULL;
            echo 'arrive la avec actif ' . $actif . ' et estAdmin ' . $estAdmin . ' ';

            $dbClient = self::connexion();
            //$dbClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dbClient->prepare("update membres set estAdmin=?, actif=? where id_membre=?");

            $stmt->bindParam(1, $estAdmin, PDO::PARAM_BOOL);
            $stmt->bindParam(2, $actif, PDO::PARAM_BOOL);
            $stmt->bindParam(3, $idMembre, PDO::PARAM_INT);

            $result = $stmt->execute();
            $dbClient = NULL;
            var_dump($result);
            return $result;
          }catch(PDOExcetion $e){
             echo $e->getMessage();
          }
        }
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
        $db_client = NULL;
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
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $value) {

            $messages[] = new Message($value['id_message'], $value['date'], $value['sujet'], $value['corps'], $value['id_expediteur'], $value['expLogin'], $value['id_destinataire'], $value['destLogin']);
        }


        $dbClient = NULL;
        return $messages;
    }

    public static function ajouterMembre($login, $pass, $actif, $estAdmin) {



        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("insert into membres (login, pass, actif, estAdmin) values (?, ?, ?, ?)");

        $stmt->bindParam(1, $login, PDO::PARAM_STR);
        $stmt->bindParam(2, $pass, PDO::PARAM_STR);
        $stmt->bindParam(3, $actif, PDO::PARAM_INT);
        $stmt->bindParam(4, $estAdmin, PDO::PARAM_INT);

        $res = $stmt->execute();
        $dbClient = NULL;
        return $res;
    }

    public static function ajouterMessage($sujet, $corps, $idMembreExp, $idMembreDest) {

        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("insert into  messages (date, sujet, corps, id_expediteur, id_destinataire) values (datetime(),?, ?, ?, ?)");

        $stmt->bindParam(1, $sujet, PDO::PARAM_STR);
        $stmt->bindParam(2, $corps, PDO::PARAM_STR);
        $stmt->bindParam(3, $idMembreExp, PDO::PARAM_INT);
        $stmt->bindParam(4, $idMembreDest, PDO::PARAM_INT);
        $result = $stmt->execute();
        $dbClient =NULL;
        return $result;
    }

    public static function listeMembres() {
        $dbClient = self::connexion();
        $dbClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $membres = array();

        $result = $dbClient->query("select id_membre, login, actif, estAdmin from membres");

        foreach ($result as $value) {
            $membres[] = new Membre($value['id_membre'], $value['login'], $value['actif'], $value['estAdmin']);
        }
        $dbClient =NULL;
        return $membres;
    }

    public static function getMessage($idMessage) {
        $dbClient = self::connexion();

        $stmt = $dbClient->prepare("select msg.date, msg.sujet, mb.login, mb.id_membre, msg.corps,msg.id_expediteur, msg.id_destinataire
                    from messages msg
                        inner join membres mb
                          on msg.id_destinataire = mb.id_membre
                        where id_message = ?");

        $stmt->bindParam(1, $idMessage, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            //$dbClient = NULL;

            $exp = ConnexionDB::getMembre($result['id_expediteur']);
            $dest = ConnexionDB::getMembre($result['id_destinataire']);
            return new Message($idMessage, $result['date'], $result['sujet'], $result['corps'], $result['id_expediteur'], $exp->getLogin(), $result['id_destinataire'], $dest->getLogin());
        }
        $dbClient = NULL;
        return false;
    }

    public static function supprimerMembre($idMembre) {

        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("select count(*) as nbrAdmin from membres where estAdmin=1 and actif=1 and id_membre <> ?");
        $stmt->bindParam(1, $idMembre, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['nbrAdmin'] > 0) {
            $stmt = $dbClient->prepare("delete from membres where id_membre=?");
            $stmt->bindParam(1, $idMembre, PDO::PARAM_INT);
            $res = $stmt->execute();
            $db_client = NULL;
            return $res;
        }

        return false;
    }

    public static function supprimerMessage($idMessage) {
        $dbClient = self::connexion();
        $stmt = $dbClient->prepare("delete from messages where id_message=?");
        $stmt->bindParam(1, $idMessage, PDO::PARAM_INT);
        $res = $stmt->execute();
        $db_client = NULL;
        return $res;
    }

}

?>
