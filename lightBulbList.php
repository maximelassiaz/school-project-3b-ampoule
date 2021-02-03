<?php 
    $title = "Dashboard";
    require "header.php";
    // if(isset($_SESSION['username'])) {
?>


<main>
    <button type="button" class="btn btn-primary">Ajouter un changement</button>

    <form method="POST" action="add.php">
        <div class="form-group row">
            <label for="add-date" class="col-sm-2 col-form-label">Date du changement :</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="add-date" name="add-date">
            </div>
        </div>
        <div class="form-group row">
            <label for="select-floor" class="col-sm-2 col-form-label">Étage :</label>
            <select name="select-floor" class="form-control col-sm-10" id="select-floor">
                <?php 
                    for($i = 0; $i < 12; $i++) {
                        echo "<option value=$i>";
                        if ($i === 0) {
                            echo "RDC";
                        } else {
                            echo "Étage $i";
                        }
                        echo "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group row">
            <label for="select-position" class="col-sm-2 col-form-label">Position :</label>
            <select class="form-control col-sm-10" id=select-position" name="select-position">
                <option value="1">Droite</option>
                <option value="2">Gauche</option>
                <option value="3">Fond</option>
            </select>
        </div>
        <div class="form-group row">
            <label for="add-price" class="col-sm-2 col-form-label">Prix :</label>
            <div class="col-sm-10">
                <input type="number" step="any" class="form-control" id="add-price" name="add-price">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" name="add-submit">Soumettre</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead class="thead-dark">
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

                    echo "<tr><td>" . $row['id'] . "</td>";
                    echo "<td>" . $dateFormat . "</td>";
                    echo "<td>" . $row['etage'] . "</td>";
                    echo "<td>" . $row['position'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td><button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modifyModal" . $row['id'] . "'>
                    Modifier
                    </button></td>";
                    echo "<div class='modal fade' id='modifyModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='modifyModalLabel" . $row['id'] . "' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='modifyModalLabel" . $row['id'] . "'>Modifier un changement d'ampoule</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>

                                <form method='POST' action='update.php?id=" . $row['id'] . "'>
                                    <div class='form-group row'>
                                        <label for='modify-date' class='col-sm-2 col-form-label'>Date du changement :</label>
                                        <div class='col-sm-10'>
                                            <input type='datetime-local' class='form-control' id='modify-date' name='modify-date' value='" . $row['date_changement'] . "'>
                                        </div>
                                    </div>
                                    <div class='form-group row'>
                                        <label for='modify-floor' class='col-sm-2 col-form-label'>Étage :</label>
                                        <select name='modify-floor' class='form-control col-sm-10' id='modify-floor'>
                                                <option value=" . $row['etage'] . " selected='selected'>Étage " . $row['etage'] . "</option> ";
                                         
                                                for($i = 0; $i < 12; $i++) {
                                                    echo "<option value=$i>";
                                                    if ($i === 0) {
                                                        echo "RDC";
                                                    } else {
                                                        echo "Étage $i";
                                                    }
                                                    echo "</option>";
                                                }
                            
                                        echo "</select>
                                    </div>
                                    <div class='form-group row'>
                                        <label for='modify-position' class='col-sm-2 col-form-label'>Position :</label>
                                        <select class='form-control col-sm-10' id='modify-position' name='modify-position'>
                                            <option value='1'>Droite</option>
                                            <option value='2'>Gauche</option>
                                            <option value='3'>Fond</option>
                                        </select>
                                    </div>
                                    <div class='form-group row'>
                                        <label for='modify-price' class='col-sm-2 col-form-label'>Prix :</label>
                                        <div class='col-sm-10'>
                                            <input type='number' step='any' class='form-control' id='modify-price' name='modify-price' value=" . $row['prix'] . ">
                                        </div>
                                    </div>
                                <div class='form-group row'>
                                    <div class='col-sm-10'>
                                    <button type='submit' class='btn btn-primary' name='modify-submit'>Soumettre</button>
                                    </div>
                                </div>
                            </form>

                            </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>";
                    echo "<td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal' " . $row['id'] . " >
                    Supprimer
                    </button></td></tr>";

                    echo "<div class='modal fade' id='deleteModal'" . $row['id'] . "  tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'" . $row['id'] . " aria-hidden='true'>

                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel'" . $row['id'] . " >Modal title</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <p> Attention, vous allez supprimer définitivement un élément de l'historique.</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fermer</button>
                                <a class='btn btn-danger' href='delete.php?id=" . $row['id'] ."' role='button'>Supprimer définitivement</a>
                            </div>
                        </div>
                    </div>
                    </div>";
                }
            } catch (PDOException $e) {
                die("Erreur : " . $e->getMessage());
            }
        ?>
        </tbody>
    </table>

</main>

<?php
    // } else {
    //     header("Location: index.php");
    //     exit();
    // }
?> 

<?php 
    require "footer.php";
?>