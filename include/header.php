<?php
session_start();
require('classes/classes.php');
require('classes/classe_affichage.php');
$pdo = new userpdo;
$affichage = new affichage;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-info">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-warning" href="index.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <a class="nav-link text-dark" href="boutique.php">Boutique</a>
      <a class="nav-link text-dark" href="contact.php">Contact</a>
      
      <?php if (isset($_SESSION['id'])) {
      ?>
        <a class="nav-link text-dark" href="profil.php">Profil</a>
        <?php
        if ($_SESSION['droits'] == "admin" || $_SESSION['droits'] == "modo") {
        ?>
          <a class="nav-link text-dark" href="admin.php">Page Admin</a>
        <?php
        }
        ?> <a class="nav-link text-secondary" href="deconnexion.php">Deconnexion</a>
      <?php
      } else {
      ?>
        <a class="nav-link" href="inscription.php">Inscription</a>
        <a class="nav-link" href="connexion.php">Connexion</a>


      <?php }
      ?>
          <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 bg-light" type="submit">Recherchez</button>
    </form>
  </div>
</nav>
</ul>