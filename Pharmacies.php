<!DOCTYPE html>
<html lang="en">
<?php
include ('lib/bdd_connexion.php');


if (isset($_POST['modifier'])) {
    $id = $_POST['id_pharmacie'];
    $nom = $_POST['nom'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $req = $bdd->prepare('UPDATE pharmacie SET nom = :nom, latitude = :latitude, longitude = :longitude WHERE id_pharmacie = :id ');

    $req->bindParam(":nom", $nom);
    $req->bindParam(":latitude", $latitude);
    $req->bindParam(":longitude", $longitude);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['id_pharmacie'];

    $req = $bdd->prepare('DELETE FROM pharmacie WHERE id_pharmacie = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['modifierPharmacien'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pharmacie = $_POST['idPharma'];

    $req = $bdd->prepare('UPDATE pharmacien SET nom = :nom, prenom = :prenom, id_pharmacie = :pharmacie WHERE id_pharmacien = :id ');

    $req->bindParam(":nom", $nom);
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerPharmacien'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM pharmacien WHERE id_pharmacien = :id ');

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

    $req = $bdd->prepare('INSERT INTO pharmacien(prenom, nom, id_pharmacie) VALUES(:prenom, :nom, :pharmacie)');
    $req->bindParam(":prenom", $prenom);
    $req->bindParam(":nom", $nom);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->execute();
}

?>

<!-- Le HTML -->

<head>
    <meta charset="UTF-8">
    <title>Administration : Pharmacies</title>
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
        <a class="nav-item nav-link active" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link" href="Achats.php">Achats</a>
        <a class="nav-item nav-link" href="Formations.php">Formations</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<body>
<div class="container">
<a href="#" class="btn btn-primary btn-ajout-pharmacie">Ajouter une nouvelle pharmacie</a>
<a href="#" class="btn btn-primary btn-ajout-pharmacien">Ajouter un nouveau pharmacien</a>
<table>
    <tr class="tr-ajout-pharmacie" style="display: none;">
        <form class="form-ajout-pharmacie" method="post" action="Pharmacies.php">
            <td><input class="form-control" type="text" name="nom" placeholder="Nom"/></td>
            <td><input class="form-control" type="text" name="latitude" placeholder="Latitude"/></td>
            <td><input class="form-control" type="text" name="longitude" placeholder="Longitude"/></td>
            <td><input class="btn btn-success" type="submit" name="ajouter-pharmacie" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-pharmacie-annuler">Annuler</a></td>
    </tr>
</table>
<table>
    <tr class="tr-ajout-pharmacien" style="display: none;">
        <form class="form-ajout-pharmacien" method="post" action="Pharmacies.php">
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
                        <option value="<?php echo $value['id_pharmacie'] ?>"><?php echo $value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="btn btn-success" type="submit" name="ajouter-pharmacien" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-pharmacien-annuler">Annuler</a></td>
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

    //Je récupère toutes les Pharmacies
    $req = $bdd->prepare('SELECT * FROM Pharmacie');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) {
        //Pour chaque pharmacie je récupère tous les pharmaciens associés 
        $req2 = $bdd->prepare('SELECT * FROM Pharmacien WHERE id_pharmacie = :id_pharmacie');
        $req2->BindParam(':id_pharmacie', $value['id_pharmacie']);
        $req2->execute();
        $data2 = $req2->fetchAll();
        ?>
        <tr>
            <form class="form-group" method="post" action="">
                <input type="hidden" name="id_pharmacie" value="<?php echo $value['id_pharmacie']; ?>" />
                <td><input class="form-control" type="text" name="nom" value="<?php echo $value['nom']; ?>" /></td>
                <td><input class="form-control" type="text" name="latitude" value="<?php echo $value['latitude']; ?>" /></td>
                <td><input class="form-control" type="text" name="longitude" value="<?php echo $value['longitude']; ?>" /></td>
                <?php
                if(!($data2 == null)) { ?>
                 <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal<?php echo $value['id_pharmacie'] ?>">Liste pharmaciens</button></td>
                <?php }
                else { ?>
                    <td>Aucun Pharmacien</td>
                <?php } ?>

                <td><button class="btn btn-warning" type="submit" name="modifier">Modifier</button></td>
                <td><input class="btn btn-danger" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>

<!-- Le Modal -->
<?php
//Je récupère toutes les Pharmacies
    $reqoui = $bdd->prepare('SELECT * FROM Pharmacie');
    $reqoui->execute();
    $datasa = $reqoui->fetchAll();

    foreach($datasa as $value) {
        //Pour chaque pharmacie je récupère tous les pharmaciens associés 
        $reqkoi = $bdd->prepare('SELECT * FROM Pharmacien WHERE id_pharmacie = :id_pharmacie');
        $reqkoi->BindParam(':id_pharmacie', $value['id_pharmacie']);
        $reqkoi->execute();
        $dataseb = $reqkoi->fetchAll();
?>

<div class="modal fade" id="modal<?php echo $value['id_pharmacie'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Liste des pharamaciens</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="modal-body">
                                    <table>
                                        <tr>
                                            <td>Prénom</td>
                                            <td>Nom</td>
                                            <td>Pharmacie</td>
                                        </tr>

                                        <?php
                                        foreach($dataseb as $value2) { ?>
                                            <tr>
                                                <form class="form-group" method="post" action="">
                                                    <input type="hidden" name="id" value="<?php echo $value2['id_pharmacien']; ?>" />
                                                        <td><input class="form-control" type="text" name="prenom" value="<?php echo $value2['prenom']; ?>" /></td>
                                                        <td><input class="form-control" type="text" name="nom" value="<?php echo $value2['nom']; ?>" /></td>
                                                        <td>
                                                            <select class="form-control" type="select" name="idPharma">
                                                                <?php
                                                                $req = $bdd->prepare('SELECT * FROM Pharmacie WHERE id_pharmacie = :id_pharmacie');
                                                                $req->BindParam(':id_pharmacie', $value['id_pharmacie']);
                                                                $req->execute();
                                                                $data = $req->fetchAll();
                                                                ?>
                                                                    <option value="<?php echo $value['id_pharmacie'] ?>"><?php echo $value['nom'] ?></option>
                                                                <?php
                                                                $req = $bdd->prepare('SELECT * FROM Pharmacie WHERE id_pharmacie != :id_pharmacie');
                                                                $req->BindParam(':id_pharmacie', $value['id_pharmacie']);
                                                                $req->execute();
                                                                $data2 = $req->fetchAll();

                                                                foreach($data2 as $value2) {
                                                                    ?>
                                                                    <option value="<?php echo $value2['id_pharmacie'] ?>"><?php echo $value2['nom'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td><button class="btn btn-warning" type="submit" name="modifierPharmacien">Modifier</td>
                                                        <td><button class="btn btn-danger" type="submit" name="supprimerPharmacien">Supprimer</td>
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
                                    <?php } ?>
<script type="text/javascript" src="js/Pharmacie.js"></script>
</div>
</body>
</html>