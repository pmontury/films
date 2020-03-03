<?php
   require('inc/func.php');
   include('inc/html.php');

  if (isLogged()) {
    $t_notes = $_GET['t_notes'];
    $sql = "SELECT movie_id FROM t_notes WHERE id = :id ORDER BY created_at";
    $query = $pdo->prepare($sql);
    $query->bindvalue(':t_notes',$t_notes,PDO::PARAM_STR);
    $query->execute();
     }
   include('inc/header.php');?>
   <div class="a voir">
      <h2><?= $t_notes['movie_id']; ?></h2>
   </div>

<?php  include('inc/footer.php');
