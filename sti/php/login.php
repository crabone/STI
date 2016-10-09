<?php
if (estConnecte()) {
    retourPageMessages();
}
$erreur ="";
if (isset($_POST['login']) && isset($_POST['pass'])) {
    $membre = ConnexionDB::connexionMembre($_POST['login'], $_POST['pass']);
    if ($membre !== NULL) {
        $_SESSION = array();
        $_SESSION['id_membre'] = $membre->getId();
        $_SESSION['estAdmin'] = $membre->getEstAdmin();
        header('Location: ?page=messages');
    } else {
        $erreur = "Ce compte n'est pas actif ou le mot de passe est incorrect";
    }
}

require_once('html/header.html');
?>
<nav id="nav">

    <ul>
        <li><a href="?page=login" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Login</span></a></li>

    </ul>
</nav>

</div>

</div>

<link rel="stylesheet" type="text/css" href="css/login.css">
<div id="main">


    <div class="login">
        <?php
            if($erreur !== "") {
              echo '<h5>' .$erreur.'</h5><br/>';
            }
        ?>
        <h1>Login</h1>
        <form method="post" action="">
            <input type="text" name="login" placeholder="Username" required />
            <input type="password" name="pass" placeholder="Password" required />
            <button type="submit" class="btn btn-primary btn-block btn-large">Se connecter</button>
        </form>
    </div>

</div>

<?php
require_once('html/footer.html');
?>
