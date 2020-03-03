<?php
   $pageTitle = 'Connection';
   ?>
   <div class="wrap" id="content">
    <form class="" action="login.php" method="post">


     <label for="pseudo">Pseudo</label>
     <input type="text" name="login" id="login" value="<?php if(!empty($_POST['login'])){echo $_POST['login'];} ?>">
     <p class="error"><?php if(!empty($errors['login'])) {echo $errors['login'];} ?></p>

     <label for="password">Mot de passe</label>
     <input type="password" name="password" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];} ?>">
     
     <a class="forgetpass" href="oublie.php">Mot de passe oublié</a>
     <p class="error"><?php if(!empty($errors['password'])) {echo $errors['password'];} ?></p>
     <input type="submit" name="submitlogin" value="CONNEXION">
    </form>
  </div>
