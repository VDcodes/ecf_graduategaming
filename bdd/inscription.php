<?php
include 'connexionBDD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['motDePasse'])) {
  // Récupérer les données du formulaire
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $motDePasse = $_POST['motDePasse'];

  // Vérifier si les champs sont vides
  if (empty($nom) || empty($email) || empty($motDePasse)) {
    echo 'vide';
    exit();
  }

  // Vérifier si l'utilisateur existe déjà dans la base de données
  $stmt = $conn->prepare('SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur = ?');
  $stmt->bind_param('s', $nom);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // L'utilisateur existe déjà
    echo 'existing_user';
  } else {
    // Hasher le mot de passe avant de l'enregistrer dans la base de données
    $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la base de données
    $stmt = $conn->prepare('INSERT INTO utilisateur (nom_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $nom, $email, $hashedPassword);

    if ($stmt->execute()) {
      // Compte créé avec succès
      echo 'success';
    } else {
      // Erreur lors de l'insertion dans la base de données
      echo 'error';
    }
  }

  $stmt->close();
} else {
  // Requête invalide
  echo 'error';
}
