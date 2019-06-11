<!DOCTYPE html>
<html lang="en">
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');

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
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM dmo WHERE idDmo = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['ajouter-pharmacie'])) {
    $nom = $_POST['nom'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $req = $bdd->prepare('INSERT INTO pharmacie(nom, latitude, longitude) VALUES(:nom, :latitude, :longitude)');
    $req->bindParam(":nom", $nom);
    $req->bindParam(":latitude", $latitude);
    $req->bindParam(":longitude", $longitude);
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
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link active" href="#">Pharmacies</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<a href="#" class="btn btn-primary btn-ajout-pharmacie">Ajouter une nouvelle pharmacie</a>
<table>
    <tr class="tr-ajout-pharmacie">
        <form class="form-ajout-pharmacie" method="post" action="Pharmacies.php">
            <td><input class="form-control" type="text" name="nom" /></td>
            <td><input class="form-control" type="text" name="latitude" /></td>
            <td><input class="form-control" type="text" name="longitude" /></td>
            <td><input class="btn" type="submit" name="ajouter-pharmacie" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-primary btn-ajout-pharmacie-annuler">Annuler</a></td>
    </tr>
</table>
<a href="#" class="btn btn-primary btn-ajout-pharmacien">Ajouter un nouveau pharmacien</a>
<table>
    <tr class="tr-ajout-pharmacien">
        <form class="form-ajout-pharmacien" method="post" action="Pharmacies.php">
            <td><input class="form-control" type="text" name="prenom" /></td>
            <td><input class="form-control" type="text" name="nom" /></td>
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
            <td><input class="btn" type="submit" name="ajouter-pharmacien" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-primary btn-ajout-pharmacien-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des pharmacies</h3>
<table>
    <tr>
        <td>Nom</td>
        <td>Latitude</td>
        <td>Longitude</td>
        <td>Pharmacien</td>
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
            <form class="form-group" method="post" action="Pharmacies.php">
                <input type="hidden" name="id" value="<?php echo $value['idPharmacie']; ?>" />
                <td><input class="form-control" type="text" name="identifiant" value="<?php echo $value['nom']; ?>" /></td>
                <td><input class="form-control" type="text" name="prenom" value="<?php echo $value['latitude']; ?>" /></td>
                <td><input class="form-control" type="text" name="nom" value="<?php echo $value['longitude']; ?>" /></td>
                <?php
                if(!($data2 == null)) { ?>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static">Liste pharmaciens</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Liste des pharamaciens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td>Prénom</td>
                                            <td>Nom</td>
                                            <td>Pharmacie</td>
                                        </tr>

                                        <?php

                                        $req3 = $bdd->prepare('SELECT * FROM pharmacien');
                                        $req3->execute();
                                        $data3 = $req3->fetchAll();

                                        foreach($data3 as $value3) { ?>
                                            <tr>
                                                <form class="form-group" method="post" action="Pharmacies.php">
                                                    <input type="hidden" name="id" value="<?php echo $value3['idPharmacien']; ?>" />
                                                        <td><input class="form-control" type="text" name="prenom" value="<?php echo $value3['prenom']; ?>" /></td>
                                                        <td><input class="form-control" type="text" name="nom" value="<?php echo $value3['nom']; ?>" /></td>
                                                        <td><input class="form-control" type="text" name="pharmacie" value="<?php echo $value3['idPharmacie']; ?>" /></td>
                                                        <td><input class="btn" type="submit" name="modifier" value="Modifier" /></td>
                                                        <td><input class="btn" type="submit" name="supprimer" value="Supprimer" /></td>
                                                </form>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <?php }
                else { ?>
                    <td>Aucun Pharmacien</td>
                <?php } ?>
                <td><input class="btn" type="submit" name="modifier" value="Modifier" /></td>
                <td><input class="btn" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>