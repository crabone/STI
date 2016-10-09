<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/php/modele.php');
require_once($root.'/php/fonctions.php');

$sitePages = array('index', 'login', 'messages', 'deconnecter', 'envoyerMessage', 'gestionCompte', 'supprimerMembre',
                  'modifierMembre', 'ajouterMembre', 'consulterMessage', 'supprimerMessage', 'repondreMessage');

define('PAGE', (isset($_GET['page']) && in_array( $_GET['page'],$sitePages)) ? $_GET['page'] : 'index');
require_once($root.'/php/' . PAGE . '.php');

?>
