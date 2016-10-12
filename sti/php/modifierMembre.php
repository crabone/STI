<?php
if (!estConnecte() && !estAdmin()) {
    retourPageLogin();
}

$erreur = "";

if (isset($_GET['idMembre'])) {
    $membre = ConnexionDB::getMembre($_GET['idMembre']);

    if ($membre == NULL) {
        $erreur = "Une erreur est survenue lors de la récupération du membre";
    }


    if (isset($_POST['pass']) && isset($_POST['passConfirmation']) && !empty($_POST['pass']) && !empty($_POST['passConfirmation'])) {

        if ($_POST['pass'] !== $_POST['passConfirmation']) {
            $erreur = "les mots de passe doivent être identiques";
        } else {

            $ret = ConnexionDB::modifierPassMembre($_GET['idMembre'], $_POST['pass']);

            if (!$ret) {
                $erreur = "Une erreur est survenue lors de la mise à jour du mot de passe";
            } else {
                if (isset($_POST['estAdmin']) || isset($_POST['actif'])) {
                    $admin = ($_POST['estAdmin'] ? 1 : 0);
                    $estActif = ($_POST['actif'] ? 1 : 0);

                    $ret = ConnexionDB::modifierMembre($_POST['idMembre'], $admin, $estActif);
                    
                    if ($ret === false ) {
                        $erreur = "Une erreur est survenue lors de la mise à jour de l'utilisateur";
                    } else {
                        echo "<h2> utilisateur modifier avec succès </h2>";
                    }
                }
            }
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
          if ($erreur !== "") {
              echo '<h3>' . $erreur . '</h3><br />';
        }
        ?>
    <form action="" method="post">
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" <?php if ($membre !== NULL) {
            echo 'readonly value="' . $membre->getLogin() . '"';
        } ?>/>
        </div>
        <div>
            <label for="pass">Nouveau mot de passe:</label>
            <input type="password" name="pass"/>
        </div>
        <div>
            <label for="passConfirmation">Nouveau mot de passe (confirmation):</label>
            <input type="password" name="passConfirmation"/>
        </div>
        <div>
            <label>
                <input type="checkbox" name="estAdmin" <?php if ($membre !== NULL) {
        echo ($membre->getEstAdmin() ? 'checked' : '');
    } ?>> Admin
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="actif" <?php if ($membre !== NULL) {
        echo ($membre->getActif() ? 'checked' : '');
    } ?>> Actif
            </label>
        </div>
        <input type="submit" value="Modifier"/>
    </form>

</div>
<?php
require_once('html/footer.html');
?>
