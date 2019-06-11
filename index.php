<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <div class="logo">
        <img src="images/logo_nivantis.png" />
    </div>
    <div class="formulaire">
        <form method="POST" class="form-group">
            <h3>Connexion</h3>

            <label for="login">Login :</label>
            <input type="text" id="login" name="login" class="form-control" />

            <label for="password">Mot de passe : </label>
            <input type="password" id="password" name="password" class="form-control" />

            <input type="submit" class="btn" id="submit" name="submit" value="Se connecter" />
        </form>
    </div>
</body>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');

if(isset($_POST['submit']) && issert($_POST['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

	$req = $bdd->prepare("SELECT mdp FROM dmo WHERE login = :login");
    $req->bindParam(":login", $login);
    $req->execute();
    $data = $req->fetch();

    if($data['mdp'] == $password) {
        header('Location: Dmo.php');
    }
	else {
	    header('Location: index.php');
	}
}
?>
</html>