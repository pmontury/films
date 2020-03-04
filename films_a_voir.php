<?php
require('inc/func.php');
  if (isLogged()) {
      if(!empty($_GET['id'])) {
            $movie_id = $_GET['id'];
            $user_id = $_SESSION['user']['id'];
            // $sql => select
            $movie = selectFilm($movie_id);
            if(!empty($movie)) {
                $sql = "INSERT INTO t_notes VALUES (NULL, :user_id, :movie_id,NULL,NOW(),NOW())";
                $query = $pdo->prepare($sql);
                $query->bindvalue(':user_id',$user_id,PDO::PARAM_INT);
                $query->bindValue(':movie_id',$movie_id, PDO::PARAM_STR);
                $query->execute();
            } else {
                die('404');
            }
      } else {
          die('404');
      }
  }
  header('Location: list_note.php');
