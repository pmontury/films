

  <div class="buttonbox">
    <a class="button" href="#" onclick="return false">Filtrer</a>
  </div>
  <?php
  if (!empty($_POST['submitted'])){
      // Déclaration générale sql
      $sql = "SELECT * FROM movies_full WHERE 1=1";
      // If année renseignée
      if (!empty($_POST['annee'])) {
        $annee = trim(strip_tags($_POST['annee']));
        $an = explode('-',$annee);
        $sql .= " AND year BETWEEN :firstyear AND :lastyear";
      } // Fin du if catégorie renseignée
      if (!empty($_POST['cat'])){
        $categories = $_POST['cat'];
        $i = 1;
      //  debug($categories);
        foreach ($categories as $categorie) {
          if($i == 1){
            $sql .= " AND ( genres LIKE :categorie".$i;
          } else {
            $sql .= " OR genres LIKE :categorie".$i;
          }
          $i++;
        }
        $sql .= ')';

      }
      // Fin de la déclaration générale
      $sql .= " ORDER BY RAND() LIMIT 100";

      // On tape enfin dans le SQL
      $query = $pdo->prepare($sql);


      if (!empty($_POST['annee'])){
        $query->bindValue(':firstyear',$an['0'],PDO::PARAM_STR);
        $query->bindValue(':lastyear',$an['1'],PDO::PARAM_STR);
      }
      if (!empty($_POST['cat'])){
        $i = 1;
        foreach ($categories as $categorie) {
          $cate = trim(strip_tags($categorie));
          $query->bindValue(':categorie'.$i,'%'.$cate.'%',PDO::PARAM_STR);
          $i++;
        }
      }


        $query->execute();
        $movies = $query->fetchAll();
        //debug($movies);
}  else {
  $sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 100";
    $query = $pdo->prepare($sql);
        $query->execute();
  $movies =  $query->fetchAll();
} ?>


<div class="wrap">
  <div class ="critere">

    <form class="" action="" method="post">
      <select name="annee">
        <option value="">no</option>
        <option value="1920-1930">1920 1930</option>
        <option value="1930-1940">1930 1940</option>
      </select>

      <?php $types = array('Drama', 'Action', 'Adventure', 'Horror', 'Sci-Fi');
      foreach ($types as $type) { ?>
      <input type="checkbox" name="cat[]" value="<?= $type ?>" <?php if(!empty($_POST['submitted']) AND !empty($categories) AND in_array($type,$categories)) { ?> checked="checked" <?php } ?>><?= $type ?>
      <!-- <input type="checkbox" name="cat[]" value="Action">Action
      <input type="checkbox" name="cat[]" value="Adventure">Adventure
      <input type="checkbox" name="cat[]" value="Horror">Horror
      <input type="checkbox" name="cat[]" value="Sci-Fi">Sci-Fi -->
    <?php } ?>

      <input type="submit" name="submitted" value="recherche">

    </form>
  </div>
<?php
        foreach ($movies as $movie):
          $file = 'posters/'.$movie['id'].'.jpg'; ?>
          <div class="filmlist">
            <div class= "containp">
              <p><?= $movie['title']; ?></p>
              <p><?= $movie['year']; ?></p>
              <p><?= $movie['genres']; ?></p>
            </div>
            <?php if (file_exists($file)) { ?>
              <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/<?= $movie['id'] ?>.jpg" alt="random image"></a></div>
            <?php } else { ?>
              <div><a href="detail.php?slug=<?= $movie['slug'] ?>"><img src="posters/empty.jpg" alt="empty image"></a></div>
            <?php } ?>
          </div>
        <?php endforeach; ?>
  <div class="clear"></div>
</div>
