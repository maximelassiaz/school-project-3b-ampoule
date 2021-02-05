<?php 
    $title = "Dashboard";
    require "header.php";
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }
?>
<main>
    <button type="submit" class="btn btn-primary my-3 mx-5" data-toggle="collapse" data-target="#toggleForm">
            Créer une entrée
    </button>
    <div id="toggleForm" class="collapse">       
        <form class="col-sm-6 mx-auto p-3 my-5 bg-dark rounded" method="POST" action="add.php">
            <div class="form-group">
                <label for="add-date" class="text-white">Date du changement :</label>
                <input type="datetime-local" class="form-control" id="add-date" name="add-date" value="<?php echo date("Y-m-d\TH:i") ;?>" required>
            </div>
            <div class="form-group">
                <label for="select-floor" class="text-white">Étage :</label>
                <select class="form-control" id="select-floor" name="select-floor" required>
                    <?php 
                        for($i = 0; $i < 12; $i++) { ?>
                            <option value="<?= $i ;?>">
                            <?php if ($i === 0) {
                                echo "RDC";
                            } else {
                                echo "Étage $i";
                            } ?>
                            </option>
                    <?php   }  ?>
                </select>
            </div>
            <div class="form-group">
                <label for="select-position" class="text-white">Position :</label>
                <select class="form-control" id="select-position" name="select-position" required>
                    <option value="1">Droite</option>
                    <option value="2">Gauche</option>
                    <option value="3">Fond</option>
                </select>
            </div>
            <div class="form-group">
                <label for="add-price" class="text-white">Prix de l'ampoule :</label>
                <input type="number" step="any" class="form-control" id="add-price" name="add-price" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add-submit">Valider l'entrée</button>
        </form>  
    </div>

    <?php
        if(isset($_GET['add'])) {
            if($_GET['add'] === "success") {
                echo "<p class='text-success text-center font-weight-bold'>Votre nouvelle a bien été ajoutée</p>";
            }
        }

        if(isset($_GET['error'])) {
            if($_GET['error'] === "emptyfields") {
                echo "<p class='text-danger text-center font-weight-bold'>Tous les champs doivent être remplis !</p>";
            }
        }

        if(isset($_GET['update'])) {
            if($_GET['update'] === "success") {
                echo "<p class='text-success text-center font-weight-bold'>Votre modification a bien été enregistrée.</p>";
            }
        }

        if(isset($_GET['delete'])) {
            if($_GET['delete'] === "success") {
                echo "<p class='text-success text-center font-weight-bold'>La suppression a bien été effectuée.</p>";
            }
        }

    ?>


     


    <table class="table table-striped table-dark w-75 mx-auto rounded">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Date</th>
                <th scope="col">Étage</th>
                <th scope="col">Position</th>
                <th scope="col">Prix</th>
                <th scope="col" colspan="2">Gestion</th>
            </tr>
        </thead>
        <tbody>

        <?php 
            $db = "ampoule";
            $host = "localhost";
            $usernameDB = "root";
            $passwordDB = "";

            try {
                $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM ampoule ORDER BY date_changement DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $rows = $stmt->fetchAll();

                foreach($rows as $row) {
                    $datechg = new DateTime($row['date_changement']);
                    $dateFormat = date_format($datechg, 'd/m/Y - H:i'); 
                    $dateTimeFormat = date_format($datechg, "Y-m-d\TH:i") ?>

                        <tr>
                        <td><?php echo htmlspecialchars($row['id']) ;?></td>
                        <td><?php echo htmlspecialchars($dateFormat) ;?></td>
                        <td>
                            <?php 
                                if ((int)$row['etage'] === 0) {
                                    echo "RDC";
                                } else {
                                    echo htmlspecialchars($row['etage']);
                                }
                            ;?>
                        </td>
                        <td>
                            <?php 
                                $positionInt = (int)$row['position'];
                                switch ($positionInt) {
                                    case 1: 
                                        echo "Droite";
                                        break;
                                    case 2:
                                        echo "Gauche";
                                        break;
                                    case 3: 
                                        echo "Fond";
                                        break;
                                    default:
                                        echo "Non renseigné";
                                }
                            ;?>
                        </td>
                        <td><?php echo htmlspecialchars($row['prix']) ;?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="<?php echo "#modalUpdate" . htmlspecialchars($row['id']) ;?>">
                                Modifier
                            </button>

                            <div class="modal fade" id="<?php echo "modalUpdate" . htmlspecialchars($row['id']) ;?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "modalUpdateLabel" . htmlspecialchars($row['id']) ;?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo "modalUpdateLabel" . htmlspecialchars($row['id']) ;?>">Modifier une entrée</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="col-sm-6 mx-auto p-3 my-5 bg-dark rounded" method="POST" action="<?= "update.php?id=" . $row['id'] ;?>">
                                        <div class="form-group">
                                            <label for="modify-date" class="text-white">Date du changement :</label>
                                            <input type="datetime-local" class="form-control" id="modify-date" name="modify-date" value="<?php echo htmlspecialchars($dateTimeFormat) ;?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="modify-floor" class="text-white">Étage :</label>
                                            <select class="form-control" id="modify-floor" name="modify-floor" required>
                                                <option selected="selected" value="<?php echo htmlspecialchars($row['etage']) ;?>">
                                                <?php if ((int)$row['etage'] === 0) {
                                                            echo "RDC";
                                                        } else {
                                                            echo "Étage " . htmlspecialchars($row['etage']);
                                                        } ?>
                                                </option>
                                                <?php 
                                                    for($i = 0; $i < 12; $i++) { ?>
                                                        <option value="<?= $i ;?>">
                                                        <?php if ($i === 0) {
                                                            echo "RDC";
                                                        } else {
                                                            echo "Étage $i";
                                                        } ?>
                                                        </option>
                                                <?php   }  ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="modify-position" class="text-white">Position :</label>
                                            <select class="form-control" id="modify-position" name="modify-position" required>
                                                <option selected=selected value="<?php echo htmlspecialchars($row['position']) ;?>">
                                                    <?php 
                                                        $positionInt = (int)$row['position'];
                                                        switch ($positionInt) {
                                                            case 1: 
                                                                echo "Droite";
                                                                break;
                                                            case 2:
                                                                echo "Gauche";
                                                                break;
                                                            case 3: 
                                                                echo "Fond";
                                                                break;
                                                            default:
                                                                echo "Non renseigné";
                                                        }
                                                    ?>
                                                </option> 
                                                <option value="1">Droite</option>
                                                <option value="2">Gauche</option>
                                                <option value="3">Fond</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="modify-price" class="text-white">Prix de l'ampoule :</label>
                                            <input type="number" step="any" class="form-control" id="modify-price" name="modify-price" value="<?php echo htmlspecialchars($row['prix']) ;?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="modify-submit">Valider l'entrée</button>
                                    </form>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#modalDelete" . htmlspecialchars($row['id']) ;?>">
                                Supprimer
                            </button>

                            <div class="modal fade" id="<?php echo "modalDelete" . htmlspecialchars($row['id']) ;?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "modalDeleteLabel" . htmlspecialchars($row['id']) ;?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo "modalDeleteLabel" . htmlspecialchars($row['id']) ;?>">Supprimer une entrée</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger font-weight-bold">Attention la suppression d'un historique est définitive !</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a class="btn btn-danger" href="<?php echo "delete.php?id=" . htmlspecialchars($row['id']) ?>;" role="button">Supprimer définitivement</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                <?php        
                }
            } catch (PDOException $e) {
                die("Erreur : " . $e->getMessage());
            }
        ?>
        </tbody>
    </table> 

        <tbody>
        
        </tbody>
    </table>
    <div id="overlay"></div>
</main>

<?php 
    require "footer.php";
?>