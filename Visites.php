<!DOCTYPE html>
<html lang="en">
<?php
include ('lib/bdd_connexion.php');


if (isset($_POST['modifier'])) {
    $id = $_POST['idVisite'];
    $dateVisite = $_POST['dateVisite'];
    $dmo = $_POST['dmo'];
    $questionnaire = $_POST['questionnaire'];
    $pharmacie = $_POST['pharmacie'];

    $req = $bdd->prepare('UPDATE visite SET date = :dateVisite, id_dmo = :dmo, idquestionnaire = :questionnaire, id_pharmacie = :pharmacie WHERE id_visite = :id ');

    $req->bindParam(":dateVisite", $dateVisite);
    $req->bindParam(":dmo", $dmo);
    $req->bindParam(":questionnaire", $questionnaire);
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

if(isset($_POST['ajouter-visite'])) {
    $date = $_POST['date'];
    $pharmacie = $_POST['pharmacie'];
    $dmo = $_POST['dmo'];
    $questionnaire = $_POST['questionnaire'];

    $req = $bdd->prepare('INSERT INTO visite(date, id_pharmacie, id_dmo, id_questionnaire) VALUES(:date, :pharmacie, :dmo, :questionnaire)');
    $req->bindParam(":date", $date);
    $req->bindParam(":pharmacie", $pharmacie);
    $req->bindParam(":dmo", $dmo);
    $req->bindParam(":questionnaire", $questionnaire);
    $req->execute();
}
if(isset($_POST['ajouter-questionnaire'])) {
    $libelle = $_POST['libelle'];

    $req = $bdd->prepare('INSERT INTO questionnaire(libelle) VALUES(:libelle)');
    $req->bindParam(":libelle", $libelle);
    $req->execute();
}

if(isset($_POST['telecharger'])) {

        require('librairie/fpdf.php');
        $idQuestionnaire = $_POST['questionnaire'];
        $idPharmacie = $_POST['pharmacie'];

        $reqQuestionnaire = $bdd->prepare('SELECT libelle FROM questionnaire WHERE id_questionnaire = :idQuestionnaire');

        $reqQuestionnaire->bindParam(':idQuestionnaire', $idQuestionnaire);

        $reqQuestionnaire->execute();



        $questionnaire = $reqQuestionnaire->fetch();



        $pdf = new FPDF();

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', '18');

        $pdf->Cell(0, 0, $questionnaire['libelle'], 0);



        $reqQuestions = $bdd->prepare('SELECT * FROM question WHERE id_questionnaire = :idQuestionnaire');

        $reqQuestions->bindParam(':idQuestionnaire', $idQuestionnaire);

        $reqQuestions->execute();



        $questions = $reqQuestions->fetchAll();



        foreach($questions as $question) {

            $pdf->SetFont('Arial', '', '12');

            $pdf->Cell(0, 0, $question['contenu'], 0);



            if($question['question_ouverte']) {



                $reqReponse = $bdd->prepare('SELECT contenu FROM reponse_ouverte WHERE id_question = :idQuestion AND id_pharmacie = :idPharmacie');

                $reqReponse->bindParam(':idQuestion', $question['id_question']);

                $reqReponse->bindParam(':idPharmacie', $idPharmacie);

                $reqReponse->execute();



                $reponse = $reqReponse->fetch();



                $pdf->SetFont('Arial', 'u', '12');

                $pdf->Cell(0, 0, $reponse['contenu'], 0);

            } else {



                $reqReponses = $bdd->prepare('SELECT * FROM reponse_choix_multiples WHERE id_question = :idQuestion AND id_pharmacie = :idPharmacie');

                $reqReponses->bindParam(':idQuestion', $question['id_question']);

                $reqReponses->bindParam(':idPharmacie', $idPharmacie);

                $reqReponses->execute();



                $reponses = $reqReponses->fetchAll();



                foreach($reponses as $reponse) {

                    if($reponse['is_checked']) {

                        $pdf->SetFont('Arial', 'u', '12');

                        $pdf->Cell(0, 0, $reponse['contenu'], 0);

                    } else {

                        $pdf->SetFont('Arial', '', '12');

                        $pdf->Cell(0, 0, $reponse['contenu'], 0);

                    }

                }

            }

        }



        $pdf->OutPut('F', 'C:/test.pdf', false);
    header('Content-disposition: attachment; filename='.$pdf);
    header('Content-Type: application/force-download');
}


?>


<!-- Le HTML -->

<head>
    <meta charset="UTF-8">
    <title>Administration : Visites</title>
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
        <a class="nav-item nav-link" href="Achats.php">Achats</a>
        <a class="nav-item nav-link" href="Formations.php">Formations</a>
        <a class="nav-item nav-link disabled" href="#">
            <img src="images/logo_nivantis.png" />
        </a>
    </nav>
</header>
<div class="container">
<a href="#" class="btn btn-primary btn-ajout-visite">Ajouter une nouvelle visite</a>
<a href="#" class="btn btn-primary btn-ajout-questionnaire">Ajouter un nouveau questionnaire</a>
<a href="#" class="btn btn-primary btn-affichage-visite" data-toggle="modal" data-target="#visite">Visites passées</a>
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
                        <option value="<?php echo $value['id_pharmacie'] ?>"><?php echo $value['nom'] ?></option>
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
                        <option value="<?php echo $value['id_dmo'] ?>"><?php echo $value['login'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <?php
                    $req = $bdd->prepare('SELECT * FROM questionnaire');
                    $req->execute();
                    $data = $req->fetchAll();
                if($data == null){ ?>
                    <a href="#" class="btn btn-primary btn-ajout-questionnaire">Créer le premier questionnaire</a>
                <?php }
                else { ?>
                    <select class="form-control" type="select" name="questionnaire">
                <?php
                foreach($data as $value) {
                ?>
                        <option value="<?php echo $value['id_questionnaire'] ?>"><?php echo $value['libelle']?></option>
                <?php } ?>
                    </select>
                <?php }?>
            </td>
            <td><input class="btn btn-success" type="submit" name="ajouter-visite" value="Ajouter" /></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-visite-annuler">Annuler</a></td>
    </tr>
</table>
<table>
    <tr class="tr-ajout-questionnaire" style="display: none;">
        <form class="form-ajout-questionnaire" method="post" action="Visites.php">
            <td><input class="form-control" type="text" name="libelle" placeholder="Libellé"/></td>
            <td><input class="btn btn-success" type="submit" name="ajouter-questionnaire" value="Ajouter" id="ajouter-questionnaire"/></td>
        </form>
        <td><a href="#" class="btn btn-secondary btn-ajout-questionnaire-annuler">Annuler</a></td>
    </tr>
</table>
<table>
    <tr>
<?php
$req = $bdd->prepare('select * from questionnaire Left join question on questionnaire.id_questionnaire = question.id_questionnaire where question.id_questionnaire IS NULL');
$req->execute();
$data = $req->fetchAll();

foreach($data as $value) {
    ?>
    <td><a href="#" class="btn btn-primary btn-affichage-questionnaire" data-toggle="modal" data-target="#questionnaire<?php echo $value['0']?>">Le nouveau questionnaire</a></td>
<?php } ?>
    </tr>
</table>
<h3>Liste des visites</h3>
<table>
    <tr>
        <td>Date</td>
        <td>Pharmacie</td>
        <td>Dmo</td>
        <td>questionnaire</td>
    </tr>
    <?php

    $req = $bdd->prepare('SELECT * FROM Visite LEFT JOIN pharmacie on pharmacie.id_pharmacie = visite.id_pharmacie LEFT JOIN dmo on dmo.id_dmo = visite.id_dmo LEFT JOIN questionnaire on questionnaire.id_questionnaire = visite.id_questionnaire WHERE date >= cast(now() as date)');
    $req->execute();
    $data = $req->fetchAll();

    foreach($data as $value) {
        ?>
        <tr>
            <form class="form-group" method="post" action="Visites.php">
                <input type="hidden" name="idVisite" value="<?php echo $value['id_visite']; ?>" />
                <td><input class="form-control" type="date" name="dateVisite" value="<?php echo $value['date']; ?>" /></td>
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
                    <select class="form-control" type="select" name="dmo">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM dmo WHERE id_dmo = :id_dmo');
                        $req2->BindParam(':id_dmo', $value['id_dmo']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_dmo'] ?>"><?php echo $value2['login'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM dmo WHERE id_dmo != :id_dmo');
                        $req3->BindParam(':id_dmo', $value['id_dmo']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_dmo'] ?>"><?php echo $value3['login'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" type="select" name="questionnaire">
                        <?php
                        $req2 = $bdd->prepare('SELECT * FROM questionnaire WHERE id_questionnaire = :id_questionnaire');
                        $req2->BindParam(':id_questionnaire', $value['id_questionnaire']);
                        $req2->execute();
                        $data2 = $req2->fetchAll();

                        foreach($data2 as $value2) {
                            ?>
                            <option value="<?php echo $value2['id_questionnaire'] ?>"><?php echo $value2['libelle'] ?></option>
                        <?php }
                        $req3 = $bdd->prepare('SELECT * FROM questionnaire WHERE id_questionnaire != :id_questionnaire');
                        $req3->BindParam(':id_questionnaire', $value['id_questionnaire']);
                        $req3->execute();
                        $data3 = $req3->fetchAll();

                        foreach($data3 as $value3) {
                            ?>
                            <option value="<?php echo $value3['id_questionnaire'] ?>"><?php echo $value3['libelle'] ?></option>
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
<?php
//modal visite passée
$req = $bdd->prepare('SELECT * FROM Visite LEFT JOIN pharmacie on pharmacie.id_pharmacie = visite.id_pharmacie LEFT JOIN dmo on dmo.id_dmo = visite.id_dmo LEFT JOIN questionnaire on questionnaire.id_questionnaire = visite.id_questionnaire WHERE date < cast(now() as date)');
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
                        <td>questionnaire</td>
                    </tr>

                    <?php
                    foreach($data as $value) { ?>
                        <tr>

                            <td type="date" name="dateVisite"><?php echo $value['date']; ?></td>
                            <td type="text" name="pharmacie"><?php echo $value[6]; // nom de la pharmacie?></td>
                            <td type="text" name="dmo"><?php echo $value['login']?></td>
                            <td type="text" name="questionnaire"><?php echo $value['libelle']; // nom du questionnaire?></td>
                            <td>
                                <form method="post" action="Visites.php">
                                    <input type="hidden" name="pharmacie" value="<?php echo $value['id_pharmacie']; ?>"/>
                                    <input type="hidden" name="questionnaire" value="<?php echo $value['id_questionnaire']; ?>"/>
                                    <input class="btn btn-info" type="submit" name="telecharger" value="Télécharger PDF" >
                                </form>
                            </td>
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

<?php
$req = $bdd->prepare('select * from questionnaire');
$req->execute();
$data = $req->fetchAll();

foreach($data as $value) {
?>
<!-- modal questionnaire -->

<div class="modal fade" id="questionnaire<?php echo $value['0']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $value['1']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body">
            <table>
                <tr>
                    <td>Question</td>
                    <td>Type de question</td>
                    <td>Réponse</td>
                </tr>
                <tr>
                    <div id="form">
                    <form class="form-ajout-visite" method="post" action="Visites.php">
                        <td><textarea class="form-control" rows="1" name="question"></textarea></td>
                        <td>
                            <div class="radio">
                                <label><input type="radio" name="optradio" id="simple">Simple</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="optradio" id="multiple">Multiple</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="optradio" id="libre">Libre</label>
                            </div>
                        </td>
                        <td id="idTd">

                        </td>
                        <td><input class="btn btn-success" type="submit" name="ajouter-question" value="Ajouter"  id="ajouter-question"/></td>
                    </form>
                    </div>
                </tr>
            </table>
                <div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript" src="js/Visite.js"></script>
</div>
</body>
</html>