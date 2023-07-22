<?php
require("../bdd/connexionBDD.php");
include '../common/header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Récupérer l'email fourni par l'utilisateur
  $email = $_POST["email"];

  $sql = "SELECT * FROM utilisateur WHERE email_utilisateur = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result->num_rows === 1) {
    $token = bin2hex(random_bytes(32));

    $sql = "UPDATE utilisateur SET reset_token = ? WHERE email_utilisateur = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
    mysqli_stmt_execute($stmt);

    // Envoyer l'e-mail de réinitialisation
    $resetLink = "https://example.com/reset-password.php?email=" . urlencode($email) . "&token=" . urlencode($token);
    $subject = "Réinitialisation du mot de passe";
    $message = "Bonjour,\n\nVous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le lien suivant pour procéder à la réinitialisation :\n\n" . $resetLink . "\n\nSi vous n'avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer cet e-mail.\n\nCordialement,\nL'équipe du site";
    $headers = "From: Gamesoft@hotmail.com\r\n";
    $headers .= "Reply-To: Gamesoft@hotmail.com\r\n";

    echo $message;

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
<main class="pt-5">
  <section class="pt-5">
    <form class="pt-5" method="POST">
      <div class="form-outline mb-4">
        <label class="form-label" for="formEmail">Email</label>
        <input type="email" id="formEmail" class="form-control form-control-lg" name="email" required />
      </div>
      <button class="btn btn-primary btn-lg btn-block" type="submit">S'inscrire</button>
    </form>
  </section>
</main>