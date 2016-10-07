<?php 
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/php/modele.php');
require_once($root.'/php/fonctions.php');

define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'index');
require_once($root.'/php/' . PAGE . '.php');

?>
