<?php
if (!estConnecte()) {
    retourPageLogin();
}

$erreurs = "Le pseudo du destinataire n'existe pas";
$afficherErreurs = 0;
$estEnvoye = 0;

if (isset($_GET['idMessage']) ) {

    $message = ConnexionDB::getMessage($_GET['idMessage']);
    if ($message) {

        $destinataire = ConnexionDB::getMembre($message->getIdExpediteur());

        if ($destinataire == false) {
            $erreurs = "Une erreur est survenue lors de la récupération du membre.";
	          $afficherErreurs = 1;
        }

    } else {
        $afficherErreurs = 1;
    }
}

if(isset($_POST['loginDst'])){
  $result = ConnexionDB::ajouterMessage($_POST['sujet'], $_POST['corps'],$_SESSION['id_membre'], $message->getIdExpediteur());

  if (!$result) {
      $erreurs = "Une erreur est survenue lors de l'envoi du message.";
      $afficherErreurs = 1;
  } else {
    $estEnvoye = 1;
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
                } else if ($estEnvoye == 1){
    		            echo "<h5>message envoyé avec succès</h5></br>";
    	             }
               ?>
            <fieldset>
                <input name="loginDst" placeholder="<?php echo $destinataire->getLogin(); ?>" type="text" tabindex="1" readonly>
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
