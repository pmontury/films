   <!-- Début du formulaire d'inscription -->
   <div class="wrap" id="content">
      <h1>Inscription</h1>
     <form class="" action="register.php" method="post" novalidate>
       <!-- Pseudo -->
       <label for="pseudo">Pseudo<span>*</span></label>
       <input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])){echo $_POST['pseudo'];} ?>">
       <p class="error"><?php if(!empty($errors['pseudo'])) {echo $errors['pseudo'];} ?></p>
       <!-- Email -->
       <label for="email">E-mail<span>*</span></label>
       <input type="email" name="email" value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} ?>">
       <p class="error"><?php if(!empty($errors['email'])) {echo $errors['email'];} ?></p>
       <!-- Mot de passe -->
       <label for="password">Mot de passe<span>*</span></label>
       <input type="password" name="password" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];} ?>">
       <p class="error"><?php if(!empty($errors['password'])) {echo $errors['password'];} ?></p>
       <!-- Confirmation de mot de passe -->
       <label for="password2">Confirmer mot de passe<span>*</span></label>
       <input type="password" name="password2" value="<?php if(!empty($_POST['password2'])){echo $_POST['password2'];} ?>">
       <p class="error"></p>

       <input class="submit" type="submit" name="submitinscription" value="Inscription">
     </form>
   </div>
