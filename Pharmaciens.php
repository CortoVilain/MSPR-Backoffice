<!DOCTYPE html>
<html lang="en">
<?php
$bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
$bdd->exec('SET NAMES utf8');


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
<a href="#" class="btn btn-primary btn-ajout-pharmacien">Ajouter un nouveau pharmacien</a>
<table>
    <tr class="tr-ajout-pharmacien">
        <form class="form-ajout-pharmacien" method="post" action="Pharmacies.php">
            <td><input class="form-control" type="text" name="prenom" /></td>
            <td><input class="form-control" type="text" name="nom" /></td>
            <td>
                <select class="form-control" type="select" name="pharmacie">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM Pharmacien');
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
<h3>Liste des pharmaciens</h3>
<table>
    <tr>
        <td>Nom</td>
        <td>Prénom</td>
        <td>Pharmacie</td>
    </tr>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
    $bdd->exec('SET NAMES utf8');

    $req = $bdd->prepare('SELECT * FROM Pharmacien');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) {
        ?>
        <tr>
            <form class="form-group" method="post" action="Pharmacies.php">
                <input type="hidden" name="id" value="<?php echo $value['idPharmacien']; ?>" />
                <td><input class="form-control" type="text" name="nom" value="<?php echo $value['nom']; ?>" /></td>
                <td><input class="form-control" type="text" name="prenom" value="<?php echo $value['prenom']; ?>" /></td>
                <td><input class="form-control" type="text" name="pharmacie" value="<?php echo $value['idPharmacie']; ?>" /></td>
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