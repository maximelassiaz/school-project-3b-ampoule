<?php
    if(!isset($_POST['add-submit'])) {
        header("Location: lightBulbList.php");
        exit();
    } else {
        
        $db = "ampoule";
        $host = "localhost";
        $usernameDB = "root";
        $passwordDB = "";  

        $date = $_POST['add-date'];
        $etage = $_POST['select-floor'];
        $position = $_POST['select-position'];
        $price = $_POST['add-price'];

        if(empty($date) || empty($etage) || empty($positon) || empty($price)) {
            header("Location: lightBulbList.php?error=emptyfields");
            exit();
        }

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO ampoule (date_changement, etage, position, prix)
                    VALUES (:date, :etage, :position, :prix)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':date' => $date,
                ":etage" => $etage,
                ":position" => $position,
                ":prix" => $price
            ));
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }

        header("Location: lightBulbList.php?add=success");
        exit();
    }
?>