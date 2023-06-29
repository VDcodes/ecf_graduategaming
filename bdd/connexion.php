<?php
include 'connexionBDD.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$motDePasse = $_POST['motDePasse'];

// Vérifier si les champs sont vides
if (empty($nom) || empty($motDePasse)) {
  echo 'error';
  exit();
}

// Vérifier les informations de connexion dans la base de données
$stmt = $conn->prepare('SELECT mdp_utilisateur FROM utilisateur WHERE nom_utilisateur = ?');
$stmt->bind_param('s', $nom);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  // L'utilisateur existe, vérifier le mot de passe
  $row = $result->fetch_assoc();

  $hashedPassword = $row['mdp_utilisateur'];

  if (password_verify($motDePasse, $hashedPassword)) {
    // Connexion réussie
    session_start();
    if(strlen($nom)>12){
      $nom = substr($nom,0,12);
    }
    $_SESSION['nomUtilisateur'] = $nom;
    echo 'success';
  } else {
    // Mot de passe incorrect
    echo 'error';
  }
} else {
  // L'utilisateur n'existe pas
  echo 'error';
}

$stmt->close();
$conn->close();
?>
