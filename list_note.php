<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $user_id = $_SESSION['user']['id'];
     $sql = "SELECT * FROM t_notes ORDER BY movie_id ASC";
     $query = $pdo->prepare($sql);
     $query->execute();
     $films = $query->fetchAll();
   }
   debug($films);

   include('inc/html.php');
   include('inc/header.php');
    foreach ($films as $film): ?>
      <div class="film">
        <h2><?= $film['movie_id']; ?></h2>
      </div>
    <?php endforeach; ?>

   <?php include('inc/footer.php');
