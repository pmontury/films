<?php
require('../inc/func.php');

$errors = array();
$success = false;

if(!empty($_POST['submitfilm'])) {
  $validfile = validFile($errors,'picture');
  $errors = $validfile['errors'];
  $ext = $validfile['ext'];
  $nameOriginal = $validfile['nameOriginal'];


  $rating = 'rating';
  $flag = 'flag';

  $title       = trim(strip_tags($_POST['title']));
  $year        = trim(strip_tags($_POST['year']));
  $genre       = trim(strip_tags($_POST['genre']));
  $plot        = trim(strip_tags($_POST['plot']));
  $dik         = trim(strip_tags($_POST['dik']));
  $cast        = trim(strip_tags($_POST['cast']));
  $auteur      = trim(strip_tags($_POST['auteur']));
  $runtime     = trim(strip_tags($_POST['runtime']));
  $mpaa        = trim(strip_tags($_POST['mpaa']));
  $popu        = trim(strip_tags($_POST['popu']));

  $errors = validText($errors,$title,'title',3,150);
  $errors = verifAnnee($errors,$year,'year');
  $errors = validText($errors,$genre,'genre',1,30);
  $errors = validText($errors,$plot,'plot',30,2000);
  $errors = validText($errors,$dik,'dik',1,30);
  $errors = validText($errors,$cast,'cast',1,255);
  $errors = validText($errors,$auteur,'auteur',1,255);
  $errors = verifInt($errors,$runtime,'runtime',1,300);
  $errors = validText($errors,$mpaa,'mpaa',1,30);
  $errors = verifInt($errors,$mpaa,'popu',0,100);

  if(count($errors) == 0) {
        $text = slugify($title . ' ' . $year);

          $success = true;
          $sql = "INSERT INTO movies_full VALUES (NULL,:slug,:title,:year,:genres,:plot,:directors,:cast,:writers,:runtime,:mpaa,:rating,:popularity,NOW(),NOW(),:poster_flag)";
          $query = $pdo->prepare($sql);
          $query->bindValue(':slug',$text,PDO::PARAM_STR);
          $query->bindValue(':title',$title,PDO::PARAM_STR);
          $query->bindValue(':year',$year,PDO::PARAM_INT);
          $query->bindValue(':genres',$genre,PDO::PARAM_STR);
          $query->bindValue(':plot',$plot,PDO::PARAM_STR);
          $query->bindValue(':directors',$dik,PDO::PARAM_STR);
          $query->bindValue(':cast',$cast,PDO::PARAM_STR);
          $query->bindValue(':writers',$auteur,PDO::PARAM_STR);
          $query->bindValue(':runtime',$runtime,PDO::PARAM_INT);
          $query->bindValue(':mpaa',$mpaa,PDO::PARAM_STR);
          $query->bindValue(':rating',$rating,PDO::PARAM_INT);
          $query->bindValue(':popularity',$popu,PDO::PARAM_INT);
          $query->bindValue(':poster_flag',$flag,PDO::PARAM_INT);
          $query->execute();
          $sql = "SELECT id FROM movies_full WHERE slug = :slug";
          $query = $pdo->prepare($sql);
          $query->bindValue(':slug',$text,PDO::PARAM_STR);
          $query->execute();
          $result = $query->fetch();
          echo $text;
           debug($result);
         $newNameFile = $result['id'] . '.' . $ext;
         if(!is_dir('../posters')) { mkdir('../posters'); }
         $pathToImage = '../posters/'.$newNameFile;

          if(move_uploaded_file($_FILES['picture']['tmp_name'],$pathToImage)){
          // header('Location: index.php');
        } else {
            $errors['image'] = 'upload non effectué';
        }
    }
  }

  include('inc/html.php');
  include('inc/header.php');
  include('inc/formaddmovie.php');
  include('inc/footer.php');
