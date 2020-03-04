<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $movie_id = $_GET['id'];
     $user_id = $_SESSION['user']['id'];
     $sql = "SELECT * FROM t_notes WHERE id = :id";
     $query = $pdo->prepare($sql);
     $query->bindvalue(':user_id',$user_id,PDO::PARAM_INT);
     $query->bindValue(':movie_id',$movie_id, PDO::PARAM_STR);
     $query->bindValue(':modified_at', $modified_at, PDO::PARAM_STR);
     $query->execute();
   }
   header('Location: list_note.php');

   include('inc/html.php');
   include('inc/header.php');

   include('inc/footer.php');
