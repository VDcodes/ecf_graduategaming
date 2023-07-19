<?php
require("../bdd/connexionBDD.php");
include '../common/header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Récupérer l'email fourni par l'utilisateur
  $email = $_POST["email"];

  // Vérifier si l'email existe dans la base de données
  $query = "SELECT * FROM utilisateur WHERE email_utilisateur = :email";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":email", $email);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    // Générer un jeton aléatoire pour la réinitialisation du mot de passe
    $token = bin2hex(random_bytes(32));

    // Stocker le jeton et l'email de l'utilisateur dans la base de données
    $query = "UPDATE utilisateur SET reset_token = :token WHERE email_utilisateur = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":token", $token);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    // Envoyer l'e-mail de réinitialisation
    $resetLink = "https://example.com/reset-password.php?email=" . urlencode($email) . "&token=" . urlencode($token);
    $subject = "Réinitialisation du mot de passe";
    $message = "Bonjour,\n\nVous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le lien suivant pour procéder à la réinitialisation :\n\n" . $resetLink . "\n\nSi vous n'avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer cet e-mail.\n\nCordialement,\nL'équipe du site";
    $headers = "From: Gamesoft@hotmail.com\r\n";
    $headers .= "Reply-To: Gamesoft@hotmail.com\r\n";

    if (mail($email, $subject, $message, $headers)) {
      echo "success";
    } else {
      echo "error";
    }
  } else {
    echo "invalid_email";
  }
}
?>