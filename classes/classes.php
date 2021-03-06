<?php
include_once 'bdd.php';
class userpdo extends bddconnect 
{
    public $id = "";
    public $login = "";
    public $password = "";
    public $email = "";
    public $droits = "";

    public function register()
    {
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
                    $_SESSION['id'] = $result['id'];
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
                            var_dump($this->email);
                            var_dump("toto");
                            $data = [
                                'login' => $this->login,
                                'email' => $this->email
                            ];
                            echo " login modifié en " . $this->login;
                        } else {
                            $this->email = $_POST['email'];
                            var_dump($this->email);
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
}
