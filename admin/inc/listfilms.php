<div class="wrap">
   <div class="titresearch">
      <h1>Liste des films</h1>
   </div>
   <div class="clear"></div>
<?php
   if ($films = selectFilms($itemsPerPage, $offset))
   {  echo $paginator;
      $html = '<table>';
      $html .= '<thead><tr><th>Titre</th><th>Année</th><th>Rating</th><th>Actions</th></thead>';
      $html .= '<tbody>';
      foreach ($films as $film)
      {  $html .= '<tr>';
         $html .= '<td>' . $film['title'] . '</td>';
         $html .= '<td>' . $film['year'] . '</td>';
         $html .= '<td>' . $film['rating'] . '</td>';
         $html .= '<td class="colaction"><a href="detail.php?id=' . $film['slug'] . '"><i class="fi-eye size-30"></i></a></td>';
         $html .= '</tr>';
      }
      $html .= '</tbody>';
      $html .= '</table>';
      echo $html;
      echo $paginator;
      br();
   }
?>
</div>
