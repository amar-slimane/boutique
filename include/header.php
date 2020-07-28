<?php 
require('classes/classes.php');
session_start();
$pdo = new userpdo;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-info">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-warning" href="index.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <?php if (isset($_SESSION['id'])) {
    ?>
         <a class="nav-link text-dark" href="boutique.php">Boutique</a>
          <a class="nav-link text-dark" href="profil.php">Profil</a>
          <a class="nav-link text-dark" href="contact.php">Contact</a>
          <a class="nav-link text-secondary" href="deconnexion.php">Deconnexion</a>
          <?php 
          if ($_SESSION['droits'] == "admin") {
            ?>
            <a class="nav-link text-dark" href="admin.php">Page Admin</a>
<?php
          }
          } else {
            ?>
               <a class="nav-link" href="inscription.php">Inscription</a>
               <a class="nav-link" href="connexion.php">Connexion</a>
               
          <?php }
    ?>
  </div>
</nav>
  </ul>
