<?php
   require('inc/func.php');
   $pageTitle = 'Inscription';
   $errors = array();

   if (getRequestValue('submitinscription'))
   {  $pseudo = getRequestValue('pseudo');
      $email = getRequestValue('email');
      $password = getRequestValue('password');
      $password2 = getRequestValue('password2');

      $errors = verifSaisie($pseudo, 'pseudo', 3, 150, $errors);
      if (!count($errors) AND selectPseudo($pseudo))
      {  $errors['pseudo'] = 'Ce pseudo est déjà utilisé';
      }

      $errors = verifMail($email, 'email', $errors);
      if (empty($errors['email']) AND selectEmail($email))
      {  $errors['email'] = 'Cette adresse mail est déjà utilisée';
      }

      $errors = verifPasswords($password, $password2, 6, 'password', $errors);
      debug($errors);
      if (!count($errors))
      {  $hashPassword = password_hash($password, PASSWORD_DEFAULT);
         $token = generateRandomString(120);
         $role = 'abonne';
         insertUser($pseudo, $email, $hashPassword, $token, $role);
         header('Location: login.php');
      }
   }

   include('inc/html.php');
   include('inc/header.php');
   require('inc/formregister.php');
   include('inc/footer.php');
