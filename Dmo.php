<!DOCTYPE html>
<html lang="en">
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
        <a class="nav-item nav-link active" href="#">DMO</a>
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<a href="#" class="btn btn-primary">Créer un nouveau DMO</a>
<h3>Liste des DMOs</h3>
<table>
    <tr>
        <td>Login</td>
        <td>Prénom</td>
        <td>Nom</td>
        <td>Mot de passe</td>
    </tr>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=bdd_nivantis', 'root', '');
    $bdd->exec('SET NAMES utf8');

    $req = $bdd->prepare('SELECT * FROM DMO');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <td><?php echo $value['identifiant']; ?></td>
            <td><?php echo $value['prenom']; ?></td>
            <td><?php echo $value['nom']; ?></td>
            <td><?php echo $value['mdp']; ?></td>
            </tr><?php
    }
    ?>
</table>


</body>
</html>