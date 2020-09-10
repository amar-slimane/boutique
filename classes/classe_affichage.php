<?php
include_once 'classes/bdd.php';
class affichage extends bddconnect
{

    public $page_id;

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
                        echo "<tr><td>" . $result[$i]['id'] . "</td>" .
                            "<td>" . $result[$i]['login'] . "</td>" .
                            "<td>" . $result[$i]['email'] . "</td>" .
                            "<td>" . $result[$i]['droits'] . "</td><td>";
                            ?> <a href="info-reserv.php?id=<?php echo $result[$i]['id'] ?>"><input type="submit" class="btn btn-info" value="Modifier" name="free"></a><?php 
                            echo "</td>";
                    }
              

                    ?>
            </table>
            </form>
        </div> <?php
            }
            public function tableau_item() {
                $request = $this->_bdd->prepare("SELECT * FROM article JOIN categorie ON article.id_cat = categorie.id JOIN sous_categorie ON article.id_sous_cat = sous_categorie.id");
                $request->execute();
                $result = $request->fetchAll(PDO::FETCH_ASSOC);
                if (!isset($result)) {
                    echo "il n'y a aucun article disponible";
                }
                else {
                    ?>
                    <div class=table_user>
                    <table class="table table-bordered table-sm">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th>Sous-catégorie</th>
                    <th>Actions</th>
                </tr>
                <form method="post" action="" class="formtest">
                    <?php
                for ($i = 0; $i < count($result); $i++) {
                    echo "<tr><td>" . $result[$i]['id'] . "</td>" .
                        "<td>" . $result[$i]['nom'] . "</td>" .
                        "<td>" . $result[$i]['prix'] . "</td>" .
                        "<td>" . $result[$i]['stock'] . "</td>".
                        "<td>" . $result[$i]['nom_categorie'] . "</td>".
                        "<td>" . $result[$i]['nom_sous_cat'] . "</td><td>";
                        ?> <a href="info-reserv.php?id=<?php echo $result[$i]['id'] ?>"><input type="submit" class="btn btn-info" value="Modifier" name="free"></a><?php 
                        echo "</td>";
                }
            }
            ?>
                </form>
                </table>
                    </div>
             <?php
            }
            public function tableau_categorie(){
                $request = $this->_bdd->prepare("SELECT id, login, email, droits FROM categorie INNER JOIN");
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
                                echo "<tr><td>" . $result[$i]['id'] . "</td>" .
                                    "<td>" . $result[$i]['login'] . "</td>" .
                                    "<td>" . $result[$i]['email'] . "</td>" .
                                    "<td>" . $result[$i]['droits'] . "</td><td>";
                                    ?> <a href="info-reserv.php?id=<?php echo $result[$i]['id'] ?>"><input type="submit" class="btn btn-info" value="Modifier" name="free"></a><?php 
                                    echo "</td>";
                            }
                      
        
                            ?>
                    </table>
                    </form>
                </div> <?php
            }
            public function modifier_user($iduser) {
                
            }
            public function modifier_item($iditem) {

            }
        }
