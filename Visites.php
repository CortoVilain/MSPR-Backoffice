<!DOCTYPE html>
<html lang="en">
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');


if (isset($_POST['modifier'])) {
    $id = $_POST['idVisite'];
    $dateVisite = $_POST['dateVisite'];
    $dmo = $_POST['dmo'];
    $formulaire = $_POST['formulaire'];
    $pharmacie = $_POST['pharmacie'];

    $req = $bdd->prepare('UPDATE visite SET dateVisite = :dateVisite, idDmo = :dmo, idFormulaire = :formulaire, idPharmacie = :pharmacie WHERE idVisite = :id ');

    $req->bindParam(":dateVisite", $dateVisite);
    $req->bindParam(":dmo", $dmo);
    $req->bindParam(":formulaire", $formulaire);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['idVisite'];

    $req = $bdd->prepare('DELETE FROM visite WHERE idVisite = :id ');

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
    $dateVisite = $_POST['dateVisite'];
    $pharmacie = $_POST['pharmacie'];
    $dmo = $_POST['dmo'];
    $formulaire = $_POST['formulaire'];

    $req = $bdd->prepare('INSERT INTO visite(dateVisite, idPharmacie, idDmo, idFormulaire) VALUES(:dateVisite, :pharmacie, :dmo, :formulaire)');
    $req->bindParam(":dateVisite", $dateVisite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":dmo", $dmo);
    $req->bindParam(":formulaire", $formulaire);
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
<a href="#" class="btn btn-primary btn-ajout-questionnaire">Ajouter un nouveau formulaire</a>
<a href="#" class="btn btn-primary btn-affichage-visite" data-toggle="modal" data-target="#visite">Visites passées</a>
<?php
//Je récupère toutes les Pharmacies
$req = $bdd->prepare('SELECT * FROM Visite LEFT JOIN pharmacie on pharmacie.idPharmacie = visite.idPharmacie LEFT JOIN dmo on dmo.idDmo = visite.idDmo LEFT JOIN formulaire on formulaire.idFormulaire = visite.idFormulaire WHERE dateVisite < cast(now() as date)');
$req->execute();
$data = $req->fetchAll();
?>

<div class="modal fade" id="visite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                        <td>Date</td>
                        <td>Pharmacie</td>
                        <td>Dmo</td>
                        <td>Formulaire</td>
                    </tr>

                    <?php
                    foreach($data as $value) { ?>
                        <tr>
                            <form class="form-group" method="post" action="Visites.php">
                                <input type="hidden" name="idVisite" value="<?php echo $value['idVisite']; ?>" />
                                <td type="date" name="dateVisite"><?php echo $value['dateVisite']; ?></td>
                                <td type="text" name="pharmacie"><?php echo $value[6]; // nom de la pharmacie?></td>
                                <td type="text" name="dmo"><?php echo $value['login']?></td>
                                <td type="text" name="formulaire"><?php echo $value[15]; // nom du formulaire?></td>
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
<table>
    <tr class="tr-ajout-visite" style="display: none;">
        <form class="form-ajout-visite" method="post" action="Visites.php">
            <td><input class="form-control" type="date" name="dateVisite" placeholder="Date"/></td>
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
                        <option value="<?php echo $value['idDmo'] ?>"><?php echo $value['login'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <?php
                    $req = $bdd->prepare('SELECT * FROM formulaire');
                    $req->execute();
                    $data = $req->fetchAll();
                if($data == null){ ?>
                    <a href="#" class="btn btn-primary btn-ajout-questionnaire">Créer le premier formulaire</a>
                <?php }else{
                foreach($data as $value) {
                ?>
                <select class="form-control" type="select" name="formulaire">
                    <option value="<?php echo $value['idFormulaire'] ?>"><?php echo $value['nom']?></option>
                </select>
                <?php } }?>
            </td>
            <td><input class="btn btn-success" type="submit" name="ajouter-visite" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-visite-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des visites</h3>
<table>
    <tr>
        <td>Date</td>
        <td>Pharmacie</td>
        <td>Dmo</td>
        <td>Formulaire</td>
    </tr>
    <?php

    $req = $bdd->prepare('SELECT * FROM Visite LEFT JOIN pharmacie on pharmacie.idPharmacie = visite.idPharmacie LEFT JOIN dmo on dmo.idDmo = visite.idDmo LEFT JOIN formulaire on formulaire.idFormulaire = visite.idFormulaire WHERE dateVisite >= cast(now() as date)');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) {
        ?>
        <tr>
            <form class="form-group" method="post" action="Visites.php">
                <input type="hidden" name="idVisite" value="<?php echo $value['idVisite']; ?>" />
                <td><input class="form-control" type="date" name="dateVisite" value="<?php echo $value['dateVisite']; ?>" /></td>
                <td>
                    <select class="form-control" type="select" name="pharmacie">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM Pharmacie WHERE idPharmacie = :idPharmacie');
                        $req2->BindParam(':idPharmacie', $value['idPharmacie']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                        ?>
                        <option value="<?php echo $value2['idPharmacie'] ?>"><?php echo $value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM Pharmacie WHERE idPharmacie != :idPharmacie');
                        $req3->BindParam(':idPharmacie', $value['idPharmacie']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['idPharmacie'] ?>"><?php echo $value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" type="select" name="dmo">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM dmo WHERE idDmo = :idDmo');
                        $req2->BindParam(':idDmo', $value['idDmo']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['idDmo'] ?>"><?php echo $value2['login'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM dmo WHERE idDmo != :idDmo');
                        $req3->BindParam(':idDmo', $value['idDmo']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['idDmo'] ?>"><?php echo $value3['login'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" type="select" name="formulaire">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM formulaire WHERE idFormulaire = :idFormulaire');
                        $req2->BindParam(':idFormulaire', $value['idFormulaire']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['idFormulaire'] ?>"><?php echo $value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM formulaire WHERE idFormulaire != :idFormulaire');
                        $req3->BindParam(':idFormulaire', $value['idFormulaire']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['idFormulaire'] ?>"><?php echo $value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
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