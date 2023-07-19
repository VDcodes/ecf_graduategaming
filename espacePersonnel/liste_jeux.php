<?php 
require("../bdd/connexionBDD.php");
?>
<div class="mt-3">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>Titre du jeu</th>
            <th>Date de début de production</th>
            <th>Score <i class="fa-solid fa-star"></i> </th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Requête SQL pour récupérer les informations du budget de chaque jeu vidéo
        $sql = "SELECT titre,date_creation,score FROM jeux";
        
        $result = $conn->query($sql);
        // Vérifier si des données ont été trouvées
        if ($result->num_rows > 0) {        
            // Affiche les résultats
            while ($row = $result->fetch_assoc()) {            
                echo "<tr>";
                    echo "<td>".$row['titre']."</td>";
                    echo "<td>".$row['date_creation']."</td>";
                    echo "<td>".$row['score']."</td>";
                echo "</tr>";               
            }
        }
        ?>
        </tbody>
    </table>
</div>