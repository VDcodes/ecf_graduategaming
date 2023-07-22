<?php
require("../bdd/connexionBDD.php");
?>
<div class="mt-3">

    <script>
        function modifierJeux(idJeux) {
            console.log('Modification du jeux', idJeux);
            $.ajax({
                url: 'creation_jeux.php',
                type: 'GET',
                data: 'ID_JEUX=' + idJeux,
                success: function(res) {
                    $('#modifier-jeux').html(res);
                },
                error: function(request, status, error) {
                    console.log("ajax call went wrong:" + request.responseText);
                }
            });
        }
    </script>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Titre du jeu</th>
                <th>Date de début de production</th>
                <th>Score <i class="fa-solid fa-star"></i> </th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Requête SQL pour récupérer les informations du budget de chaque jeu vidéo
            $sql = "SELECT id_jeux,titre,date_creation,score FROM jeux";

            $result = $conn->query($sql);
            // Vérifier si des données ont été trouvées
            if ($result->num_rows > 0) {
                // Affiche les résultats
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['titre'] . "</td>";
                    echo "<td>" . $row['date_creation'] . "</td>";
                    echo "<td>" . $row['score'] . "</td>";
                    echo "<td><button class=\"btn btn-small\" onclick=\"modifierJeux(" . $row['id_jeux'] . ")\"><i class=\"fa-solid fa-edit\"></i></button></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <div id="modifier-jeux">

    </div>
</div>