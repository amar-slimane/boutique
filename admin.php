<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Administration</title>
</head>

<body class="adminbg">
    <header>
        <?php
        include 'include/header.php'; ?>
    </header>
    <main>
        <?php
        if ($_SESSION['droits'] != "admin" && $_SESSION['droits'] != "modo") {
            header('location:index.php');
        }
        $affichage->tableau_user();
        ?>
    </main>
    <footer>
    </footer>

</body>

</html> 