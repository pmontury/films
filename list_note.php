<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $user_id = $_SESSION['user']['id'];
     //$sql = "SELECT * FROM t_notes WHERE user_id = :user_id ORDER BY created_at DESC";
     $sql = "SELECT * FROM t_notes n
        LEFT JOIN movies_full m
               ON n.movie_id = m.id
            WHERE n.user_id = :userid
              AND n.note IS NULL
         ORDER BY n.created_at DESC";
     $query = $pdo->prepare($sql);
     $query->bindValue(':userid',$user_id,PDO::PARAM_INT);
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
        <h2><?= $film['slug']; ?></h2>
        <a href="notation.php?id=<?= $film['id']; ?>">Noter</a>
      </div>
    <?php endforeach; ?>
  </div>
   <?php include('inc/footer.php');
