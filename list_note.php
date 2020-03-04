<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $user_id = $_SESSION['user']['id'];
     //$sql = "SELECT * FROM t_notes WHERE user_id = :user_id ORDER BY created_at DESC";
     $sql = "SELECT * FROM notes n
        LEFT JOIN movies_full m
               ON n.movie_id = m.id
            WHERE n.user_id = :userid
              AND n.note IS NULL
         ORDER BY n.created_at DESC";
     $query = $pdo->prepare($sql);
     $query->bindValue(':userid',$userid,PDO::PARAM_STR);
     //$query->bindValue(':slug',$slug,PDO::PARAM_STR);
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
