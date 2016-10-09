<?php
if (!estConnecte()) {
    retourPageLogin();
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

<link rel="stylesheet" type="text/css" href="css/table.css">


<div id="main">
    <center><h1> MES MESSAGES </h1></center>
    <?php
        $messages = ConnexionDB::listeMessagesMembre($_SESSION['id_membre']);
        if (empty($messages)) {
            echo '<center><p>Vous n\'avez aucun message.</p></center>';
        } else {
            echo '<table id="keywords">';
               echo '<thead>';
                    echo '<tr>';
                        echo '<th>Date</th>';
                        echo '<th>Sujet</th>';
                        echo '<th>Corps</th>';
                        echo '<th>Expediteur</th>';
			echo '<th colspan="3">Actions</th>';
                    echo '</tr>';
     		echo '</thead>';
            foreach ($messages as $message) {

                echo '<tr>';
                    echo '<td><center>' . $message->getDate() .  '</center></td>';
                    echo '<td><center>' . $message->getSujet() . '</center></td>';
                    echo '<td><center>' . substr($message->getCorps(), 0, 10) . '...</center></td>';
                    echo '<td><center>' . $message->getLoginExpediteur() .'</center></td>';
		    echo '<td><a href="?page=consulterMessage&amp;idMessage=' . $message->getId() . '">Consulter</a></td>';
		    echo '<td><a href="?page=repondreMessage&amp;idMessage=' . $message->getId() . '">Répondre</a></td>';
		    echo '<td><a href="?page=supprimerMessage&amp;idMessage=' . $message->getId() . '">Supprimer</a></td>';
                echo '</tr>';
            }
	    echo '</table>';
        }
    ?>

</div>

<?php
require_once('html/footer.html');
?>
