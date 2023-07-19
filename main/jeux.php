<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclure le fichier biblo.js -->
<script src="chemin/vers/biblo.js"></script>

<?php

require("../bdd/connexionBDD.php");


$status = "";
$date_fin_creation = "";
$nom = "";
$type = "";
$nbJeux = 0;

if (isset($_POST["status"])) $status = $_POST["status"];
if (isset($_POST["date_fin_creation"])) $date_fin_creation = $_POST["date_fin_creation"];
if (isset($_POST["nom"])) $nom = $_POST["nom"];
if (isset($_POST["type"])) $type = $_POST["type"];
if (isset($_POST["nbJeux"])) $nbJeux = $_POST["nbJeux"];

//Filtre 
$retourHTML = "";
$sql = "SELECT id_jeux, date_creation, titre, descriptif, score, image_jeux,nom_studio FROM jeux WHERE 1";

if (!empty($status)) {
    $sql .= " AND statut = '$status'";
}

if (!empty($date_fin_creation)) {
    $sql .= " AND date_fin_creation <= '$date_fin_creation'";
}

if (!empty($nom)) {
    $sql .= " AND titre LIKE '%$nom%'";
}

if (!empty($type)) {
    $sql .= " AND type_jeux LIKE '%$type%'";
}
if ($nbJeux > 0) {
    $sql .= " LIMIT " . $nbJeux;
}

// echo $sql;

?>

<div class="row rows-col-3">

    <?php
    $result = $conn->query($sql);
    // Vérifier si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Construction de la carte
        $retourHTML .= "<div class=\"row equal-height-cards\">";
        while ($row = $result->fetch_assoc()) {
            $imageBLOB = $row["image_jeux"]; // Récupérer les données binaires du BLOB
            $imageData = base64_encode($imageBLOB); // Convertir en base64
    ?>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm" style="min-height: 100%;">
                    <div class="card-img-top" style="height: 250px; overflow: hidden; display: flex; justify-content: center; align-items: center;">  
                        <img src="data:image/jpeg;base64,<?= $imageData ?>" width="100%" alt="<?= $row["titre"] ?>">
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= utf8_encode($row["descriptif"]) ?>"</p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="AfficheModalJeu('<?= $row["id_jeux"] ?>')">Voir</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="AjouterFavoris('<?= $row["id_jeux"] ?>')">Favoris</button>
                            </div>
                            <small class="text-muted"><?= $row["nom_studio"] ?>"</small>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

</div>