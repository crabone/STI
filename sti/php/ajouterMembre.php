<?php

if (!estConnecte() && !estAdmin()) {
    retourPageLogin();
}

$erreur = "";
$afficherSucces = 0;

$id = ConnexionDB::getIdMembre($_POST['login']);
if (isset($_POST['login']) && isset($_POST['pass'])) {
	if ($id !== -1) {
		$erreur = '<h3> Ce login existe déjà</h3>';
	} else if ($_POST['pass'] !== $_POST['passConfirmation']){
		$erreur = "<h3>Les mots de passe doivent être identiques.</h3>";
	} else {
		$estAdmin = ($_POST['estAdmin']  ? 1 : 0);
		$actif = ($_POST['actif'] ? 1 : 0);
		$ret =  ConnexionDB::ajouterMembre($_POST['login'], $_POST['pass'],$actif , $estAdmin);
		if(!$ret) {
			$erreur = "<h3> Une erreur est survenue lors de l'ajout du nouveau membre.</h3>";
		} else {
			$afficherSucces = 1;
		}
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
			if($erreur !== ""){
				echo $erreur;
			} else if ($afficherSucces == 1){
				echo"<h3> Membre ajouter avec succès</h3>";
			}
		?>
    <center>
		<form action="" method="post">
		<div>
			<label for="login">Login</label>
			<input type="text" name="login" requiered/>
		</div>
		<div>
			<label for="pass">Mot de passe:</label>
			<input type="password" name="pass"/>
		</div>
		<div>
			<label for="passConfirmation"> Confiramtion du mot de passe:</label>
			<input type="password" name="passConfirmation"/>
		</div>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="admin" /> Admin
			</label>
		</div>
		<div>
			<label>
			  <input type="checkbox" name="estActif" /> Actif
			</label>
		</div>
		<input type="submit" value="Ajouter"/>
	</form>
</center>
</div>
