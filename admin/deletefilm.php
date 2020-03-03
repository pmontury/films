<?php
   require('../inc/func.php');

   if (!isAdmin())
   {  header('Location: ../index.php');
   }

   if ($id = getRequestValue('id')
       AND (selectFilm($id)))
   {  deleteFilm($id);
      header('Location: index.php');
   }
   die('404');
