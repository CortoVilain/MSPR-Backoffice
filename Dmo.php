<!DOCTYPE html>
<html lang="en">
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');

if(isset($_POST['ajouter'])) {
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];

    $req = $bdd->prepare('INSERT INTO dmo(login, prenom, nom, mdp) VALUES(:login, :prenom, :nom, :mdp)');
    $req->bindParam(":login", $login);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":nom", $nom);
    $req->bindParam(":mdp", $password);
    $req->execute();
}

if(isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];

    $req = $bdd->prepare('UPDATE dmo SET login = :login, prenom = :prenom, nom = :nom, mdp = :mdp WHERE idDmo = :id ');

    $req->bindParam(":login", $login);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":nom", $nom);
    $req->bindParam(":mdp", $password);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM dmo WHERE idDmo = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Administration : DMO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/Dmo.css" />
    <link rel="stylesheet" href="css/Topbar.css" />
</head>
<body>
<header>
    <nav class="nav nav-pills nav-justified topbar">
        <a class="nav-item nav-link active" href="Dmo.php">DMO</a>
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link" href="Achats.php">Achats</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<a href="#" class="btn btn-primary btn-ajout">Ajouter un nouveau DMO</a>
<table>
    <tr class="tr-ajout">
        <form class="form-ajout" method="post" action="Dmo.php">
            <td><input class="form-control" type="text" name="prenom" placeholder="Prénom" /></td>
            <td><input class="form-control" type="text" name="nom" placeholder="Nom"/></td>
            <td><input class="form-control" type="text" name="login" placeholder="Login"/></td>
            <td><input class="form-control" type="text" name="password" placeholder="Mot de passe"/></td>
            <td><input class="btn btn-success" type="submit" name="ajouter" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des DMOs</h3>
<table>
    <tr>
        <td>Prénom</td>
        <td>Nom</td>
        <td>Login</td>
        <td>Mot de passe</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM DMO');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Dmo.php">
                <input type="hidden" name="id" value="<?php echo $value['idDmo']; ?>" />
                <td><input class="form-control" type="text" name="prenom" value="<?php echo $value['prenom']; ?>" /></td>
                <td><input class="form-control" type="text" name="nom" value="<?php echo $value['nom']; ?>" /></td>
                <td><input class="form-control" type="text" name="login" value="<?php echo $value['login']; ?>" /></td>
                <td><input class="form-control" type="text" name="password" value="<?php echo $value['mdp']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifier" value="Modifier" /></td>
                <td><input class="btn btn-danger" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
<script type="text/javascript" src="js/Dmo.js"></script>
</body>
</html>