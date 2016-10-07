<?php
if (!estConnecte() && !estAdmin()) {
    retourPageLogin();
}


$membres = ConnexionDB::listeMembres();


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
    <center><h1> Liste des membres </h1></center>
	<table id="keywords">
		<thead>
	<tr>
		<th>Login</th>
		<th>Actif</th>
		<th>Admin</th>
		<th colspan="2">Actions</th>
	</tr>
</thead>
<tbody>
<?php

foreach ($membres as $membre) {
	echo '<tr>';
		echo '<td>' . $membre->getLogin() . '</td>';
		echo '<td>' . ($membre->getActif() ? 'oui' : 'non') . '</td>';
		echo '<td>' . ($membre->getEstAdmin() ? 'oui' : 'non') . '</td>';
		echo '<td><a href="?page=detailsMembre&amp;mode=edit&amp;id="' . $membre->getId() . '">Modifier</a></td>';
		echo '<td><a href="?page=supprimerMembre&amp;id=' . $membre->getId() . '">Supprimer</a></td>';
	echo '</tr>';
}
?>
    
</div>
</tbody>

</table>
<?php
require_once('html/footer.html');
?>
