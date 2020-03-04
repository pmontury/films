<?php
   require('inc/func.php');
   $pageTitle = 'Bonjour';
   $errors = array();
   if (isLogged()) {
     $user_id = $_SESSION['user']['id'];
     $sql = "SELECT * FROM t_notes WHERE user_id = :user_id";
     $query = $pdo->prepare($sql);
     $query->bindvalue(':user_id',$user_id,PDO::PARAM_INT);
     $query->execute();
   }

   include('inc/html.php');
   include('inc/header.php');

   include('inc/footer.php');
