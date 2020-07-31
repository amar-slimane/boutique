<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Inscription</title>
</head>


<body>
    <header>
        <?php 
        include 'include/header.php';
        $pdo = new userpdo();
        $pdo->register();
        ?>
    </header>
    <?php
    ?>
    <main class="d-flex justify-content-around">
        <div class="formdiv">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Login</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="t_login" required />
                    <small id="emailHelp" class="form-text text-muted">Choisissez un Login</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required />
                    <small id="emailHelp" class="form-text text-muted">Entrez votre adresse mail</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe.</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="t_mdp" required />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirmation du mot de passe.</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="t_cmdp" required />
                    <small id="emailHelp" class="form-text text-muted">Confirmez votre mot de passe.</small>
                </div>
                <button type="submit" class="btn btn-info" name="button_validation">Connexion</button>
            </form>

        </div>
    </main>
    <footer>
    </footer>
</body>

</html>