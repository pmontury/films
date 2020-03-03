<?php
   require('inc/func.php');
   $pageTitle = 'Changement du mot de passe';
   $errors = array();

   $email = getRequestValue('email');
   $token = getRequestValue('token');
   if (!$email OR !$token)
   {  die ('404');
   }
   else
   {  $user = selectUserToken(urldecode($email), urldecode($token));
      if (!$user)
      {  die ('404');
      }
   }

   if (isset($_REQUEST['formchange']) AND getRequestValue('submitchange'))
   {  $password = getRequestValue('password');
      $password2 = getRequestValue('password2');

      $errors = verifPasswords($password, $password2, 6, 'password', $errors);

      if (!count($errors))
      {  $hashPassword = password_hash($password, PASSWORD_DEFAULT);
         $token = generateRandomString(120);
         upadtetUserPswd($user['id'], $hashPassword, $token);
         header('Location: login.php');
      }
   }
   include('inc/html.php');
   include('inc/header.php');
   include('inc/formchangepswd.php');
   include('inc/footer.php');
