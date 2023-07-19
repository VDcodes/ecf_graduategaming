<?php
// Inclure ici la logique de connexion à la base de données
require("connexionBDD.php");

// Vérifier si l'ID du jeu vidéo est présent dans la requête
$retourHTML ="";
if (isset($_POST['id_jeux'])) {
    $gameId = $_POST['id_jeux'];

    // Construire la requête SQL pour récupérer les informations du jeu vidéo
    $sql = "SELECT titre, descriptif, score FROM jeux WHERE id_jeux = '$gameId'";
    $result = $conn->query($sql);
    // Vérifier si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Récupérer les informations du jeu vidéo
        $gameData = $result->fetch_assoc();
        //<!-- Modale pour la vue détaillée d'un jeu vidéo -->
        $retourHTML .= "        
          <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
              <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"gameModalLabel\">Détails du jeu vidéo : ".$gameData["titre"]."</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Fermer\">
                  <span aria-hidden=\"true\">&times;</span>
                </button>
              </div>
              <div class=\"modal-body\" id=\"gameModalBody\">
                ".utf8_encode($gameData["descriptif"])."
              </div>
              <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Fermer</button>
              </div>
            </div>
          </div>";
    } 
}

echo $retourHTML;
?>
