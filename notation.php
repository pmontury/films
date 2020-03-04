<?php
   require('inc/func.php');
   $errors = array();
   $success = false;

   // ---------------------ajouter une note au films --------------------------//
   if(!empty($_POST['submitnote'])) {
     $notation     = trim(strip_tags($_POST['notation']));
     if(!empty($notation)) {
       if (filter_var($notation, FILTER_VALIDATE_INT)) {
         if($notation < 0) {
           $errors['notation'] = 'Veuillez renseigner une note entre 0 et 100';
         } elseif($notation > 100){
           $errors['notation'] = 'la note ne doit pas dépasser 100';
         }
       } else {
         $errors['notation'] = 'Etrange !!!';
       }
     } else {
       $errors['notation'] = 'Noter ce film';
     }
       if(count($errors) == 0) {
       $success = true;
       $movie_id = $_GET['id'];
       $user_id = $_SESSION['user']['id'];
       echo $movie_id;
       echo $user_id;
       $sql = "UPDATE t_notes SET note = :note, modified_at = NOW() WHERE user_id = :user_id AND movie_id = :movie_id  ";
       $query = $pdo->prepare($sql);
       $query->bindValue(':note',$notation,PDO::PARAM_INT);
       $query->bindValue(':user_id',$user_id,PDO::PARAM_INT);
       $query->bindValue(':movie_id',$movie_id,PDO::PARAM_INT);
       $query->execute();
       header('Location: list_note.php');
       //debug($notation);

       }
   }



include('inc/html.php');
include('inc/header.php'); ?>

<?php    if (isLogged()) { ?>
  <!--/////////// donner une note aux films  /////////////-->
  <div class="wrap" id="content">
    <form action="" method="post">
      <label for="notation">Notes</label>
      <div class="clear"></div>
      <input type="number" min="0" max="100" id="notation" name="notation" value="">
      <p class="error"><?php if(!empty($errors['notation'])) {echo $errors['notation'];} ?></p>

      <input type="submit" name="submitnote" value="Noter">
    </form>
  </div>
  <?php  } ?>
  </div>
  <?php  include('inc/footer.php');
