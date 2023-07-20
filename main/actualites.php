<?php
// Inclure le fichier de connexion à la base de données
include_once('../bdd/connexionBDD.php');

// Requête pour récupérer les actualités depuis la table "actualites"
$query = "SELECT titre, descriptif, date_creation FROM actualites ORDER BY date_creation DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erreur lors de la récupération des actualités : " . mysqli_error($conn));
}

$news = array();
while ($row = mysqli_fetch_assoc($result)) {
    $news[] = $row;
}

?>

<div class="card bg-transparent border-0" style="width: 100%;">
    <?php
    $firstIteration = true;
    $counter = 0; // Compteur pour suivre le nombre d'actualités affichées
    foreach ($news as $item) {
        $formattedDate = strftime('%x', strtotime($item['date_creation']));
        if ($counter >= 4) {
            break; // Sortir de la boucle si on a déjà affiché les 3 dernières actualités
        }

        if ($firstIteration) {
            $firstIteration = false;
            ?>
            <div class="rounded card-img-top d-flex justify-content-center align-items-center" style="max-height: 300px; overflow: hidden;">
                <h1 class="p-3 font-weight-bold" style="position: absolute; top: 0; left: 0;">Actualités</h1>
                <img class="img-fluid rounded" src="../img/actus.jpg" width="100%" alt="">
            </div>
            <?php
            continue;
        }
        ?>
        <hr class="m-0" />
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <p class="font-weight-bold"><?= $item["titre"] ?></p>
                <span class="small text-muted"><?= $formattedDate ?></span>
            </div>
            <p class="mb-0"><?= $item["descriptif"] ?></p>
        </div>
        <?php
        $counter++; // Incrémenter le compteur après avoir affiché une actualité
    }
    ?>
</div>
