<?php
   require('../inc/func.php');
   $errors = array();

   if (!isAdmin())
   {  header('Location: ../index.php');
   }

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
      <h2><?= $film['slug']; ?></h2>
      <img src="../posters/<?= $film['id'] .'.jpg' ?>" alt="<?= $film['title']; ?>">
      <h2><?= $film['directors']; ?></h2>
      <p><?= nl2br($film['plot']); ?></p>
      <p>Créé le <?php echo date('d/m/Y',strtotime($film['created'])) ?></p>
      <p>Modifié le <?php echo date('d/m/Y',strtotime($film['modified'])) ?></p>
   </div>
   <?php    if (isAdmin()) { ?>
   <a onclick="['notes']" href="films_a_voir.php">à voir</a>
   <?php  } ?>

</div>
<?php  include('inc/footer.php');
