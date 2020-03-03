


  <?php
  if (!empty($_POST['submitted'])){
      debug($_POST);

      $annee = $_POST['annee'];
      $an = explode('-',$annee);
      debug($an);

      $sql = "SELECT * FROM movies_full WHERE :firstyear <= year <= :lastyear LIMIT 100";
      $query = $pdo->prepare($sql);
      $query->bindValue(':firstyear',$an['0'],PDO::PARAM_STR);
      $query->bindValue(':lastyear',$an['1'],PDO::PARAM_STR);
      $query->execute();
      $movies = $query->fetchAll(); ?>

      <?php foreach ($movies as $movie):
        $file = 'posters/'.$movie['id'].'.jpg'; ?>
        <div class="filmlist">
          <p><?= $movie['title']; ?></p>
          <p><?= $movie['year']; ?></p>
          <?php if (file_exists($file)) { ?>
            <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/<?= $movie['id'] ?>.jpg" alt="random image"></a></div>
          <?php } else { ?>
            <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/empty.jpg" alt="empty image"></a></div>
          <?php } ?>
        </div>
      <?php endforeach; ?>


  <?php } ?>





  <div class="wrap" id="content">
    <form class="" action="" method="post">

      <select name="annee">
        <option value="1920-1930">1920 1930</option>
        <option value="1930-1940">1930 1940</option>
      </select>

      <input type="checkbox" name="cat[]" value="Drama">Drama
      <input type="checkbox" name="cat[]" value="Action">Action
      <input type="checkbox" name="cat[]" value="Adventure">Adventure

      <input type="submit" name="submitted" value="recherche">

    </form>

  <!-- On va cherche dans le base de données -->
  <?php
  $sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 100";
  $query = $pdo->prepare($sql);
  $query->execute();
  $movies = $query->fetchAll(); ?>

  <!-- Ci-dessous la liste des films qui apparaît tout le temps -->
  <?php foreach ($movies as $movie):
    $file = 'posters/'.$movie['id'].'.jpg'; ?>
    <div class="filmlist">
      <p><?= $movie['title']; ?></p>
      <?php if (file_exists($file)) { ?>
        <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/<?= $movie['id'] ?>.jpg" alt="random image"></a></div>
      <?php } else { ?>
        <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/empty.jpg" alt="empty image"></a></div>
      <?php } ?>
    </div>
  <?php endforeach; ?>


  <div class="clear"></div>
  <!-- Bouton pour voir plus -->
  <div><a class="button" href="index.php">Voir plus</a></div>


  <div class="clear"></div>



</div>
