<?php

if (!estConnecte() && !estAdmin()) {
    retourPageLogin();
}

$erreur ="Erreur lors de la suppression du message<br/>";
$afficherErreur=0;

if(isset($_GET['idMessage'])) {
	$ret = ConnexionDB::supprimerMessage($_GET['idMessage']);

	if(!$ret){
		$afficherErreur = 1;
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
            echo '<li><a href="?page=gestionCompte" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Gérer les comptes</span></a></li>';
        }
        ?>
        <li><a href="?page=deconnecter" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Se déconnecter</span></a></li>


    </ul>
</nav>

</div>

</div>

<div id="main">

    <?php

	if($afficherErreur == 1){
		echo '<h2>' . $erreur . '</h2>';
	} else {
		echo "Message supprimer avec succès<br\>";
	}
    ?>
</div>


<?php
require_once('html/footer.html');
?>
