<?php 
    if(!isset($_POST['modify-submit'])) {
        header("Location: lightBulbList.php");
        exit();
    } else {
        $db = "ampoule";
        $host = "localhost";
        $usernameDB = "root";
        $passwordDB = ""; 

        $id = $_GET['id'];
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE ampoule 
                    SET date_changement = :date, etage = :etage, position = :position, prix = :prix
                    WHERE id = $id";
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