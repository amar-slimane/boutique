<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="index.css">
  <link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat|Sniglet&display=swap" rel="stylesheet">
  <title></title>
</head>

<body class="body_index">
  <header>
    <?php include 'include/header.php' ?>
  </header>


  <?php
  if (!isset($_SESSION['classuser'])) {
    $_SESSION['classuser'] = new userpdo();
  }
  $_SESSION['classuser']->disconnect();
  
  ?>
</body>