<?php
session_start();
require('pdo.php');

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
   $sql = "INSERT INTO t_users VALUES (NULL, :pseudo, :email, :password, :token, NOW(), :role)";
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
