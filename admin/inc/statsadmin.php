<div class="wrap">
   <h1>Statistiques base de données</h1>
<?php
   $html = '';
   foreach ($stats as $stat)
   {  $html .= '<p>Utilisateurs inscrits avec le rôle ' . $stat['role'] . ' : ' . $stat['COUNT(*)'] . '</p>';
   }
   echo $html;
?>
</div>
