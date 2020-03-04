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
    $notation = trim(strip_tags($_POST['notation']));
    $errors = validText($errors,$notation,'notation',0,100);

    if(count($errors) == 0) {
      $success = true;
      $sql = "INSERT INTO t_notes VALUES (NULL, :user_id, :movie_id,:note,NOW(),NOW())";
      $query = $pdo->prepare($sql);
      $query->bindvalue(':user_id',$user_id,PDO::PARAM_INT);
      $query->bindValue(':movie_id',$movie_id, PDO::PARAM_STR);
      $query->bindValue(':note',$note, PDO::PARAM_STR);
      $query->execute();
      header('Location: list_note.php');
    } else {
         die('404');
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
         <input type="number" id="notation" name="notation" value="">
         <p class="error"><?php if(!empty($errors['notation'])) {echo $errors['notation'];} ?></p>

         <input type="submit" name="submitnote" value="Envoyer">
       </form>
       <?php  } ?>
    </div>




   <?php  include('inc/footer.php');
