<?php

// Inclure ici la logique de connexion à la base de données

// Fonction pour récupérer la liste des jeux selon les filtres
function getFilteredGames($status, $date_fin_creation, $nom, $type) {
    require("bdd/connexionBDD.php");
    
    // Construire la requête SQL de récupération des jeux selon les filtres
    $query = "SELECT id_jeux, date_creation, titre, descriptif, score, image_jeux FROM jeux WHERE 1";

    if (!empty($status)) {
        $query .= " AND statut = '$status'";
    }

    if (!empty($date_fin_creation)) {
        $query .= " AND date_fin_creation <= '$date_fin_creation'";
    }

    if (!empty($nom)) {
        $query .= " AND titre LIKE '%$nom%'";
    }

    if (!empty($type)) {
        $query .= " AND type_jeux LIKE '%$type%'";
    }

    // Exécuter la requête SQL et récupérer les résultats
    // Utiliser ici la méthode de connexion à la base de données de ton choix (mysqli, PDO, etc.)
    // et exécuter la requête avec les paramètres appropriés

    // Exemple avec mysqli
    //$mysqli = new mysqli("localhost", "username", "password", "database");
    $result = $conn->query($query);

    // Créer le HTML pour afficher les jeux
    $gamesHTML = '';

    echo $query;

    while ($row = $result->fetch_assoc()) {
        $idJeux = $row['id_jeux'];
        $dateCreation = $row['date_creation'];
        $titre = $row['titre'];
        $descriptif = $row['descriptif'];
        $score = $row['score'];
        $imageJeux = $row['image_jeux'];

        // Générer le HTML pour chaque jeu
        $gameHTML = '<div class="game">';
        $gameHTML .= '<img src="' . $imageJeux . '" alt="' . $titre . '">';
        $gameHTML .= '<h3>' . $titre . '</h3>';
        $gameHTML .= '<p>' . $descriptif . '</p>';
        $gameHTML .= '<p>Score : ' . $score . '</p>';
        // Ajouter le bouton "Voir" avec la classe "view-button" et l'attribut data-id pour l'identifiant du jeu
        $gameHTML .= '<button type="button" class="btn btn-sm btn-outline-secondary view-button" data-toggle="modal" data-target="#gameModal" data-id="' . $idJeux . '">Voir</button>';

        // Ajouter d'autres informations du jeu si nécessaire
        $gameHTML .= '</div>';

        $gamesHTML .= $gameHTML;
    }

    return $gamesHTML;
}

// Fonction pour générer la liste des jeux avec ou sans filtres
function listeJeuxAccueil($status = '', $date_fin_creation = '', $nom = '', $type = '') {
    // Vérifier si des filtres sont passés en paramètres
    if (!empty($status) || !empty($date_fin_creation) || !empty($nom) || !empty($type)) {
        // Appeler la fonction pour récupérer les jeux filtrés
        $filteredGamesHTML = getFilteredGames($status, $date_fin_creation, $nom, $type);

        return $filteredGamesHTML;
    } else {
        require("bdd/connexionBDD.php");
    $retourHTML = "";
    $sql = "SELECT nom_studio, descriptif, titre, image_jeux FROM jeux LIMIT 6";
    $result = $conn->query($sql);

    // Vérifier si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Afficher les données dans un tableau
        
        $retourHTML .= "<div class=\"row equal-height-cards\">";
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $imageBLOB = $row["image_jeux"]; // Récupérer les données binaires du BLOB
            $imageData = base64_encode($imageBLOB); // Convertir en base64
        
            $retourHTML .= "<div class=\"col-md-4 mb-4\">
                                <div class=\"card shadow-sm\">
                                    <img src=\"data:image/jpeg;base64," . $imageData . "\" class=\"bd-placeholder-img card-img-top\" width=\"100%\" height=\"225\" alt=\"" . $row["titre"] . "\">
                                    <div class=\"card-body\">
                                        <p class=\"card-text\">" . utf8_encode($row["descriptif"]) . "</p>
                                        <div class=\"d-flex justify-content-between align-items-center\">
                                            <div class=\"btn-group\">
                                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Voir</button>
                                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Favori</button>
                                            </div>
                                            <small class=\"text-muted\">" . $row["nom_studio"] . "</small>
                                        </div>
                                    </div>
                                </div>
                            </div>";
        
            $counter++;
            if ($counter % 3 == 0) {
                $retourHTML .= "</div><div class=\"row equal-height-cards\">";
            }
        }
        $retourHTML .= "</div>";
        
        
    return $retourHTML;
    }
    }   
 }
