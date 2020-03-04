<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $user_id = $_SESSION['user']['id'];
     $sql = "SELECT * FROM t_notes WHERE user_id = :user_id ORDER BY created_at DESC";
     // Jointure +++
     // $sql = "SELECT t.user_id AS user_id,t.movie_id AS slug,u.slug
     //        FROM t_notes AS t
     //        LEFT JOIN movies_full AS m
     //        ON t.t_notes = m.movies_full";
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
        <h2><?= $film['created_at']; ?></h2>
      </div>
    <?php endforeach; ?>
  </div>
   <?php include('inc/footer.php');
