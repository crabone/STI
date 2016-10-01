<?php

require_once('../html' . DIRECTORY_SEPARATOR . 'header.html');
   
?>


<form action="" method="post">
    <div class="form-group">
        <label for="username">Login:</label>
        <input type="text" name="username" value="<?php if (isset($_POST['login'])) { echo $_POST['login']; } ?>" class="form-control" />
    </div>
    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" class="form-control" />
    </div>
    <input type="submit" value="Login" class="btn btn-default" />
</form>
