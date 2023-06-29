<?php
session_start();
include("connexionBDD.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['motDePasse'])) {
        if ($_POST['nom'] === '' || $_POST['email'] === '' || $_POST['motDePasse'] === '') {
            echo 'vide';
            exit;
        } else {
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
                exit;
            } else {
                // Enregistrer l'utilisateur dans la base de données
                $stmt = $conn->prepare("INSERT INTO utilisateur (nom_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (?, ?, ?)");

                // Hachage du mot de passe
                $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

                $stmt->bind_param("sss", $nom, $email, $hashedPassword);

                if ($stmt->execute()) {
                    // Enregistrer la session
                    $_SESSION['nom'] = $nom;
                    echo 'success';
                    exit;
                } else {
                    echo 'error_execute';
                    exit;
                }
            }
            // Fermer la première requête
            $stmt->close();
        }
    } else {
        // Paramètres manquants
        echo 'missing_data';
        exit;
    }
} else {
    // Redirection vers la page d'accueil si l'accès direct à ce fichier est tenté
    header('Location: page_de_connexion.php');
    exit;
}
// Fermer la connexion à la base de données
$conn->close();
?>
