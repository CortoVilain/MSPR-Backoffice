<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration : DMO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/Pharmacies.css" />
    <link rel="stylesheet" href="css/Topbar.css" />
</head>
<body>
<header>
    <nav class="nav nav-pills nav-justified topbar">
        <a class="nav-item nav-link" href="Dmo.php">DMO</a>
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link active" href="#">Pharmacies</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<a href="#" class="btn btn-primary">Ajouter une nouvelle pharmacie</a>
<a href="#" class="btn btn-primary">Ajouter un nouveau pharmacien</a>
<h3>Liste des DMOs</h3>
<table>
    <tr>
        <td>Nom</td>
        <td>Latitude</td>
        <td>Longitude</td>
        <td>Utilisateurs</td>
    </tr>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
    $bdd->exec('SET NAMES utf8');

    $req = $bdd->prepare('SELECT * FROM Pharmacie');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) {
        $req2 = $bdd->prepare('SELECT * FROM Pharmacien WHERE idPharmacie = :idPharmacie');
        $req2->BindParam(':idPharmacie', $value['idPharmacie']);
        $req2->execute();
        $data2 = $req2->fetchAll();
        ?>
        <tr>
            <form class="form-group" method="post">
                <input type="hidden" name="id" value="<?php echo $value['idPharmacie']; ?>" />
                <td><input class="form-control" type="text" name="identifiant" value="<?php echo $value['nom']; ?>" /></td>
                <td><input class="form-control" type="text" name="prenom" value="<?php echo $value['lattitude']; ?>" /></td>
                <td><input class="form-control" type="text" name="nom" value="<?php echo $value['longitude']; ?>" /></td>
                <?php
                    foreach($data2 as $value2) { ?>
                        <td><input class="form-control" type="text" name="password" value="<?php echo $value2['prenom'].' '.$value2['nom']; ?>" /></td><?php
                    }
                ?>
                <td><input class="btn" type="submit" name="modifier" value="Modifier" /></td>
                <td><input class="btn" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
<?php
if(isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $identifiant = $_POST['identifiant'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];

    $req = $bdd->prepare('UPDATE dmo SET identifiant = :identifiant, prenom = :prenom, nom = :nom, mdp = :mdp WHERE idDmo = :id ');

    $req->bindParam(":identifiant", $identifiant);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":nom", $nom);
    $req->bindParam(":mdp", $password);
    $req->bindParam(":id", $id);
    $req->execute();

    header("Location: Dmo.php");
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM dmo WHERE idDmo = :id ');

    $req->bindParam(":id", $id);
    $req->execute();

    header("Location: Dmo.php");
}

?>
</body>
</html>