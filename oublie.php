<?php
   include('inc/config.php');
   require('inc/func.php');
   $pageTitle = 'Mot de passe oublié';
   $errors = array();
   $changePswd = false;

   if (getRequestValue('submitoublie'))
   {  $email = getRequestValue('email');
      if (empty($email))
      {  $errors['email'] = 'Veuillez renseigner l\'adresse mail';
      }
      else
      {  $errors = verifMail($email, 'email', $errors);
      }
      if (!count($errors))
      {  $user = selectUser($email);
         if (!$user)
         {  $errors['email'] = 'Adresse email inconnue !!';
         }
         else
         {  $changePswd = '<a href="'.$web['url_base'].'/changepswd.php?email='.urlencode($user['email']).'&token='.urlencode($user['token']).'">Changement Mot de passe</a>';
            die($changePswd);
         }
      }
   }

   include('inc/html.php');
   include('inc/header.php');
   include('inc/formoublie.php');
   include('inc/footer.php');
