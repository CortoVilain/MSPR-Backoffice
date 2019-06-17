<!DOCTYPE html>
<html lang="en">
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');

if(isset($_POST['ajouter'])) {
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];

    $req = $bdd->prepare('INSERT INTO achat_nivantis(quantite, idPharmacie, idProduit, date) VALUES(:quantite, :pharmacie, :produit, :date)');
    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->execute();
}

if(isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];

    $req = $bdd->prepare('UPDATE achat_nivantis SET quantite = :quantite, idPharmacie = :pharmacie, idProduit = :produit, date = :date WHERE idAchatNivantis = :id ');

    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM achat_nivantis WHERE idAchatNivantis = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Administration : Achats</title>
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
        <a class="nav-item nav-link" href="Dmo.php">DMO</a>
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link active" href="Achats.php">Achats</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<a href="#" class="btn btn-primary btn-ajout">Ajouter un nouveau achat </a>
<table>
    <tr class="tr-ajout">
        <form class="form-ajout" method="post" action="Achats.php">
            <td><input class="form-control" type="text" name="quantite" placeholder="Quantité" /></td>
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
                <select class="form-control" type="select" name="produit">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM produit');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['idProduit'] ?>"><?php echo $value['label'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="form-control" type="date" name="date" placeholder="Date"/></td>
            <td><input class="btn btn-success" type="submit" name="ajouter" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des Achats</h3>
<table>
    <tr>
        <td>Quantité</td>
        <td>Pharmacie</td>
        <td>Produit</td>
        <td>Date</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM achat_nivantis');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Achats.php">
                <input type="hidden" name="id" value="<?php echo $value['idAchatNivantis']; ?>" />
                <td><input class="form-control" type="text" name="quantite" value="<?php echo $value['quantite']; ?>" /></td>
                <td><input class="form-control" type="text" name="pharmacie" value="<?php echo $value['idPharmacie']; ?>" /></td>
                <td><input class="form-control" type="text" name="produit" value="<?php echo $value['idProduit']; ?>" /></td>
                <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
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