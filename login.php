<?php
    $db = "ampoule";
    $host = "localhost";
    $usernameDB = "root";
    $passwordDB = "";

    // Check if login submit button has been pressed
    if(!isset($_POST['login-submit'])) {
        header("Location: index.php");
        exit();
    } else {

        $usernameLogin = $_POST['username'];
        $passwordLogin = $_POST['pwd'];

        // Check if any field is empty
        if (empty($passwordLogin) || empty($usernameLogin)) {
            header("Location: index.php?error=emptyfields");
            exit();
        }

        // Connection to PDO to check if username exists in database
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $usernameDB, $passwordDB);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM gardien WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(
                ':username' => $_POST['username']
            ));
            // Check if there is a match for username
            $count = $stmt->rowCount();

            if($count > 0) {
                $result = $stmt->fetch();
                // Check if passwords match
                if($result['password'] === $_POST['pwd']) {
                    session_start();
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['id_gardien'] = $result['id'];
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