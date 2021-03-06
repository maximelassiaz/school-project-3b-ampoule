<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo isset($title) ? $title : "Votre site de gestion";?></title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestion des changements d'ampoule</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Display username and log out link in navbar if connected -->
        <?php 
            if(isset($_SESSION['username'])) {
        ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <span class="navbar-text text-white ml-auto d-sm-none d-lg-block">
                    <?php echo "Bienvenue " . htmlspecialchars($_SESSION['username']) ;?>
                </span>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        <?php
           }
        ?>        
    </nav>
    
