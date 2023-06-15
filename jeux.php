<?php 

function listeJeuxAccueil(){
    require("bdd/connexion.php");
    $retourHTML = "";
    $sql = "SELECT nom_studio, descriptif FROM jeux LIMIT 6";
    $result = $conn->query($sql);

    // Vérifier si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Afficher les données dans un tableau
        
        while ($row = $result->fetch_assoc()) {            
            $retourHTML .="<div class=\"row equal-height-cards\">
                            <div class=\"col-md-4 mb-4\">
                            <div class=\"card shadow-sm\">
                                <svg class=\"bd-placeholder-img card-img-top\" width=\"100%\" height=\"225\" xmlns=\"http://www.w3.org/2000/svg\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\" role=\"img\" aria-label=\"Placeholder: Thumbnail\"><title>Placeholder</title><rect width=\"100%\" height=\"100%\" fill=\"#55595c\"/><text x=\"50%\" y=\"50%\" fill=\"#eceeef\" dy=\".3em\">Thumbnail</text></svg>
                                <div class=\"card-body\">
                                <p class=\"card-text\">".utf8_encode($row["descriptif"])."</p>
                                <div class=\"d-flex justify-content-between align-items-center\">
                                    <div class=\"btn-group\">
                                    <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Voir</button>
                                    <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Favori</button>
                                    </div>
                                    <small class=\"text-muted\">".$row["nom_studio"]."</small>
                                </div>
                                </div>
                            </div>
                           </div>";
        }
    }
    return $retourHTML;
}

// function pageJeux(){

// }
