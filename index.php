<?php 
    $title = "Connexion";
    require "header.php";
?>

<main class="landing-page">

<form class="col-sm-6 mx-auto bg-dark p-3 rounded" method="POST" action="login.php">
    <div class="form-group">
        <label for="username" class="text-white">Identifiant : </label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
        <label for="pwd" class="text-white">Mot de passe :</label>
        <input type="password" class="form-control" id="pwd" name="pwd">
    </div>
    <button type="submit" name="login-submit" class="btn btn-primary ml-auto">Se connecter</button>
    </form>



    <?php
        if(isset($_GET['error'])) {
            if($_GET['error'] === "emptyfields") {
                echo "<p class='text-danger font-weight-bold mt-5'>Vous devez remplir votre identifiant et votre mot de passe pour vous connecter.</p>";
            }
        }

        if(isset($_GET['login'])) {
            if($_GET['login'] === "fail") {
                echo "<p class='text-danger font-weight-bold mt-5'>Votre identifiant et/ou votre mot de passe est incorrect.</p>";
            }
        }
    ?>   
</main>

<?php
    require "footer.php";
?>