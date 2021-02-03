<?php

$title = "liste des ampoules -";
ob_start();

//COONEXION A LE BASE de DONNÉES
$user = "root";
$pass = "";
//Essaie de te connecter
try {
    $BD = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
    $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Erreur de connexion a PDO MySQL :" . $exception->getMessage());
}
?>

<h1 class="text-center">Liste des interventions des changements d'ampoules</h1>

<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ajouterAmpoule">Ajouter une intervention</button>
</div>

<!---------------------Modal ajouter une Ampoule---------------------->
<div class="modal fade" id="ajouterAmpoule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une intervention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="ajouterAmpoule.php" method="POST">
                    <div class="form-group">
                        <label for="date_changement">Sélectionner une date</label>
                        <input type="date" class="form-control" name="date_changement">
                    </div>

                    <div>
                        <label for="etage">Sélectionner l'Etage</label>
                        <select  class="form-control" name="etage">
                            <option value="rdc">rdc</option>
                            <option value="Etage 1">Etage 1</option>
                            <option value="Etage 2">Etage 2</option>
                            <option value="Etage 3">Etage 3</option>
                            <option value="Etage 3">Etage 3</option>
                            <option value="Etage 4">Etage 4</option>
                            <option value="Etage 5">Etage 5</option>
                            <option value="Etage 6">Etage 6</option>
                            <option value="Etage 7">Etage 7</option>
                            <option value="Etage 8">Etage 8</option>
                            <option value="Etage 10">Etage 10</option>
                            <option value="Etage 11">Etage 11</option>
                        </select>
                    </div>

                    <div>
                        <label for="etage">Sélectionner l'emplacement</label>
                        <select class="form-control" name="position_ampoule">
                            <option value="droite">a droite</option>
                            <option value="gauche">a gauche</option>
                            <option value="fond">au fond</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prix_ampoule"></label>
                        <input type="number" step="any" class="form-control" name="prix_ampoule">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">ajouter l'intervention</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
            </div>
        </div>
    </div>
</div>


<?php
//requete sql
$sql = "SELECT * FROM ampoules";
// je stock la requete dans une variable
$resultat = $BD->query($sql);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>date de changement</th>
            <th>Etage</th>
            <th>Position dans le couloir</th>
            <th>Prix</th>
            <th>Détails</th>
            <th>maise à jour</th>
            <th>supprimer</th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($resultat as $row) {
            $date_formater = new DateTime($row['date_changement']);
        ?>

            <tr>
                <td><?= $row['id_ampoule'] ?></td>
                <td><?= $date_formater->format('d/n/y à H:i:s'); ?></td>
                <td><?= $row['etage'] ?></td>
                <td><?= $row['position_ampoule'] ?></td>
                <td><?= $row['prix_ampoule'] ?></td>
                <td>
                    <!-- Button  modal details d'une intervention -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsAmpoule<?= $row['id_ampoule'] ?>">
                        Détails
                    </button>

<!-------------------- Modal details d'une intervention  ------------------------------>
                    <div class="modal fade" id="detailsAmpoule<?= $row['id_ampoule'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Détails de l'intervention</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <li><?= "ID :" . $row['id_ampoule'] ?></li>
                                        <li><?= "Date : " . $date_formater->format('d/n/y à H:i:s'); ?></li>
                                        <li><?= "Etage : " . $row['etage'] ?></li>
                                        <li><?= "Position de l'ampoule : " . $row['position_ampoule'] ?></li>
                                        <li><?= "Prix : " . $row['prix_ampoule'] ?></li>
                                    </ul>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                <!-- Button  modifier une intervention -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateAmpoule<?= $row['id_ampoule'] ?>">
                        Update
                    </button>
                <!---------------------Modal modifier une intervention---------------------->
<div class="modal fade" id="updateAmpoule<?= $row['id_ampoule'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier l'intervention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="majAmpoule.php?majID=<?= $row['id_ampoule'] ?>" method="POST">
                    <div class="form-group">
                        <label for="date_changement">Sélectionner une date</label>
                        <input type="date" class="form-control" name="date_changement">
                    </div>

                    <div>
                        <label for="etage">Sélectionner l'Etage</label>
                        <select  class="form-control" name="etage">
                            <option value="rdc">rdc</option>
                            <option value="Etage 1">Etage 1</option>
                            <option value="Etage 2">Etage 2</option>
                            <option value="Etage 3">Etage 3</option>
                            <option value="Etage 3">Etage 3</option>
                            <option value="Etage 4">Etage 4</option>
                            <option value="Etage 5">Etage 5</option>
                            <option value="Etage 6">Etage 6</option>
                            <option value="Etage 7">Etage 7</option>
                            <option value="Etage 8">Etage 8</option>
                            <option value="Etage 10">Etage 10</option>
                            <option value="Etage 11">Etage 11</option>
                        </select>
                    </div>

                    <div>
                        <label for="etage">Sélectionner l'emplacement</label>
                        <select class="form-control" name="position_ampoule">
                            <option value="droite">a droite</option>
                            <option value="gauche">a gauche</option>
                            <option value="fond">au fond</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prix_ampoule"></label>
                        <input type="number" step="any" class="form-control" name="prix_ampoule">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Mettre a jour l'intervention</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
            </div>
        </div>
    </div>
</div>
                </td>
                <td>
                <!-- Button modal supprimer l'intervention -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAmpoule<?= $row['id_ampoule'] ?>">
                        supprimer
                    </button>

<!-------------------- Modal supprimer l'intervention  ------------------------------>
                    <div class="modal fade" id="deleteAmpoule<?= $row['id_ampoule'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">supprimer l'intervention</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <a href="supprimerIntervention.php?supprimerID=<?= $row['id_ampoule'] ?>"class="btn btn-danger">SUPPRIMER</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require "template.php";
?>