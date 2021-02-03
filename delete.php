<?php 
    $db = "ampoule";
    $host = "localhost";
    $usernameDB = "root";
    $passwordDB = ""; 

    $id = $_GET['id'];
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM ampoule WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("Location: lightBulbList.php?delete=success");
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
?>