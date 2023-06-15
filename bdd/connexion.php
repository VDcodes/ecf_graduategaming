<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$database = "ecf_g";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Connexion réussie
// echo "Connexion à la base de données réussie !";

//Faire une lecture de BDD pour afficher.


//INSERT INTO `jeux` (`id_jeux`, `date_creation`, `titre`, `descriptif`, `nom_studio`, `support`, `poids`, `score`, `moteur_jeux`, `date_maj`, `date_fin_creation`, `budget`, `statut`, `type`, `nb_joueur`) VALUES (NULL, '2023-06-10', 'Jeu test 01', 'Test 01 descro', 'Test nom sutdio', 'support 01', '10', '10', 'Unity', '2023-06-09', '2023-06-10', '10000', 'statut 01', 'type 01', '100');
// Exécuter une requête SELECT pour récupérer les données de votre table
// $sql = "SELECT * FROM jeux";
// $result = $conn->query($sql);

// // Vérifier si des données ont été trouvées
// if ($result->num_rows > 0) {
//     // Afficher les données dans un tableau
    
//     while ($row = $result->fetch_assoc()) {echo "<table>";
//     echo "<tr><th>id_jeux</th><th>date_creation</th><th>descriptif</th><th>nom_studio</th><th>support</th><th>poids</th><th>score</th><th>moteux_jeux</th><th>date_maj</th><th>date_fin_creation</th><th>budget</th><th>statut</th><th>type</th><th>nb_joueur</th></tr>";
//         echo "<tr>";
//         echo "<td>" . $row["id_jeux"] . "</td>";
//         echo "<td>" . $row["date_creation"] . "</td>";
//         echo "<td>" . $row["descriptif"] . "</td>";
//         echo "<td>" . $row["nom_studio"] . "</td>";
//         echo "<td>" . $row["support"] . "</td>";
//         echo "<td>" . $row["poids"] . "</td>";
//         echo "<td>" . $row["score"] . "</td>";
//         echo "<td>" . $row["moteur_jeux"] . "</td>";
//         echo "<td>" . $row["date_maj"] . "</td>";
//         echo "<td>" . $row["date_fin_creation"] . "</td>";
//         echo "<td>" . $row["budget"] . "</td>";
//         echo "<td>" . $row["statut"] . "</td>";
//         echo "<td>" . $row["type"] . "</td>";
//         echo "<td>" . $row["nb_joueur"] . "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// } else {
//     echo "Aucune donnée trouvée dans la table.";
// }


// // Fermer la connexion
// $conn->close();
?>
