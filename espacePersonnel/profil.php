<?php
session_start();
include '../bdd/connexionBDD.php';

// Récupérer les informations de l'utilisateur à partir de la base de données
$user_id = $_SESSION['id_utilisateur'];
$sql = "SELECT `id_utilisateur`, `nom_utilisateur`, `mdp_utilisateur`, `email_utilisateur` FROM `utilisateur` WHERE `id_utilisateur` = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Gérer le cas où l'utilisateur n'existe pas
    echo "Utilisateur non trouvé.";
    exit;
}

// Traitement de la mise à jour du profil si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    // Vérifier et mettre à jour les informations dans la base de données
    // Assurez-vous de sécuriser correctement les données avant de les insérer dans la requête SQL pour éviter les injections SQL

    // Exemple de requête de mise à jour pour le nom d'utilisateur et l'email (vous devrez ajouter le champ pour le mot de passe si nécessaire)
    $update_sql = "UPDATE `utilisateur` SET `nom_utilisateur`='$new_name', `email_utilisateur`='$new_email' WHERE `id_utilisateur` = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        // Mettre à jour les informations de l'utilisateur dans la session
        $_SESSION['nom_utilisateur'] = $new_name;
        $_SESSION['email_utilisateur'] = $new_email;

        // Rediriger vers la page du profil après la mise à jour
        header("Location: profil.php");
        exit;
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <!-- Ajouter vos liens CSS ici -->
</head>

<body>
    <h1>Bienvenue sur votre profil, <?php echo $_SESSION['nom_utilisateur']; ?></h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="new_name">Nom :</label>
        <input type="text" name="new_name" value="<?php echo $user['nom_utilisateur']; ?>"><br>

        <label for="new_email">Email :</label>
        <input type="email" name="new_email" value="<?php echo $user['email_utilisateur']; ?>"><br>

        <!-- Ajoutez le champ pour le mot de passe ici si nécessaire -->
        <!-- <label for="new_password">Mot de passe :</label>
        <input type="password" name="new_password" value=""><br> -->

        <input type="submit" value="Mettre à jour">
    </form>
    <!-- Ajouter vos autres éléments de la page ici -->
</body>

</html>
