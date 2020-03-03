<?php
$sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 100";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll(); ?>



<div class="wrap" id="content">
  <?php foreach ($movies as $movie): ?>
    <div class="filmlist">
      <p><?= $movie['title']; ?></p>
      <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/<?= $movie['id'] ?>.jpg" alt="random image"></a></div>
    </div>
  <?php endforeach; ?>
    <div class="clear">

    </div>

</div>
