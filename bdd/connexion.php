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
$stmt = $conn->prepare('SELECT mdp_utilisateur,id_utilisateur,valeur_typeUtilisateurs FROM utilisateur WHERE nom_utilisateur = ?');
$stmt->bind_param('s', $nom);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  // L'utilisateur existe, vérifier le mot de passe
  $row = $result->fetch_assoc();
  $valeur_idUtilisateur = $row['id_utilisateur'];
  $valeur_typeUtilisateur = $row['valeur_typeUtilisateurs'];

  $hashedPassword = $row['mdp_utilisateur'];

  if (password_verify($motDePasse, $hashedPassword)) {
    // Connexion réussie
    session_start();

    $_SESSION['idUtilisateur'] = $valeur_idUtilisateur;
    $_SESSION['nomUtilisateur'] = $nom;
    $_SESSION["typeUtilisateur"] = $valeur_typeUtilisateur; //1 : Admin; 2 : Utilisateur; 3 : Producteur; 4 : Community Manager
   
      // Récupérer et stocker l'email de l'utilisateur
  $stmt_email = $conn->prepare('SELECT email_utilisateur FROM utilisateur WHERE nom_utilisateur = ?');
  $stmt_email->bind_param('s', $nom);
  $stmt_email->execute();
  $result_email = $stmt_email->get_result();

  $row_email = $result_email->fetch_assoc();
  $_SESSION['emailUtilisateur'] = $row_email['email_utilisateur'];

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
