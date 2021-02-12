<?php 
    // Check if submit modify button has been pressed
    if(!isset($_POST['modify-submit'])) {
        header("Location: lightBulbList.php");
        exit();
    } else {
        $db = "ampoule";
        $host = "localhost";
        $usernameDB = "root";
        $passwordDB = ""; 

        $id = $_GET['id'];
        
        // Connection to PDO to update data
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE ampoule 
                    SET ampoule_date_changement = :date, ampoule_etage = :etage, ampoule_position = :position, ampoule_prix = :prix
                    WHERE ampoule_id = $id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':date' => $_POST['modify-date'],
                ':etage' => $_POST['modify-floor'],
                ':position' => $_POST['modify-position'],
                ':prix' => $_POST['modify-price']
            ));

            header("Location: lightBulbList.php?update=success");
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
?>