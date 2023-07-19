<?php


require("bdd/connexionBDD.php");

session_start();

if (!isset($_SESSION['idUtilisateur'])) {
    echo "Vous devez être connecté pour ajouter un jeu aux favoris.";
    exit;
}

$idUser = $_SESSION['idUtilisateur'];
$idJeu = $_POST['id_jeux'];


// Vérifier si le jeu est déjà en favori pour cet utilisateur
$sqlCheckFavori = "SELECT id_favori FROM favoris WHERE id_utilisateurf = ? AND id_jeuxf = ?";
$stmtCheckFavori = mysqli_prepare($conn, $sqlCheckFavori);
mysqli_stmt_bind_param($stmtCheckFavori, "ii", $idUser, $idJeu);
mysqli_stmt_execute($stmtCheckFavori);
$resultCheckFavori = mysqli_stmt_get_result($stmtCheckFavori);

mysqli_stmt_store_result($stmtCheckFavori);

if (mysqli_num_rows($resultCheckFavori) > 0) {
    $response['success'] = false;
    $response['message'] = "Le jeu est déjà en favori pour cet utilisateur.";
    
} else {
// Insérer le jeu en favori pour cet utilisateur
$sqlInsertFavori = "INSERT INTO favoris (id_utilisateurf, id_jeuxf) VALUES (?, ?)";
$stmtInsertFavori = mysqli_prepare($conn, $sqlInsertFavori);
mysqli_stmt_bind_param($stmtInsertFavori, "ii", $idUser, $idJeu);
mysqli_stmt_execute($stmtInsertFavori);

// Vérifier si l'insertion a réussi
if (mysqli_stmt_affected_rows($stmtInsertFavori) > 0) {
    // Mettre à jour le score du jeu
    $sqlUpdateScore = "UPDATE jeux SET score = score + 1 WHERE id_jeux = ?";
    $stmtUpdateScore = mysqli_prepare($conn, $sqlUpdateScore);
    mysqli_stmt_bind_param($stmtUpdateScore, "i", $idJeu);
    mysqli_stmt_execute($stmtUpdateScore);

    $response['success'] = true;
    $response['message'] = "Le jeu a été ajouté en favori et le score a été mis à jour.";
} else {
    $response['success'] = false;
    $response['message'] = "Une erreur s'est produite lors de l'ajout en favori.";
}
}
// Fermer les déclarations préparées
mysqli_stmt_close($stmtInsertFavori);
mysqli_stmt_close($stmtUpdateScore);
// Mettre à jour le score du jeu
$sqlUpdateScore = "UPDATE jeux SET score = score + 1 WHERE id_jeux = ?";
$stmtUpdateScore = mysqli_prepare($conn, $sqlUpdateScore);
mysqli_stmt_bind_param($stmtUpdateScore, "i", $idJeu);
mysqli_stmt_execute($stmtUpdateScore);
mysqli_stmt_close($stmtUpdateScore);

// Convertir le tableau en JSON et renvoyer la réponse
echo json_encode($response);
?>
