<?php 
    $title = "Connexion";
    require "header.php";
?>

<main >
    <form method="POST" action="login.php">
            <label for="username">Identifiant :</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="pwd" class="">Mot de passe :</label><br>
            <input type="password" id="pwd" name="pwd"><br>
            <button type="submit" name="login-submit">Se connecter</button>
    </form>

<?php
    if(isset($_GET['login'])) {
        if($_GET['login'] === "fail") {
            echo "Votre identifiant et/ou votre mot de passe est incorrect.";
        }
    }
?>    
</main>

<?php
    require "footer.php";
?>