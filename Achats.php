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

if(isset($_POST['ajouterVente'])) {
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];

    $req = $bdd->prepare('INSERT INTO vente_client(quantite, idPharmacie, idProduit, date) VALUES(:quantite, :pharmacie, :produit, :date)');
    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->execute();
}

if(isset($_POST['modifierVente'])) {
    $id = $_POST['id'];
    $quantite = $_POST['quantite'];
    $pharmacie = $_POST['pharmacie'];
    $produit = $_POST['produit'];
    $date = $_POST['date'];

    $req = $bdd->prepare('UPDATE vente_client SET quantite = :quantite, idPharmacie = :pharmacie, idProduit = :produit, date = :date WHERE idVenteClient = :id ');

    $req->bindParam(":quantite", $quantite);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":produit", $produit);
    $req->bindParam(":date", $date);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerVente'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM vente_client WHERE idVenteClient = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['ajouterFormation'])) {
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];
    $pharmacien = $_POST['pharmacien'];

    $req = $bdd->prepare('INSERT INTO formation(libelle, date) VALUES(:libelle, :date)');
    $req->bindParam(":libelle", $libelle);
    $req->bindParam(":date", $date);
    $req->execute();
}

if(isset($_POST['modifierFormation'])) {
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];

    $req = $bdd->prepare('UPDATE formation SET libelle = :libelle, date = :date WHERE idFormation = :id ');

    $req->bindParam(":libelle", $libelle);
    $req->bindParam(":date", $date);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerFormation'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM formation WHERE idFormation = :id ');

    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['associer'])) {
    $pharmacien = $_POST['pharmacien'];
    $formation = $_POST['formation'];

    $req = $bdd->prepare('INSERT INTO former(idPharmacien, idFormation) VALUES(:pharmacien, :formation)');
    $req->bindParam(":pharmacien", $pharmacien);
    $req->bindParam(":formation", $formation);
    $req->execute();
}

if(isset($_POST['modifierAssociation'])) {
    $pharmacien = $_POST['pharmacien'];
    $formation = $_POST['formation'];
    $id = $_POST['id'];


    $req = $bdd->prepare('UPDATE former SET idPharmacien = :pharmacien, idFormation = :formation WHERE idFormer = :id ');

    $req->bindParam(":pharmacien", $pharmacien);
    $req->bindParam(":formation", $formation);
    $req->bindParam(":id", $id);
    $req->execute();
}

