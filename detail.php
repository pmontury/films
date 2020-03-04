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
       <?php  } ?>
    </div>




   <?php  include('inc/footer.php');
