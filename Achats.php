<!DOCTYPE html>
<html lang="en">
<?php
include ('lib/bdd_connexion.php');

if(isset($_POST['ajouter'])) {
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];

    $req = $bdd->prepare('INSERT INTO achat(quantite, id_pharmacie, id_produit, date, prix) VALUES(:quantite, :pharmacie, :produit, :date, :prix)');
    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->bindParam(":prix", $prix);
    $req->execute();
}

if(isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];

    $req = $bdd->prepare('UPDATE achat SET quantite = :quantite, id_pharmacie = :pharmacie, id_produit = :produit, date = :date, prix = :prix WHERE id_achat = :id ');

    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->bindParam(":prix", $prix);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM achat WHERE id_achat = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['ajouterVente'])) {
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];


    $req = $bdd->prepare('INSERT INTO vente(quantite, id_pharmacie, id_produit, date, prix) VALUES(:quantite, :pharmacie, :produit, :date, :prix)');
    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->bindParam(":prix", $prix);
    $req->execute();
}

if(isset($_POST['modifierVente'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];

    $req = $bdd->prepare('UPDATE vente SET quantite = :quantite, id_pharmacie = :pharmacie, id_produit = :produit, date = :date, prix = :prix WHERE id_vente = :id ');

    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->bindParam(":prix", $prix);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerVente'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM vente WHERE id_vente = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['ajouterProduit'])) {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    $req = $bdd->prepare('INSERT INTO produit(nom, prix) VALUES(:nom, :prix)');
    $req->bindParam(":nom", $nom);
    $req->bindParam(":prix", $prix);
    $req->execute();
}

if(isset($_POST['modifierProduit'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    $req = $bdd->prepare('UPDATE produit SET nom = :nom, prix = :prix WHERE id_produit = :id ');

    $req->bindParam(":nom", $nom);
    $req->bindParam(":prix", $prix);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerProduit'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM produit WHERE id_produit = :id ');

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
    <link rel="stylesheet" href="css/Achats.css" />
    <link rel="stylesheet" href="css/Topbar.css" />
</head>
<body>
<header>
    <nav class="nav nav-pills nav-justified topbar">
        <a class="nav-item nav-link" href="Dmo.php">DMO</a>
        <a class="nav-item nav-link" href="Visites.php">Visites</a>
        <a class="nav-item nav-link" href="Pharmacies.php">Pharmacies</a>
        <a class="nav-item nav-link active" href="Achats.php">Achats</a>
        <a class="nav-item nav-link" href="Formations.php">Formations</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<div class="container">

<!-- Achats -->
<a href="#" class="btn btn-primary btn-ajout">Ajouter un nouveau achat </a>
<table>
    <tr class="tr-ajout" style="display: none;">
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
                        <option value="<?php echo $value['id_pharmacie'] ?>"><?php echo $value['nom'] ?></option>
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
                        <option value="<?php echo $value['id_produit'] ?>"><?php echo $value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="form-control" type="date" name="date" placeholder="Date"/></td>
            <td><input class="form-control" type="text" name="prix" placeholder="Prix"/></td>
            <td><input class="btn btn-success" type="submit" name="ajouter" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des Achats</h3>
<div style="height: 500px;overflow: auto;">
<table>
    <tr>
        <td>Quantité</td>
        <td>Pharmacie</td>
        <td>Produit</td>
        <td>Date</td>
        <td>Prix</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM achat');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Achats.php">
                <input type="hidden" name="id" value="<?php echo $value['id_achat']; ?>" />
                <td><input class="form-control" type="text" name="quantite" value="<?php echo $value['quantite']; ?>" /></td>
                <td>
                    <select class="form-control" type="select" name="pharmacie">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM Pharmacie WHERE id_pharmacie = :id_pharmacie');
                        $req2->BindParam(':id_pharmacie', $value['id_pharmacie']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_pharmacie'] ?>"><?php echo $value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM Pharmacie WHERE id_pharmacie != :id_pharmacie');
                        $req3->BindParam(':id_pharmacie', $value['id_pharmacie']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_pharmacie'] ?>"><?php echo $value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" type="select" name="produit">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM produit WHERE id_produit = :id_produit');
                        $req2->BindParam(':id_produit', $value['id_produit']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_produit'] ?>"><?php echo $value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM produit WHERE id_produit != :id_produit');
                        $req3->BindParam(':id_produit', $value['id_produit']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_produit'] ?>"><?php echo $value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
                <td><input class="form-control" type="text" name="prix" value="<?php echo $value['prix']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifier" value="Modifier" /></td>
                <td><input class="btn btn-danger" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
</div>
<hr>

<!-- Ventes -->
<a href="#" class="btn btn-primary btn-ajout-vente">Ajouter une nouvelle vente </a>
<table>
    <tr class="tr-ajout-vente" style="display: none;">
        <form class="form-ajout-vente" method="post" action="Achats.php">
            <td><input class="form-control" type="text" name="quantite" placeholder="Quantité" /></td>
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
            <td>
                <select class="form-control" type="select" name="produit">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM produit');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['id_produit'] ?>"><?php echo $value['nom'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="form-control" type="date" name="date" placeholder="Date"/></td>
            <td><input class="form-control" type="text" name="prix" placeholder="Prix"/></td>
            <td><input class="btn btn-success" type="submit" name="ajouterVente" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-vente-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des Ventes</h3>
<div style="height: 500px;overflow: auto;">
<table>
    <tr>
        <td>Quantité</td>
        <td>Pharmacie</td>
        <td>Produit</td>
        <td>Date</td>
        <td>Prix</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM vente');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Achats.php">
                <input type="hidden" name="id" value="<?php echo $value['id_vente']; ?>" />
                <td><input class="form-control" type="text" name="quantite" value="<?php echo $value['quantite']; ?>" /></td>
                <td>
                    <select class="form-control" type="select" name="pharmacie">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM Pharmacie WHERE id_pharmacie = :id_pharmacie');
                        $req2->BindParam(':id_pharmacie', $value['id_pharmacie']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_pharmacie'] ?>"><?php echo $value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM Pharmacie WHERE id_pharmacie != :id_pharmacie');
                        $req3->BindParam(':id_pharmacie', $value['id_pharmacie']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_pharmacie'] ?>"><?php echo $value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" type="select" name="produit">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM produit WHERE id_produit = :id_produit');
                        $req2->BindParam(':id_produit', $value['id_produit']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_produit'] ?>"><?php echo $value2['nom'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM produit WHERE id_produit != :id_produit');
                        $req3->BindParam(':id_produit', $value['id_produit']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_produit'] ?>"><?php echo $value3['nom'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
                <td><input class="form-control" type="text" name="prix" value="<?php echo $value['prix']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifierVente" value="Modifier" /></td>
                <td><input class="btn btn-danger" type="submit" name="supprimerVente" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
</div>
<hr>

<!-- Produit -->
<a href="#" class="btn btn-primary btn-ajout-produit">Ajouter une nouveau produit </a>

<table>
    <tr class="tr-ajout-produit" style="display: none;">
        <form class="form-ajout-produit" method="post" action="Achats.php">
            <td><input class="form-control" type="text" name="nom" placeholder="Nom" /></td>
            <td><input class="form-control" type="text" name="prix" placeholder="Prix" /></td>
            <td><input class="btn btn-success" type="submit" name="ajouterProduit" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-produit-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des produits</h3>
<table>
    <tr>
        <td>Nom</td>
        <td>Prix</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM produit');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Achats.php">
                <input type="hidden" name="id" value="<?php echo $value['id_produit']; ?>" />
                <td><input class="form-control" type="text" name="nom" value="<?php echo $value['nom']; ?>" /></td>
                <td><input class="form-control" type="text" name="prix" value="<?php echo $value['prix']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifierProduit" value="Modifier" /></td>

                <td><input class="btn btn-danger" type="submit" name="supprimerProduit" value="Supprimer" /></td>



            </form>
        </tr>
        <?php
    }
    ?>
</table>
<script type="text/javascript" src="js/Achat.js"></script>
</div>
</body>
</html>