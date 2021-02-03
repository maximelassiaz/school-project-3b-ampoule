<?php
    $db = "ampoule";
    $host = "localhost";
    $usernameDB = "root";
    $passwordDB = "";

    if(!isset($_POST['login-submit'])) {
        header("Location: index.php");
        exit();
    } else {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM gardien WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':username' => $_POST['username']
            ));
            $count = $stmt->rowCount();

            if($count > 0) {
                $result = $stmt->fetch();
                if($result['password'] === $_POST['pwd']) {
                    session_start();
                    $_SESSION['username'] === $_POST['username'];
                    header("Location: lightBulbList.php");
                    exit();
                } else {
                    header("Location: index.php?login=fail");
                    exit();
                }
            } else {
                header("Location: index.php?login=fail");
                exit();
            }
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }    
?>