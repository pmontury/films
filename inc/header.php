<header>
   <div class="wrap position">
      <div class="titre">
         <p><?= $pageTitle; ?></p>
      </div>
      <nav>
         <ul>
            <li><a href="index.php">Accueil</a></li>
<?php    if (!isLogged()) { ?>
            <li><a href="register.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
<?php    } else { ?>
            <li><a href="deconnexion.php">Déconnexion</a></li>
            <li class="bonjour">Bonjour <?= $_SESSION['user']['pseudo']; ?></li>
<?php    } ?>
         </ul>
      </nav>
   </div>
</header>
<!-- Début corps -->
