<div class="wrap" id="stats">
   <h1>Statistiques base de données</h1>
<?php
   $html = '';
   foreach ($stats as $stat)
   {  $html .= '<p>Utilisateurs inscrits avec le rôle ' . $stat['role'] . ' : ' . $stat['COUNT(*)'] . '</p>';
   }
   $html .= '<br><p>' . $totalItems .' films déclarés dans la base de données</p>';
   echo $html;
?>
</div>
