<?php 
session_start();
define('PAGE', isset($_GET['page']) ? $_GET['page'] : 'index');
require_once('php' . DIRECTORY_SEPARATOR . PAGE . '.php');
?>
