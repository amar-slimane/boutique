<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Connexion</title>
</head>

<body>
    <header>
        <?php include 'include/header.php' ?>
    </header>
    <main class = "d-flex justify-content-around">
        <div class="formdiv_connexion">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Login</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="t_login" required />
                    <small id="emailHelp" class="form-text text-muted">Veuillez entrer votre login.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="t_mdp" required />
                </div>
                <button type="submit" class="btn btn-info" name="button_validation">Connexion</button>
            </form>
            <?php
            $pdo->connect();
            ?>

        </div>

    </main>
    <footer>

    </footer>

</body>

</html>