if(isset($_POST['supprimerAssociation'])) {
    $id = $_POST['id'];

    $req = $bdd->prepare('DELETE FROM former WHERE idFormer = :id ');

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
                    <select class="form-control" type="select" name="produit">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM produit WHERE idProduit = :idProduit');
                        $req2->BindParam(':idProduit', $value['idProduit']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['idProduit'] ?>"><?php echo $value2['label'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM produit WHERE idProduit != :idProduit');
                        $req3->BindParam(':idProduit', $value['idProduit']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['idProduit'] ?>"><?php echo $value3['label'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifier" value="Modifier" /></td>
                <td><input class="btn btn-danger" type="submit" name="supprimer" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
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
            <td><input class="btn btn-success" type="submit" name="ajouterVente" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-vente-annuler">Annuler</a></td>
    </tr>
</table>
<h3>Liste des Ventes</h3>
<table>
    <tr>
        <td>Quantité</td>
        <td>Pharmacie</td>
        <td>Produit</td>
        <td>Date</td>
    </tr>

    <?php

    $req = $bdd->prepare('SELECT * FROM vente_client');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) { ?>
        <tr>
            <form class="form-group" method="post" action="Achats.php">
                <input type="hidden" name="id" value="<?php echo $value['idVenteClient']; ?>" />
                <td><input class="form-control" type="text" name="quantite" value="<?php echo $value['quantite']; ?>" /></td>
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
                    <select class="form-control" type="select" name="produit">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM produit WHERE idProduit = :idProduit');
                        $req2->BindParam(':idProduit', $value['idProduit']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['idProduit'] ?>"><?php echo $value2['label'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM produit WHERE idProduit != :idProduit');
                        $req3->BindParam(':idProduit', $value['idProduit']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['idProduit'] ?>"><?php echo $value3['label'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
                <td><input class="btn btn-warning" type="submit" name="modifierVente" value="Modifier" /></td>
                <td><input class="btn btn-danger" type="submit" name="supprimerVente" value="Supprimer" /></td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
<hr>

<!-- Formation -->
<a href="#" class="btn btn-primary btn-ajout-formation">Ajouter une nouvelle formation </a>
<a href="#" class="btn btn-primary btn-affichage-formation" data-toggle="modal" data-target="#formation">Anciennes formations</a>
<a href="#" class="btn btn-primary btn-association-formation">Associer formation </a>

<div class="modal fade" id="formation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Liste des formations passées</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body">
                <table>
                    <tr>
                        <td>Libellé</td>
                        <td>Date</td>
                    </tr>

                    <?php
                    $req = $bdd->prepare('SELECT * FROM formation  WHERE date < cast(now() as date)');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) { ?>
                        <tr>
                            <td type="text" name="libelle"><?php echo $value['libelle']; ?></td>
                            <td type="date" name="date"><?php echo $value['date']; ?></td>
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
    <tr class="tr-ajout-formation" style="display: none;">
        <form class="form-ajout-formation" method="post" action="Achats.php">
            <td><input class="form-control" type="text" name="libelle" placeholder="Libellé" /></td>
            <td><input class="form-control" type="date" name="date" placeholder="Date" /></td>
            <td><input class="btn btn-success" type="submit" name="ajouterFormation" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-formation-annuler">Annuler</a></td>
    </tr>
</table>
<table>
    <tr class="tr-ajout-association" style="display: none;">
        <form class="form-ajout-association" method="post" action="Achats.php">
            <td>
                <select class="form-control" type="select" name="pharmacien">
                    <?php
                    $req = $bdd->prepare('SELECT * FROM Pharmacien');
                    $req->execute();
                    $data = $req->fetchAll();

                    foreach($data as $value) {
                        ?>
                        <option value="<?php echo $value['idPharmacien'] ?>"><?php echo $value['prenom'].' '. $value['nom'] ?></option>
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
                        <option value="<?php echo $value['idFormation'] ?>"><?php echo $value['libelle'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input class="btn btn-success" type="submit" name="associer" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary association-annuler">Annuler</a></td>
    </tr>
</table>
<div class="row">
    <div class="col-md-6">
        <h3>Liste des formations</h3>
        <table>
            <tr>
                <td>Libellé</td>
                <td>Date</td>
            </tr>

            <?php

            $req = $bdd->prepare('SELECT * FROM formation WHERE date > cast(now() as date) ');
            $req->execute();
            $data = $req->fetchAll();

            foreach($data as $value) { ?>
                <tr>
                    <form class="form-group" method="post" action="Achats.php">
                        <input type="hidden" name="id" value="<?php echo $value['idFormation']; ?>" />
                        <td><input class="form-control" type="text" name="libelle" value="<?php echo $value['libelle']; ?>" /></td>
                        <td><input class="form-control" type="date" name="date" value="<?php echo $value['date']; ?>" /></td>
                        <td><input class="btn btn-warning" type="submit" name="modifierFormation" value="Modifier" /></td>

                        <td><input class="btn btn-danger" type="submit" name="supprimerFormation" value="Supprimer" /></td>



                    </form>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <!-- liste des formations des pharmaciens -->
    <div class="col-md-6">
        <h3>Formations des pharmaciens</h3>
        <table>
            <tr>
                <td>Pharmacien</td>
                <td>Formation</td>
            </tr>

            <?php

            $req = $bdd->prepare('SELECT * FROM former INNER JOIN pharmacien on former.idPharmacien = pharmacien.idPharmacien INNER JOIN formation on former.idFormation = formation.idFormation ');
            $req->execute();
            $data = $req->fetchAll();

            foreach($data as $value) { ?>
                <tr>
                    <form class="form-group" method="post" action="Achats.php">
                        <input type="hidden" name="id" value="<?php echo $value['idFormer']; ?>" />
                        <td>
                            <select class="form-control" type="select" name="pharmacien">
                                <?php
                                $req2 = $bdd->prepare('SELECT * FROM pharmacien WHERE idPharmacien = :idPharmacien');
                                $req2->BindParam(':idPharmacien', $value['idPharmacien']);
                                $req2->execute();
                                $data2 = $req2->fetchAll();

                                foreach($data2 as $value2) {
                                    ?>
                                    <option value="<?php echo $value2['idPharmacien'] ?>"><?php echo $value2['prenom'].' '.$value2['nom'] ?></option>
                                <?php }
                                $req3 = $bdd->prepare('SELECT * FROM pharmacien WHERE idPharmacien != :idPharmacien');
                                $req3->BindParam(':idPharmacien', $value['idPharmacien']);
                                $req3->execute();
                                $data3 = $req3->fetchAll();

                                foreach($data3 as $value3) {
                                    ?>
                                    <option value="<?php echo $value3['idPharmacien'] ?>"><?php echo $value3['prenom'].' '.$value3['nom'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" type="select" name="formation">
                                <?php
                                $req2 = $bdd->prepare('SELECT * FROM formation WHERE idFormation = :idFormation');
                                $req2->BindParam(':idFormation', $value['idFormation']);
                                $req2->execute();
                                $data2 = $req2->fetchAll();

                                foreach($data2 as $value2) {
                                    ?>
                                    <option value="<?php echo $value2['idFormation'] ?>"><?php echo $value2['libelle'] ?></option>
                                <?php }
                                $req3 = $bdd->prepare('SELECT * FROM formation WHERE idFormation != :idFormation');
                                $req3->BindParam(':idFormation', $value['idFormation']);
                                $req3->execute();
                                $data3 = $req3->fetchAll();

                                foreach($data3 as $value3) {
                                    ?>
                                    <option value="<?php echo $value3['idFormation'] ?>"><?php echo $value3['libelle'] ?></option>
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
</div>
<script type="text/javascript" src="js/Achat.js"></script>
</body>
</html>