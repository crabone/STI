<?php 

function estConnecte() {
	return isset($_SESSION['id_membre']);
}

function estAdmin() {
	return isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'];
}

function retourPageLogin() {
	header('Location: ?page=login');
	die();
}

function retourPageMessages() {
	header('Location: ?page=messages');
}


?>
