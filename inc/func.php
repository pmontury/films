<?php
session_start();
require('pdo.php');

function br() {
  echo '<br>';
}

function debug(array $array)
{  echo '<pre>';
   print_r($array);
   echo '</pre>';
}

function debug2(array $array)
{  echo '<pre>';
   var_dump($array);
   echo '</pre>';
}

function getRequestValue($key)
{  if (isset($_REQUEST[$key]) OR !empty($_REQUEST[$key]))
      return htmlspecialchars(stripslashes(trim($_REQUEST[$key])));
   else
      return false;
}

function getErrorText($errors, $key)
{  if (count($errors) AND !empty($errors[$key]))
      return $errors[$key];
}

function generateRandomString($length = 120)
{  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++)
   {  $randomString .= $characters[rand(0, $charactersLength - 1)];
   }
   return $randomString;
}

function verifSaisie($field, $key, $minSize, $maxSize, $errors, $obligatoire = true)
{  if (empty($field))
   {  if ($obligatoire)
      {  $errors[$key] = 'Veuillez renseigner le champ';
      }
   }
   elseif (mb_strlen($field) < $minSize)
   {  $errors[$key] = 'Veuillez saisir au moins ' . $minSize . ' caractères';
   }
   elseif (mb_strlen($field) > $maxSize)
   {  $errors[$key] = 'Saisie limitée à ' . $maxSize . ' caractères';
   }
   return $errors;
}

function verifMail($field, $key, $errors, $obligatoire = true)
{  if (empty($field))
   {  if ($obligatoire)
      {  $errors[$key] = 'Veuillez renseigner l\'adresse mail';
      }
   }
   elseif (!filter_var($field, FILTER_VALIDATE_EMAIL))
   {  $errors[$key] = 'Adresse mail invalide';
   }
   return $errors;
}

function verifPasswords($pswd1, $pswd2, $minSize, $key, $errors)
{  if (empty($pswd1) OR empty($pswd2))
   {  $errors[$key] = 'Veuillez renseigner les deux mots de passe';
   }
   elseif ($pswd1 !== $pswd2)
   {  $errors[$key] = 'Les mots de passe sont différents';
   }
   elseif (mb_strlen($pswd1) < $minSize)
   {  $errors[$key] = 'Le password doit faire au moins ' . $minSize . ' caractères';
   }
   return $errors;
}

function executeSelect($query, $requestType)
{  global $pdo;
   $query->execute();
   switch ($requestType)
   {  case 'fetchAll':
         $result = $query->fetchAll();
         break;
      case 'fetchColumn':
         $result = $query->fetchColumn();
         break;
      case 'fetch':
         $result = $query->fetch();
         break;
      default:
         die('404 Type de requête pas prise en charge');
         break;
   }
   if (empty($result))
   {  $result = false;
   }
   return $result;
}

function selectCountUsers()
{  global $pdo;
   $sqlReq = "SELECT role, COUNT(*)
                FROM t_users
               GROUP BY role";
   $query = $pdo->prepare($sqlReq);
   return executeSelect($query, 'fetchAll');
}

function selectPseudo($pseudo)
{  global $pdo;
   $sqlReq = "SELECT *
                FROM t_users
               WHERE pseudo = :pseudo";
   $query = $pdo->prepare($sqlReq);
   $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
   return executeSelect($query, 'fetch');
}

function selectEmail($email)
{  global $pdo;
   $sqlReq = "SELECT *
                FROM t_users
               WHERE email = :email";
   $query = $pdo->prepare($sqlReq);
   $query->bindValue(':email', $email, PDO::PARAM_STR);
   return executeSelect($query, 'fetch');
}

function selectUser($login)
{  global $pdo;
   $sqlReq = "SELECT *
                FROM t_users
               WHERE pseudo = :login
                  OR email = :login";
   $query = $pdo->prepare($sqlReq);
   $query->bindValue(':login', $login, PDO::PARAM_STR);
   return executeSelect($query, 'fetch');
}

function selectFilm($id)
{  global $pdo;
   $sqlReq = "SELECT *
                FROM movies_full
               WHERE id = :id";
   $query = $pdo->prepare($sqlReq);
   $query->bindValue(':id', $id, PDO::PARAM_INT);
   return executeSelect($query, 'fetch');
}

function deleteFilm($id)
{  global $pdo;
   $sqlReq = "DELETE
                FROM movies_full
               WHERE id = :id";
   $query = $pdo->prepare($sqlReq);
   $query->bindValue(':id', $id, PDO::PARAM_INT);
   $result = $query->execute();
   return $result;
}

function selectUserToken($email, $token)
{  global $pdo;
   $sqlReq = "SELECT *
                FROM t_users
               WHERE email = :email
                 AND token = :token";
   $query = $pdo->prepare($sqlReq);
   $query->bindValue(':email', $email, PDO::PARAM_STR);
   $query->bindValue(':token', $token, PDO::PARAM_STR);
   return executeSelect($query, 'fetch');
}

function insertUser($pseudo, $email, $password, $token, $role)
{  global $pdo;
   $sql = "INSERT INTO t_users VALUES (NULL, :pseudo, :email, :password, NOW(), :token, :role)";
   $query = $pdo->prepare($sql);
   $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
   $query->bindValue(':email', $email, PDO::PARAM_STR);
   $query->bindValue(':password', $password, PDO::PARAM_STR);
   $query->bindValue(':token', $token, PDO::PARAM_STR);
   $query->bindValue(':role', $role, PDO::PARAM_STR);
   $result = $query->execute();
   return $result;
}

