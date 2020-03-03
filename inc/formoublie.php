<div class="wrap" id="content">
   <h1>Mot de passe oublié</h1>
   <form class="" action="" method="post">
      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" value="">
      <p class="error"><?php if(!empty($errors['email'])) {echo $errors['email'];} ?></p>

      <input type="submit" name="submitoublie" value="Réinitialiser votre mot de passe">
   </form>
</div>
