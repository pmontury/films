<?php
require('inc/func.php');
  if (isLogged()) {
    $movie_id = $_GET['id'];
    $user_id = $_SESSION['user']['id'];
    $sql = "INSERT INTO t_notes VALUES (NULL, :user_id, :movie_id,NULL,NOW(),NOW())";
    $query = $pdo->prepare($sql);
    $query->bindvalue(':user_id',$user_id,PDO::PARAM_INT);
    $query->bindValue(':movie_id',$movie_id, PDO::PARAM_STR);
    $query->bindValue(':modified_at', $modified_at, PDO::PARAM_STR);
    $query->execute();
  }
  header('Location: list_note.php');