function upadtetUserPswd($id, $password, $token)
{  global $pdo;
   $sql = "UPDATE t_users
              SET password = :password, token = :token
            WHERE id = :id";
   $query = $pdo->prepare($sql);
   $query->bindValue(':id', $id, PDO::PARAM_INT);
   $query->bindValue(':password', $password, PDO::PARAM_STR);
   $query->bindValue(':token', $token, PDO::PARAM_STR);
   $result = $query->execute();
   return $result;
}

function selectCountFilms()
{  global $pdo;
   $sqlReq = "SELECT COUNT(*)
                FROM movies_full";
   $query = $pdo->prepare($sqlReq);
   return executeSelect($query, 'fetchColumn');
}

function selectFilms($limit, $offset)
{  global $pdo;
   $sqlReq = "SELECT id, slug, title, year, rating
                FROM movies_full
            ORDER BY title
               LIMIT $limit
              OFFSET $offset";
   $query = $pdo->prepare($sqlReq);
   return executeSelect($query, 'fetchAll');
}

function isLogged()
{  $roles = array('admin', 'abonne');
   if (!empty($_SESSION['user'])
      AND (!empty($_SESSION['user']['id']) AND is_numeric($_SESSION['user']['id']))
      AND (!empty($_SESSION['user']['pseudo']))
      AND (!empty($_SESSION['user']['email']))
      AND (!empty($_SESSION['user']['role']) AND in_array($_SESSION['user']['role'], $roles))
      AND (!empty($_SESSION['user']['ip']) AND $_SESSION['user']['ip'] === $_SERVER['REMOTE_ADDR']))
   {  return true;
   }
   return false;
}

function isAdmin()
{  if (isLogged() AND $_SESSION['user']['role'] === 'admin')
   {  return true;
   }
   return false;
}

function exist($file)
{
  if (file_exists($file)){
    echo $file;
  }
  else {
    echo '<img src="posters/empty.jpg">';
  }

}
function validText($errors,$value,$key,$min,$max,$empty = true)
{
  if(!empty($value)) {
    if(strlen($value) < $min) {
      $errors[$key] = 'Min '.$min.' caractères';
    } elseif(strlen($value) > $max) {
      $errors[$key] = 'Max '.$max.' caractères';
    }
  } else {
    if($empty) {
      $errors[$key] = 'Veuillez renseigner ce champ';
    }
  }
  return $errors;
}

function validFile($errors,$key,$sizemax = 2000000,$validExtensions =
array('jpg','jpeg','png','gif'),$validMimetypes = array('image/jpeg','image/png','image/jpg','image/gif'))
{
  $ext = '';
  $nameOriginal = '';
  if(empty($_FILES[$key])) {
    $errors[$key] = 'Veuillez choisir une image';
  }
  else {
    if($_FILES[$key]['error'] > 0) {
        if($_FILES[$key]['error'] != 4) {
          $errors[$key] = 'Erreur fichier ' . $_FILES[$key]['error'];
        } else {
          $errors[$key] = 'Aucun fichier n\'a été téléchargé';
        }
    } else {
      $file_name = $_FILES[$key]['name'];
      $file_size = $_FILES[$key]['size'];
      $file_tmp = $_FILES[$key]['tmp_name'];
      if($file_size > $sizemax || filesize($file_tmp) > $sizemax) {
        $errors[$key] = 'Le fichier est trop gros (max 2mo)';
      } else {
        $path = pathinfo($file_name);
        $ext = $path['extension'];
        $nameOriginal = $path['filename'];
        if(!in_array($ext,$validExtensions)){
          $errors[$key] = 'Veuillez télécharger une image de type jpg, jpeg, png ou gif svp';
        } else {
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $mime = finfo_file($finfo, $file_tmp);
          finfo_close($finfo);
          if(!in_array($mime,$validMimetypes)){
            $errors[$key] = 'Veuillez télécharger une image de type jpg, jpeg, png ou gif svp';
          }
        }
      }
    }
  }
  $data = array(
    'errors' => $errors,
    'ext'    => $ext,
    'nameOriginal' => $nameOriginal
  );
  return $data;
}
function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function verifAnnee($errors,$value,$key,$min = 1895)
{ if (empty($value))
  {
    $errors[$key] = 'Veuillez renseigner une année';
  }
  elseif (!is_int(intval($value)))
  {
    $errors[$key] = 'Veuillez renseigner une année';
  }
  elseif (intval($value) < $min)
  {
    $errors[$key] = 'Veuillez renseigner une année supérieure à' . $min;
  }
  elseif (intval($value) > date('Y'))
  {
  $errors[$key] = 'Veuillez renseigner une année inférieure à' . date('Y');
  }
  return $errors;
}

function verifInt($errors,$value,$key,$min,$max)
{
  if(!empty($value)) {
    if(!is_int(intval($value)))
    {
      $errors[$key] = 'Veuillez renseigner une valeur numérique.';
    }
    elseif(intval($value < $min))
    {
      $errors[$key] = 'Veuillez renseigner une valeur supérieure à' . $min;
    }
    elseif(intval($value > $max))
    {
      $errors[$key] = 'Veuillez renseigner une valeur inférieure à' . $max;
    }
  }
  else {
      $errors[$key] = 'Veuillez renseigner ce champ';
    }
  return $errors;
}
