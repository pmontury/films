<?php
   require('vendor/autoload.php');
   require('../inc/func.php');
   $errors = array();

   use JasonGrimes\Paginator;
   $totalItems =  selectCountFilms();
   $itemsPerPage = 100;
   $currentPage = 1;
   $offset = 0;
   if (getRequestValue('page'))
   {  $currentPage = getRequestValue('page');
      $offset = ($currentPage - 1) * $itemsPerPage;
   }
   $urlPattern = 'index.php?page=(:num)';
   $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

   // if (!isLogged())
   // {
   //
   // }

   $stats = selectCountUsers();
   // $films = selectFilms();

   include('inc/html.php');
   include('inc/header.php');
   include('inc/statsadmin.php');
   include('inc/listfilms.php');
   include('inc/footer.php');
