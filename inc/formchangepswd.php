<?php
   $pageTitle = 'Mot de passe oublié';
   ?>
   <h1>Modifié votre mot de passe</h1>
   <div class="wrap" id="content">
     <form action="" method="post" novalidate>
       <label for="password">Nouveau mot de passe</label>
       <input type="password" name="password" id="password" value="">
       <p class="error"><?php if(!empty($errors['password'])) {echo $errors['password'];} ?></p>

       <label for="password2">Confirmer votre nouveau mot de passe</label>
       <input type="password" name="password2" value="">

       <input type="submit" name="submitchange" value="Valider votre nouveau mot de passe">
     </form>
   </div>
