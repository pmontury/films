<?php
   require('inc/func.php');
   include('inc/html.php');

  if (isLogged()) {
    $movie_id = $_GET['id'];
    $sql = "SELECT * FROM t_notes WHERE movie_id = :movie_id ORDER BY created_at ASC";
    $query = $pdo->prepare($sql);
    $query->bindvalue(':movie_id',$movie_id,PDO::PARAM_INT);
    $query->execute();
    $note = $query->fetchAll();
     }
  if (isLogged()) {

    $sql "INSERT INTO t_notes VALUES (NULL, :user_id, :movie_id,NULL,NOW(),:modified_at)";
    $query = $pdo->prepare($sql);
    $query->bindvalue(':user_id',$user_id,PDO::PARAM_INT);
    $query->bindValue(':movie_id',$movie_id, PDO::PARAM_STR);
    $query->bindValue(':modified_at', $modified_at, PDO::PARAM_STR);
    $query->execute();
  }
     //debug($note);
   include('inc/header.php');?>
   <div class="a voir">
      <h2><?= $note['id']; ?></h2>
   </div>

<?php  include('inc/footer.php');
