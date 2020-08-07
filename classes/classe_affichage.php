<?php
include_once 'classes/bdd.php';
class affichage extends bddconnect
{


    public function __construct()
    {
        parent::__construct();
    }
    public function tableau_user()
    {
        $request = $this->_bdd->prepare("SELECT id, login, email, droits FROM utilisateurs");
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
?>
        <div class=table_user>
            <table class="table table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Droits</th>
                    <th>Actions</th>
                </tr>
                <form method="post" action="">
                    <?php
                    for ($i = 0; $i < count($result); $i++) {
                        if ($_SESSION['droits'] == "admin") {
                            $select = "<select name=\"droits_user\" id=\"choix-droits\">
                        <option value=\"droit\"> --" . $result[$i]['droits'] . "--</option>
                        <option value=\"utilisateur\">utilisateur</option>
                        <option value=\"modo\">modo</option>
                        <option value=\"admin\">Admin</option>
                    </select>";
                            $button = "<td><input name=\"validation\" type=\"submit\" value=\"Valider\">" . "</td>" .
                                "<td><input name=\"supp\" type=\"submit\" value=\"Bannir\">" . "</td>" .
                                "<td><input name=\"ban\" type=\"submit\" value=\"Supprimer\">" . "</td></tr>";
                        } else if ($_SESSION['droits'] == "modo") {
                            $select = "Vous ne pouvez modifier les droits";
                            $button = "</td>" .
                                "<td><input name=\"supp\" type=\"submit\" value=\"Bannir\">" . "</td>" .
                                "<td><input name=\"ban\" type=\"submit\" value=\"Supprimer\">" . "</td></tr>";
                        }
                        echo "<tr><td>" . $result[$i]['id'] . "</td>" .
                            "<td>" . $result[$i]['login'] . "</td>" .
                            "<td>" . $result[$i]['email'] . "</td>" .
                            "<td>" . $select . "</td>" .
                            $button;
                    }
                    if (isset($_POST['validation'])) {
                        if ($_POST['droits_user'] == "utilisateur") {
                            // $value = $_POST['droits_user'];
                            // echo $value;
                            echo "toto";
                        }
                    }

                    ?>
            </table>
            </form>
        </div> <?php
            }
        }
