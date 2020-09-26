<?php
include_once 'bdd.php';
class userpdo extends bddconnect 
{
    public $id = "";
    public $login = "";
    public $password = "";
    public $email = "";
    public $droits = "";
    public $cat_id = "";
    public $sous_cat_id = "";

    public function register()
    {
        if (isset($_SESSION['id'])){
            header("location:index.php");
        }
        if (isset($_POST['button_validation'])) {
            $login = htmlspecialchars($_POST['t_login']);
            $password = htmlspecialchars($_POST['t_mdp']);
            $passwordconfirm = htmlspecialchars($_POST['t_cmdp']);
            $email = htmlspecialchars($_POST['email']);
            $request =  $this->_bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $request->execute(array($login));
            $result = $request->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result)) {
                echo "Ce login est déjà utilisé";
            } else if ($passwordconfirm != $password) {
                echo "les mdp ne correspondent pas";
            } else if (empty($result) && $password == $passwordconfirm) {
                $pass = password_hash($password, PASSWORD_BCRYPT);
                $request = $this->_bdd->prepare("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `droits`) VALUES (:login, :password, :email, :droits)");
                $data = [
                    'login' => $login,
                    'password' => $pass,
                    'email' => $email,
                    'droits' => 'utilisateur',
                ];
                $request->execute($data);
                echo "le compte a été créer";
                header("Refresh:1; url=connexion.php");
            }
        }
    }

    public function connect()
    {
        if (isset($_SESSION['login'])) {

            header("location:index.php");
        }

        if (isset($_POST['button_validation'])) {
            $login = htmlspecialchars($_POST['t_login']);
            $password = htmlspecialchars($_POST['t_mdp']);
            $request = $this->_bdd->prepare("SELECT * FROM utilisateurs WHERE login =?");
            $request->execute(array($login));
            $result = $request->fetch(PDO::FETCH_ASSOC);

            if (empty($login)) {
                echo "Veuillez entrer un login.";
            }

            if (empty($password)) {
                echo "Veuillez entrer un mot de passe.";
            }
            if (empty($result)) {
                echo "ce compte n'existe pas.";
            } else {
                if (password_verify($password, $result['password'])) {
                    $this->id = $result['id'];
                    $this->login = $result['login'];
                    $this->password = $result['password'];
                    $this->droits = $result['droits'];
                    $_SESSION['id'] = $this->id;
                    $_SESSION['login'] = $this->login;
                    $_SESSION['droits'] = $this->droits;
                    echo "Félicitation, vous voilà connecté !";
                    header("Refresh:1; url=index.php");
                } else {
                    echo "Le mot de passe n'est pas bon.";
                }
            }
        }



        if (isset($_SESSION['id'])) {
            header("location:index.php");
        }
    }
    public function disconnect()
    {
        if (isset($_SESSION['id'])) {
            session_unset();
            session_destroy();
            header("location:index.php");
        }
        else {
            header("location:index.php");
        }
    }
    public function update()
    {

        if (isset($_POST['button_validation'])) {
            $request = $this->_bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
            $request->execute(array($_SESSION['id']));
            $result = $request->fetch(PDO::FETCH_ASSOC);
            $log = htmlspecialchars($_POST['t_login']);
            $pass = htmlspecialchars($_POST['t_mdp']);
            $newconfirm = htmlspecialchars($_POST['t_cmdp']);
            $newpass = htmlspecialchars($_POST['new_mdp']);
            $email = htmlspecialchars($_POST['email']);
            $this->login = $_SESSION['login'];
            $this->password = $result['password'];
            $this->email = $result['email'];

            if (!empty($pass)) {

                if (!empty($result)) {
                    if (password_verify($pass, $result['password'])) {

                        if (!empty($log)) {
                            $request = $this->_bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
                            $request->execute(array($log));
                            $result = $request->fetchAll(PDO::FETCH_ASSOC);

                            if ($result != NULL) {
                                echo "ce login est déjà pris";
                            } else {
                                $this->login = $log;
                                $_SESSION['login'] = $log;
                            }
                        }
                        if (!empty($newpass) && $this->password != $pass &&  $newpass == $newconfirm) {
                            $this->password = $newconfirm;
                            $pass = password_hash($this->password, PASSWORD_DEFAULT);
                            $request = $this->_bdd->prepare("UPDATE utilisateurs SET password=? WHERE id =" . $_SESSION["id"]);
                            $request->execute(array($pass));
                            echo "le mot de passe a été modifié avec succès";
                        } else if ($newpass != $newconfirm) {
                            echo "les mot de passe ne correspondent pas";
                        }
                        if (empty($email)) {
                            $data = [
                                'login' => $this->login,
                                'email' => $this->email
                            ];
                            echo " login modifié en " . $this->login;
                        } else {
                            $this->email = $_POST['email'];
                            $data = [
                                'login' => $this->login,
                                'email' => $this->email
                            ];
                            echo " login modifié en " . $this->login . " email modifié en " . $this->email;
                        }
                        $request2 = $this->_bdd->prepare("UPDATE utilisateurs SET login=:login, email=:email  WHERE id =" . $_SESSION["id"]);
                        $request2->execute($data);
                    } else {
                        echo " Le mot de passe est erronné";
                    }
                }
            } else {
                echo "Veuillez entre votre mot de passe.";
            }
        }
    }
    public function additem() {

        if (isset($_POST['button_validation_item'])){
            $itemname = $_POST['itm_name'];
            $itemcat = $_POST['selectpicker_cat'];
            $itemsouscat = $_POST['selectpicker_sous_cat'];
            $price = $_POST['price'];
            $img = $_POST['img_item'];
           $request = $this->_bdd->prepare("SELECT * FROM article WHERE nom = :nomarticle");
           $data = [
            'nomarticle' => $itemname
           ];
           $request->execute($data);
           $result = $request->fetchAll(PDO::FETCH_ASSOC);
           var_dump($itemcat);

           if (empty($itemname)){
               echo "Veuillez entrez un nom d'objet.";
           }
        
           if (empty($price)) {
               echo "veuillez entrer un prix en pièce d'or.";
           }
           if (!empty($result)){
            echo "Cet article existe déjà, et n'a donc pas été ajouté.";
           }
           else {
               
           }
        }
    }

    

    public function select_cat() {
        $arr_c = [];
        $request = $this->_bdd->prepare("SELECT * FROM categorie");
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($result); $i++) {
            $cat = $result[$i]['nom_categorie']
            ?> <option> <?=$cat;?></option><?php
            array_push($arr_c, $cat);
        }
    
    }
    public function select_sous_cat() {
        $arr_sc = [];
        $request = $this->_bdd->prepare("SELECT * FROM sous_categorie");
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($result); $i++) {
            ?> <option> <?=$result[$i]['nom_sous_cat'];?></option> 
            <?php
        }
    }
}
