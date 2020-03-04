<?php
   require('inc/func.php');
   $errors = array();
   $success = false;
   //------------------- details des films ----------------------------//
   if(!empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $sql = "SELECT * FROM movies_full WHERE slug = :slug";
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug',$slug,PDO::PARAM_STR);
    $query->execute();
    $film = $query->fetch();
    if(empty($film)) {die('404');}
  } else {
    die('404');
  }
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
      //header('Location: detail.php');
      debug($notation);
      }
  }

   include('inc/html.php');
   include('inc/header.php'); ?>


    <div class="wrap" id="content">
       <div class="film">
         <!--//////////// details des films ////////////////-->
          <h2><?= $film['slug']; ?></h2>
          <img src="posters/<?= $film['id'] .'.jpg' ?>" alt="<?= $film['title']; ?>">
          <h2><?= $film['directors']; ?></h2>
          <p><?= nl2br($film['plot']); ?></p>
          <p>Créé le <?php echo date('d/m/Y',strtotime($film['created'])) ?></p>
          <p>Modifié le <?php echo date('d/m/Y',strtotime($film['modified'])) ?></p>
       </div>
       <?php    if (isLogged()) { ?>
       <!--//////////// ajouter aux films à voirs ///////////////-->
       <a href="films_a_voir.php?id=<?= $film['id']; ?>">A voir</a>

       <!--/////////// donner une note aux films  /////////////-->
       <form action="detail.php" method="post">
         <label for="notation">Notes</label>
         <div class="clear"></div>
         <input type="number" min="0" max="100" id="notation" name="notation" value="">
         <p class="error"><?php if(!empty($errors['notation'])) {echo $errors['notation'];} ?></p>

         <input type="submit" name="submitnote" value="Envoyer">
       </form>
       <?php  } ?>
    </div>




   <?php  include('inc/footer.php');
