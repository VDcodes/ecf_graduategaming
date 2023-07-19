<?php

include 'connexionBDD.php';

$req = $bdd->prepare('INSERT INTO actualite(TITRE, DESCRIPTIF, TEXTE, DATE_CREATION, AUTEUR, FICHIER) VALUES (:titre,:sous_titre,:texte,:date_creation,:auteur,:fichier)');
$req->execute(array(
      'titre' => $_POST['titre'],
      'sous_titre' => $_POST['sous_titre'],
      'texte' => $_POST['texte'],
      'date_creation' =>$_POST['date_creation'],
      ));

$req->closeCursor();


header('Location: ../espacePersonnel/espace_personnel.php')

?>
