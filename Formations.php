<!DOCTYPE HTML>
<html lang="en">
<?php
include ('lib/bdd_connexion.php');

if(isset($_POST['ajouterFormation'])) {
$libelle = $_POST['libelle'];
$date = $_POST['date'];
$description = $_POST['description'];

$req = $bdd->prepare('INSERT INTO formation(libelle, date, description) VALUES(:libelle, :date, :description)');
$req->bindParam(":libelle", $libelle);
$req->bindParam(":date", $date);
$req->bindParam(":description", $description);
$req->execute();
}

if(isset($_POST['modifierFormation'])) {
$id = $_POST['id'];
$libelle = $_POST['libelle'];
$description = $_POST['description'];
$date = $_POST['date'];

$req = $bdd->prepare('UPDATE formation SET libelle = :libelle, date = :date, description = :description WHERE id_formation = :id ');

$req->bindParam(":libelle", $libelle);
$req->bindParam(":date", $date);
$req->bindParam(":description", $description);
$req->bindParam(":id", $id);
$req->execute();
}

if(isset($_POST['supprimerFormation'])) {
$id = $_POST['id'];

$req = $bdd->prepare('DELETE FROM formation WHERE id_formation = :id ');

$req->bindParam(":id", $id);
$req->execute();
}

if(isset($_POST['associer'])) {
$pharmacien = $_POST['pharmacien'];
$formation = $_POST['formation'];

$req = $bdd->prepare('INSERT INTO formation_pharmacien(id_pharmacien, id_formation) VALUES(:pharmacien, :formation)');
$req->bindParam(":pharmacien", $pharmacien);
$req->bindParam(":formation", $formation);
$req->execute();
}

if(isset($_POST['modifierAssociation'])) {
$pharmacien = $_POST['pharmacien'];
$formation = $_POST['formation'];
$idForm = $_POST['idForm'];
$idPharm = $_POST['idPharm'];


$req = $bdd->prepare('UPDATE formation_pharmacien SET id_pharmacien = :pharmacien, id_formation = :formation WHERE id_formation = :idForm and id_pharmacien = :idPharm ');

$req->bindParam(":pharmacien", $pharmacien);
$req->bindParam(":formation", $formation);
$req->bindParam(":idForm", $idForm);
$req->bindParam(":idPharm", $idPharm);
$req->execute();
}

if(isset($_POST['supprimerAssociation'])) {
$idForm = $_POST['idForm'];
$idPharm = $_POST['idPharm'];

$req = $bdd->prepare('DELETE FROM formation_pharmacien WHERE id_formation = :idForm and id_pharmacien = :idPharm ');

$req->bindParam(":idForm", $idForm);
$req->bindParam(":idPharm", $idPharm);
$req->execute();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Administration : Achats</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/Formations.css" /> -->
    <link rel="stylesheet" href="css/Topbar.css" />
</head>
<body>
<header>
    <nav class="nav nav-pills nav-justified topbar">
        <a class="nav-item nav-link" href="Dmo.php">DMO</a>
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link" href="Achats.php">Achats</a>
        <a class="nav-item nav-link active" href="Formations.php">Formations</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<div class="container">


<!-- Formation -->
<a href="#" class="btn btn-primary btn-ajout-formation">Ajouter une nouvelle formation </a>
<a href="#" class="btn btn-primary btn-affichage-formation" data-toggle="modal" data-target="#formation">Anciennes formations</a>
<a href="#" class="btn btn-primary btn-association-formation">Associer formation </a>


    <!--modal-->
<div class="modal fade" id="formation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Liste des visites passées</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body">
            <table>
                <tr>
                    <td>Libellé</td>
                    <td>Date</td>
                    <td>Description</td>
                </tr>

                <?php
                $req = $bdd->prepare('SELECT * FROM formation  WHERE date < cast(now() as date)');
                $req->execute();
                $data = $req->fetchAll();

                foreach($data as $value) { ?>
                    <tr>
                        <td type="text" name="libelle"><?php echo $value['libelle']; ?></td>
                        <td type="date" name="date"><?php echo $value['date']; ?></td>
                        <td type="text" name="description"><?php echo $value['description']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<table>
    <tr class="tr-ajout-formation" style="display: none;">
        <form class="form-ajout-formation" method="post" action="Formations.php">
            <td><input class="form-control" type="text" name="libelle" placeholder="Libellé" /></td>
            <td><input class="form-control" type="date" name="date" placeholder="Date" /></td>
            <td><input class="form-control" type="text" name="description" placeholder="Description" /></td>
            <td><input class="btn btn-success" type="submit" name="ajouterFormation" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-formation-annuler">Annuler</a></td>
    </tr>
</table>
<table>
    <tr class="tr-ajout-association" style="display: none;">
        <form class="form-ajout-association" method="post" action="Formations.php">
            <td>
                <select class="form-control" type="select" name="pharmacien">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM Pharmacien');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['id_pharmacien'] ?>"><?php echo $value['prenom'].' '. $value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <select class="form-control" type="select" name="formation">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM formation');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['id_formation'] ?>"><?php echo $value['libelle'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="btn btn-success" type="submit" name="associer" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary association-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des formations</h3>
<table>
    <tr>
        <td>Libellé</td>
        <td>Date</td>
        <td>Description</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM formation WHERE date > cast(now() as date) ');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Formations.php">
                <input type="hidden" name="id" value="<?php echo $value['id_formation']; ?>" />
                <td><input class="form-control" type="text" name="libelle" value="<?php echo $value['libelle']; ?>" /></td>
                <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
                <td><input class="form-control" type="text" name="description" value="<?php echo $value['description']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifierFormation" value="Modifier" /></td>

                <td><input class="btn btn-danger" type="submit" name="supprimerFormation" value="Supprimer" /></td>



            </form>
        </tr>
        <?php
    }
    ?>
</table>

<!-- liste des formations des pharmaciens -->

<h3>Formations des pharmaciens</h3>
<table>
    <tr>
        <td>Pharmacien</td>
        <td>Formation</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM formation_pharmacien INNER JOIN pharmacien on formation_pharmacien.id_pharmacien = pharmacien.id_pharmacien INNER JOIN formation on formation_pharmacien.id_formation = formation.id_formation ');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Formations.php">
                <input type="hidden" name="idPharm" value="<?php echo $value['id_pharmacien']; ?>"/>
                <input type="hidden" name="idForm" value="<?php echo $value['id_formation']; ?>"/>
                <td>
                    <select class="form-control" type="select" name="pharmacien">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM pharmacien WHERE id_pharmacien = :id_pharmacien');
                        $req2->BindParam(':id_pharmacien', $value['id_pharmacien']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_pharmacien'] ?>"><?php echo $value2['prenom'].' '.$value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM pharmacien WHERE id_pharmacien != :id_pharmacien');
                        $req3->BindParam(':id_pharmacien', $value['id_pharmacien']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_pharmacien'] ?>"><?php echo $value3['prenom'].' '.$value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" type="select" name="formation">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM formation WHERE id_formation = :id_formation');
                        $req2->BindParam(':id_formation', $value['id_formation']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_formation'] ?>"><?php echo $value2['libelle'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM formation WHERE id_formation != :id_formation');
                        $req3->BindParam(':id_formation', $value['id_formation']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_formation'] ?>"><?php echo $value3['libelle'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input class="btn btn-warning" type="submit" name="modifierAssociation" value="Modifier" /></td>
                <td><input class="btn btn-danger" type="submit" name="supprimerAssociation" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
</div>
<script type="text/javascript" src="js/Achat.js"></script>
</div>
</body>
</html>