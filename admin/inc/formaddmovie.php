
<div class="wrap" id="content">
  <h1>Ajouter un film</h1>
  <!-- Div du css -->
  <form class="" action="" method="post" enctype="multipart/form-data">
    <!-- Début du formulaire du film -->
    <label for="title">Titre du film</label>
    <input type="text" name="title" value="<?php if(!empty($_POST['title'])){echo $_POST['title'];} ?>">
    <p class="error"><?php if(!empty($errors['title'])){echo $errors['title'];} ?></p>

    <label for="picture">Ajouter une photo</label>
    <input type="file" name="picture" value="<?php if(!empty($_POST['picture'])){echo $_POST['picture'];} ?>">
    <p class="error"><?php if(!empty($errors['picture'])){echo $errors['picture'];} ?></p>

    <label for="year">Année du film</label>
    <input type="text" name="year" value="<?php if(!empty($_POST['year'])){echo $_POST['year'];} ?>">
    <p class="error"><?php if(!empty($errors['year'])){echo $errors['year'];} ?></p>

    <label for="genre">Genre du film</label>
    <input type="text" name="genre" value="<?php if(!empty($_POST['genre'])){echo $_POST['genre'];} ?>">
    <p class="error"><?php if(!empty($errors['genre'])){echo $errors['genre'];} ?></p>

    <label class="labelText" for="plot">Synopsis du film</label>
    <textarea class="textnosize" name="plot" rows="8" cols="80"><?php if(!empty($_POST['plot'])){echo $_POST['plot'];} ?></textarea>
    <p class="error"><?php if(!empty($errors['plot'])){echo $errors['plot'];} ?></p>

    <label for="dik">Réalisateur du film</label>
    <input type="text" name="dik" value="<?php if(!empty($_POST['dik'])){echo $_POST['dik'];} ?>">
    <p class="error"><?php if(!empty($errors['dik'])){echo $errors['dik'];} ?></p>

    <label for="cast">Acteurs du film</label>
    <input type="text" name="cast" value="<?php if(!empty($_POST['cast'])){echo $_POST['cast'];} ?>">
    <p class="error"><?php if(!empty($errros['cast'])){echo $errors['cast'];} ?></p>

    <label for="auteur">Auteur du film</label>
    <input type="text" name="auteur" value="<?php if(!empty($_POST['auteur'])){echo $_POST['auteur'];} ?>">
    <p class="error"><?php if(!empty($errors['auteur'])){echo $errors['auteur'];} ?></p>

    <label for="runtime">Durée du film</label>
    <input type="text" name="runtime" value="<?php if(!empty($_POST['runtime'])){echo $_POST['runtime'];} ?>">
    <p class="error"><?php if(!empty($errors['runtime'])){echo $errors['runtime'];} ?></p>

    <label for="mpaa">Limitation d'age du film</label>
    <input type="text" name="mpaa" value="<?php if(!empty($_POST['mpaa'])){echo $_POST['mpaa'];} ?>">
    <p class="error"><?php if(!empty($errors['mpaa'])){echo $errors['mpaa'];} ?></p>

    <label for="popu">Popularité du film</label>
    <input type="text" name="popu" value="<?php if(!empty($_POST['popu'])){echo $_POST['popu'];} ?>">
    <p class="error"><?php if(!empty($errors['popu'])){echo $errors['popu'];} ?></p>

    <input class="submitlefilm" type="submit" name="submitfilm" value="Envoyer">
  </form>
</div>
