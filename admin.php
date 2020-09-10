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
        ?>
        <div class="button_suite">
            <input type="submit" class="button_user" value="Utilisateurs">
            <input type="submit" value="Objets" class="itembutton">
        </div>

        <div class="tableau_user hidden ">
            <?php
            $affichage->tableau_user();
            ?>
        </div>

        <div class="tableau_articles hidden ">
            <?php $affichage->tableau_item(); ?>
        </div>
    </main>
    <footer>
    </footer>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src='js/script.js'></script>
    

</body>

</html>