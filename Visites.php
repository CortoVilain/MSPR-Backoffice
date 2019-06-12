<!DOCTYPE html>
<html lang="en">
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');


if (isset($_POST['modifier'])) {
    $id = $_POST['idPharmacie'];
    $nom = $_POST['nom'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $req = $bdd->prepare('UPDATE pharmacie SET nom = :nom, latitude = :latitude, longitude = :longitude WHERE idPharmacie = :id ');

    $req->bindParam(":nom", $nom);
    $req->bindParam(":latitude", $latitude);
    $req->bindParam(":longitude", $longitude);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['idPharmacie'];

    $req = $bdd->prepare('DELETE FROM pharmacie WHERE idPharmacie = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['modifierPharmacien'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pharmacie = $_POST['pharmacie'];

    $req = $bdd->prepare('UPDATE pharmacien SET nom = :nom, prenom = :prenom, idPharmacie = :pharmacie WHERE idPharmacien = :id ');

    $req->bindParam(":nom", $nom);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerPharmacien'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM pharmacien WHERE idPharmacien = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['ajouter-visite'])) {
    $date = $_POST['date'];
    $pharmacie = $_POST['pharmacie'];
    $dmo = $_POST['dmo'];

    $req = $bdd->prepare('INSERT INTO visite(date, idPharmacie, idDmo) VALUES(:date, :pharmacie, :dmo)');
    $req->bindParam(":date", $date);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":dmo", $dmo);
    $req->execute();
}

if(isset($_POST['ajouter-pharmacien'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $pharmacie = $_POST['pharmacie'];

    $req = $bdd->prepare('INSERT INTO pharmacien(prenom, nom, idPharmacie) VALUES(:prenom, :nom, :pharmacie)');
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":nom", $nom);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->execute();
}

?>

<!-- Le HTML -->

<head>
    <meta charset="UTF-8">
    <title>Administration : DMO</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Pharmacies.css" />
    <link rel="stylesheet" href="css/Topbar.css" />
</head>
<body>
<header>
    <nav class="nav nav-pills nav-justified topbar">
        <a class="nav-item nav-link" href="Dmo.php">DMO</a>
        <a class="nav-item nav-link active" href="Visites.php">Visites</a>
        <a class="nav-item nav-link" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<a href="#" class="btn btn-primary btn-ajout-visite">Ajouter une nouvelle visite</a>
<a href="#" class="btn btn-primary btn-ajout-questionnaire">Ajouter un nouveau questionnaire</a>
<table>
    <tr class="tr-ajout-visite" style="display: none;">
        <form class="form-ajout-visite" method="post" action="Visites.php">
            <td><input class="form-control" type="date" name="date" placeholder="Date"/></td>
            <td>
                <select class="form-control" type="select" name="pharmacie">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM Pharmacie');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['idPharmacie'] ?>"><?php echo $value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <select class="form-control" type="select" name="dmo">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM dmo');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['idDmo'] ?>"><?php echo $value['prenom'].' '.$value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="btn btn-success" type="submit" name="ajouter-visite" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-visite-annuler">Annuler</a></td>
    </tr>
</table>
<table>
    <tr class="tr-ajout-questionnaire" style="display: none;">
        <form class="form-ajout-questionnaire" method="post" action="Visites.php">
            <td><input class="form-control" type="text" name="prenom" placeholder="Prénom"/></td>
            <td><input class="form-control" type="text" name="nom" placeholder="Nom"/></td>
            <td>
                <select class="form-control" type="select" name="pharmacie">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM Pharmacie');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['idPharmacie'] ?>"><?php echo $value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="btn btn-success" type="submit" name="ajouter-questionnaire" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-questionnaire-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des pharmacies</h3>
<table>
    <tr>
        <td>Date</td>
        <td>Pharmacie</td>
        <td>Dmo</td>
        <td>Questionnaire</td>
    </tr>
    <?php

    //Je récupère toutes les Pharmacies
    $req = $bdd->prepare('SELECT * FROM Visite');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) {
        //Pour chaque pharmacie je récupère tous les pharmaciens associés
        ?>
        <tr>
            <form class="form-group" method="post" action="">
                <input type="hidden" name="idVisite" value="<?php echo $value['idVisite']; ?>" />
                <td><input class="form-control" type="text" name="date" value="<?php echo $value['date']; ?>" /></td>
                <td><input class="form-control" type="text" name="pharmacie" value="<?php echo $value['idPharmacie']; ?>" /></td>
                <td><input class="form-control" type="text" name="dmo" value="<?php echo $value['idDmo']; ?>" /></td>
                <td><input class="form-control" type="text" name="questionnaire" value="<?php echo $value['idFormulaire']; ?>" /></td>
                <td><button class="btn btn-warning" type="submit" name="modifier">Modifier</button></td>
                <td><input class="btn btn-danger" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
<script type="text/javascript" src="js/Visite.js"></script>
</body>
</html>