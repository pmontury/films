<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $user_id = $_SESSION['user']['id'];
     $sql = "SELECT * FROM t_notes WHERE user_id = :user_id ORDER BY created_at DESC";
     // Jointure +++
     $query = $pdo->prepare($sql);
     $query->bindValue(':user_id',$user_id,PDO::PARAM_STR);
     $query->execute();
     $films = $query->fetchAll();
   } else {
        die ('404');
   }
   debug($films);

   include('inc/html.php');
   include('inc/header.php');?>
  <div class="wrap" id="content">
    <?php foreach ($films as $film): ?>
      <div class="film">
        <h2><?= $film['movie_id']; ?></h2>
      </div>
    <?php endforeach; ?>
  </div>
   <?php include('inc/footer.php');
