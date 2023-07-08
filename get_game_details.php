<?php
// Inclure ici la logique de connexion à la base de données
require("../bdd/connexionBDD.php");

// Vérifier si l'ID du jeu vidéo est présent dans la requête

if (isset($_GET['id'])) {
    $gameId = $_GET['id'];

    // Construire la requête SQL pour récupérer les informations du jeu vidéo
    $query = "SELECT titre, descriptif, score FROM jeux WHERE id_jeux = '$gameId'";

    // Exécuter la requête SQL et récupérer les résultats
    // Utiliser ici la méthode de connexion à la base de données de ton choix (mysqli, PDO, etc.)
    // et exécuter la requête avec les paramètres appropriés

    // Exemple avec mysqli
    $mysqli = new mysqli("localhost", "username", "password", "database");
    $result = $mysqli->query($query);

    // Vérifier si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Récupérer les informations du jeu vidéo
        $gameData = $result->fetch_assoc();

        // Fermer la connexion à la base de données
        $mysqli->close();

        // Convertir les données en format JSON et les renvoyer
        header('Content-Type: application/json');
        echo json_encode($gameData);
    } else {
        // Si aucun jeu vidéo n'a été trouvé, renvoyer une réponse vide
        header('Content-Type: application/json');
        echo json_encode([]);
    }
} else {
    // Si l'ID du jeu vidéo n'est pas présent dans la requête, renvoyer une réponse vide
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
