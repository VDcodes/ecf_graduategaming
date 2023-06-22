<?php
session_start();

include("connexionBDD.php");

if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['motDePasse'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    // Vérifier si l'utilisateur existe déjà dans la base de données
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE nom_utilisateur = ?");
    $stmt->bind_param("s", $nom);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'existing_user';
    } else {
        // Enregistrer l'utilisateur dans la base de données
        $stmt = $conn->prepare("INSERT INTO utilisateur (nom_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (?, ?, ?)");

        // Hachage du mot de passe
        $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $nom, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Enregistrer la session
            $_SESSION['username'] = $nom; //A faire lors de la connexion ?!
            echo 'success';
        } else {
            echo 'error execute';           
        }
    }
    // Fermer la première requête
    $stmt->close();
} else {
    // Paramètres manquants
    echo 'error param';
}

// Fermer la connexion à la base de données
$conn->close();
?>
