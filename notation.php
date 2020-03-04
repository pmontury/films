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
       $sql = "INSERT INTO t_notes VALUES (NULL, NULL, NULL,:note,NOW(),NOW())";
       $query = $pdo->prepare($sql);
       $query->bindValue(':note',$notation,PDO::PARAM_STR);
       $query->execute();
       header('Location: notation.php');
       //debug($notation);
       }
   }



include('inc/html.php');
include('inc/header.php'); ?>

<?php    if (isLogged()) { ?>
  <!--/////////// donner une note aux films  /////////////-->
  <form action="notation.php" method="post">
    <label for="notation">Notes</label>
    <div class="clear"></div>
    <input type="number" min="0" max="100" id="notation" name="notation" value="">
    <p class="error"><?php if(!empty($errors['notation'])) {echo $errors['notation'];} ?></p>

    <input type="submit" name="submitnote" value="Noter">
  </form>
  <?php  } ?>
  </div>
  <?php  include('inc/footer.php');
