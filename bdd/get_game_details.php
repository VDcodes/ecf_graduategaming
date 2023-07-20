<?php
// Inclure ici la logique de connexion à la base de données
require("connexionBDD.php");

// Vérifier si l'ID du jeu vidéo est présent dans la requête
$retourHTML ="";
if (isset($_POST['id_jeux'])) {
    $gameId = $_POST['id_jeux'];

    // Construire la requête SQL pour récupérer les informations du jeu vidéo
    $sql = "SELECT date_creation, titre, descriptif, nom_studio, support, poids, moteur_jeux, date_fin_creation, statut, type_jeux, nb_joueur FROM jeux WHERE id_jeux = '$gameId'";
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
                <p><strong>Date de création:</strong> ".$gameData["date_creation"]."</p>
                <p><strong>Descriptif:</strong> ".$gameData["descriptif"]."</p>
                <p><strong>Nom du studio:</strong> ".$gameData["nom_studio"]."</p>
                <p><strong>Support:</strong> ".$gameData["support"]."</p>
                <p><strong>Poids:</strong> ".$gameData["poids"]." Mo</p>
                <p><strong>Moteur de jeux:</strong> ".$gameData["moteur_jeux"]."</p>
                <p><strong>Date de fin de création:</strong> ".$gameData["date_fin_creation"]."</p>
                <p><strong>Statut:</strong> ".$gameData["statut"]."</p>
                <p><strong>Type de jeux:</strong> ".$gameData["type_jeux"]."</p>
                <p><strong>Nombre de joueurs:</strong> ".$gameData["nb_joueur"]."</p>
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
