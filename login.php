<?php
   require('inc/func.php');
   $errors = array();

   if (getRequestValue('submitlogin'))
   {  $login = getRequestValue('login');
      $password = getRequestValue('password');
      if (empty($login) OR empty($password))
      {  $errors['login'] = 'Veuillez renseigner les deux champs';
      }
      else
      {  $user = selectUser($login);
         if (!$user OR !password_verify($password, $user['password']))
         {  $errors['login'] = 'Credentials error';
         }
         else
         {  $_SESSION['user'] = array(
               'id'     => $user['id'],
               'pseudo' => $user['pseudo'],
               'email'  => $user['email'],
               'role'   => $user['role'],
               'ip'     => $_SERVER['REMOTE_ADDR']
            );
            header('Location: index.php');
         }
      }
   }

   include('inc/html.php');
   include('inc/header.php');
   include('inc/formlogin.php');
   include('inc/footer.php');
