<?php
    session_start();

    // Check if submit button has been pressed
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
        $id_gardien = $_SESSION['id_gardien'];

        // Check if any field is empty
        if(empty($date) || empty($etage) || empty($position) || empty($price)) {
            header("Location: lightBulbList.php?error=emptyfields");
            exit();
        }

        // Connection to PDO to update table with new inputs
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO ampoule (date_changement, id_gardien, etage, position, prix)
                    VALUES (:date, :id_gardien, :etage,  :position, :prix)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':id_gardien', $id_gardien, PDO::PARAM_INT);
            $stmt->bindParam(':etage', $etage, PDO::PARAM_INT);
            $stmt->bindParam(':position', $position, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $price);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }

        

        header("Location: lightBulbList.php?add=success");
        exit();
    }
?>