<div class="wrap">
   <div class="titresearch">
      <h1>Liste des films</h1>
   </div>
   <div class="clear"></div>
<?php
   if ($films = selectFilms($itemsPerPage, $offset))
   {  echo $paginator;
      $html = '<table>';
      $html .= '<thead><tr><th>Titre</th><th class="center">Année</th><th class="center">Rating</th><th class="center">Actions</th></thead>';
      $html .= '<tbody>';
      foreach ($films as $film)
      {  $html .= '<tr>';
         $html .= '<td>' . $film['title'] . '</td>';
         $html .= '<td class="center">' . $film['year'] . '</td>';
         $html .= '<td class="center">' . $film['rating'] . '</td>';
         $html .= '<td class="center">';
         $html .= '<a href="detail.php?slug=' . $film['slug'] . '"><i class="fi-eye size-30" title="Détails du film"></i></a>';
         $html .= '<a href="editfilm.php?id=' . $film['id'] . '"><i class="fi-pencil size-24" title="Edition"></i></a>';
         $html .= '<a href="deletefilm.php?id=' . $film['id'] . '" onclick="return confirm(\'Confirmer la suppression\')"><i class="fi-trash size-24" title="Suppression"></i></a>';
         $html .= '</td>';
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
