<?php
if (!estConnecte()) {
    retourPageLogin();
}

$erreur ="";
$message = false;

if (isset($_GET['idMessage'])) {
    $message = ConnexionDB::getMessage($_GET['idMessage']);
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
  <center>
  <div>
	    <label>De: </label>
            <input type="text" name="login" value="<?php echo $message->getLoginExpediteur();  ?>" readonly/>
	</div>
	<div>
	    <label>date: </label>
            <input type="text" name="date" value="<?php echo $message->getDate();  ?>" readonly/>
	</div>
	<div>
	    <label>Sujet: </label>
            <input type="text" name="sujet" value="<?php echo $message->getSujet();  ?>" readonly/>
	</div>
	<div>
	    <label>Corps: </label>
            <textarea readonly><?php echo $message->getCorps();  ?> </textarea>
	</div>
	
	<td><a href="?page=repondreMessage&amp;idMessage='<?php echo $message->getId()  ?>'">Répondre</a></td>
	<td><a href="?page=supprimerMessage&amp;idMessage='<?php echo $message->getId()  ?>'">Supprimer</a></td>
	</center>
</div>



<?php
require_once('html/footer.html');
?>
