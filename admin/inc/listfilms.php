<div class="wrap">
   <div class="titresearch">
      <h1>Liste des films</h1>
   </div>
<?php if ($films = selectFilms($itemsPerPage, $offset)): ?>
      <?= $paginator; ?>
      <table>
         <thead>
            <tr><th>Titre</th><th class="center">Année</th><th class="center">Rating</th><th class="colaction">Actions</th></tr>
         </thead>
      <tbody>
<?php foreach ($films as $film): ?>
         <tr>
            <td><?= $film['title']; ?></td>
            <td class="center"><?= $film['year']; ?></td>
            <td class="center"><?= $film['rating']; ?></td>
            <td class="center">
               <a href="detail.php?slug=<?= $film['slug']; ?>"><i class="fi-eye size-30" title="Détails du film"></i></a>
               <a href="editfilm.php?id=<?= $film['id']; ?>"><i class="fi-pencil size-24" title="Edition"></i></a>
               <a href="deletefilm.php?id=<?= $film['id']; ?>" onclick="return confirm(\'Confirmer la suppression\')"><i class="fi-trash size-24" title="Suppression"></i></a>
            </td>
         </tr>
<?php endforeach; ?>
      </tbody>
      </table>
      <?= $paginator; ?>
      <a class="retour" href="#header"><i class="fi-arrow-up size-30" title="Retour début"></i></a>
      <div class="clear"></div>
      <br>
<?php endif; ?>
</div>
