<?php
require("../bdd/connexionBDD.php");

// Vérifier si l'utilisateur est connecté (en utilisant un paramètre de session)
session_start();
if (!isset($_SESSION['idUtilisateur'])) {
  echo "Vous devez être connecté pour voir vos jeux favoris.";
  exit;
}

// Récupérer l'ID de l'utilisateur à partir de la session
$idUser = $_SESSION['idUtilisateur'];

// Effectuer une requête SELECT pour récupérer les jeux favoris de l'utilisateur
$sql = "SELECT j.titre, j.date_creation, j.type_jeux
        FROM jeux j
        INNER JOIN favoris f ON j.id_jeux = f.id_jeuxf
        WHERE f.id_utilisateurf = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUser);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Vérifier si des jeux favoris ont été trouvés
if (mysqli_num_rows($result) > 0) {
  // Afficher les jeux favoris sous forme de liste
  echo "<ul>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<li><strong>Titre :</strong> " . $row["titre"] . "</li>";
    echo "<li><strong>Date de création :</strong> " . $row["date_creation"] . "</li>";
    echo "<li><strong>Type :</strong> " . $row["type_jeux"] . "</li>";
    echo "<br>";
  }
  echo "</ul>";
} else {
  echo "Aucun jeu favori trouvé.";
}

mysqli_stmt_close($stmt);
?>
