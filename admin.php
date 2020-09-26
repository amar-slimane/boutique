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
            <input type="submit" value="Ajouter un objet" class="addbutton">
        </div>

        <div class="tableau_user hidden ">
            <?php
            $affichage->tableau_user();
            ?>
        </div>

        <div class="tableau_articles hidden ">
            <?php $affichage->tableau_item(); ?>
        </div>
        <div class="ajout-item hidden ">
            <form method="post" action="" ;>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nom de l'objet</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="itm_name" required />
                    <small id="emailHelp" class="form-text text-muted">Choisissez le nom de l'objet</small>
                </div>
                <label for="select_cat">Selectionnez la catégorie</label>
                <select class="selectpicker_cat" name="selectpicker_cat" id="select_cat">

                <?php $pdo->select_cat()?>
                </select>
                <label for="select_sous_cat">Selectionnez la sous catégorie</label>
                <select class="selectpicker_sous_cat" name="selectpicker_sous_cat" id="select_sous_cat">
                <?php $pdo->select_sous_cat()?>
                </select>

                <div class="form-group">
                    <label for="exampleInputPassword1">Prix</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="price" required />
                    <small id="emailHelp" class="form-text text-muted">Entrez le prix de l'objet</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Image</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="img_item" required />
                    <small id="emailHelp" class="form-text text-muted">Entrez le lien de l'image</small>
                </div>
                <button type="submit" class="btn btn-info" name="button_validation_item">Valider</button>
            </form>

        </div>
        <div class="annonce ">
            <?php $pdo->additem() ?>
        </div>
       
    </main>
    <footer>
    </footer>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src='js/script.js'></script>


</body>

</html>