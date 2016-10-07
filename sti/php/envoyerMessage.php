<?php
if (!estConnecte()) {
    retourPageLogin();
}

$erreurs = "Le pseudo du destinataire n'existe pas";
$afficherErreurs = 0;

if (isset($_POST['loginDst']) && isset($_POST['sujet']) && isset($_POST['corps'])) {
    
    $idMembreDst = ConnexionDB::getIdMembre($_POST['loginDst']);
    echo "id Membre ".$idMembreDst;
    if ($idMembreDst != -1) {
	
        $result = ConnexionDB::ajouterMessage( $_POST['sujet'], $_POST['corps'],$_SESSION['id_membre'], $idMembreDst);
	
        if ($result == false) {
            $erreurs .= " ou une erreur est survenue lors de l'envoi du message.";
	    $afficherErreurs = 1;
        } 
        
    } else {
        $afficherErreurs = 1;
    }
}

require_once('html/header.html');
?>

<nav id="nav">

    <ul>
        <li><a href="?page=messages" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Mes messages</span></a>
        </li>

        <li><a href="?page=envoyerMessage" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Envoyer un message</span></a>
        </li>
<?php
if (estAdmin()) {
    echo '<li><a href="?page=gestionCompte" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Gérer les compte</span></a></li>';
}
?>
        <li><a href="?page=deconnecter" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Se déconnecter</span></a></li>


    </ul>
</nav>

</div>

</div>

<link rel="stylesheet" type="text/css" href="css/message.css">
<div id="main">
    <div class="container">  
        
        <form id="contact"  method="post" action="">
            <h3>Envoyer un message</h3>
	<?php 
            if ($afficherErreurs == 1) {
                echo "<h5>". $erreurs ."</h5><br>";
            } else {
		echo "message envoyé avec succès";
	    }
        ?>
            <fieldset>
                <input name="loginDst" placeholder="Pseudo destinataire" type="text" tabindex="1" required>
            </fieldset>
            <fieldset>
                <input  name="sujet" placeholder="Sujet" type="text" tabindex="2">
            </fieldset>
            <fieldset>
                <textarea name="corps" placeholder="Tapez votre message ici..." tabindex="5"></textarea>
            </fieldset>
            <fieldset>
                <button type="submit" id="contact-submit">Envoyer</button>
            </fieldset>
        </form>


    </div>
</div>
