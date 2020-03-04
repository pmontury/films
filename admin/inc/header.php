<header id="header">
   <div class="wrap position">
      <div class="logo">
         <a href="../index.php"><img src="asset/img/bobine.jpg" alt="bobine de film"></a>
      </div>
      <div class="titre">
         <p>Les films d'Antoine</p>
      </div>
      <nav>
         <ul>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="index.php">Admin</a></li>
            <li><a href="addmovie.php">Ajouter un film</a></li>
            <li><a href="../deconnexion.php">Déconnexion</a></li>
            <li class="bonjour">Bonjour <?= $_SESSION['user']['pseudo']; ?></li>
         </ul>
      </nav>
   </div>
</header>
<!-- Début corps -->
