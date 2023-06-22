<?php 

function listeJeuxAccueil(){
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