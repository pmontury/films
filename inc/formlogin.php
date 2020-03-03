   <div class="wrap" id="content">
   <h1>Connexion</h1>
    <form class="" action="login.php" method="post">
     <label for="pseudo">Pseudo<span>*</span></label>
     <input type="text" name="login" id="login" value="<?php if(!empty($_POST['login'])){echo $_POST['login'];} ?>">
     <p class="error"></p>

     <label for="password">Mot de passe<span>*</span></label>
     <input type="password" name="password" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];} ?>">

     <p class="error"><?php if(!empty($errors['login'])) {echo $errors['login'];} ?></p>

     <input class="submit" type="submit" name="submitlogin" value="CONNEXION">
     <br>
     <a class="forgetpass" href="oublie.php">Mot de passe oublié</a>
    </form>
  </div>
