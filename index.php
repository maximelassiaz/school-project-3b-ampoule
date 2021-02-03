<?php 
    $title = "Connexion";
    require "header.php";
?>

<main>
    <form>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Identifiant :</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" id="username" name="username">
        </div>
    </div>
    <div class="form-group row">
        <label for="pwd" class="col-sm-2 col-form-label">Mot de passe :</label>
        <div class="col-sm-6">
        <input type="password" class="form-control" id="pwd" name="pwd">
        </div>
    </div>
    <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>
  </div>
    </form>
</main>

<?php
    require "footer.php";
?>