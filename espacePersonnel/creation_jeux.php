<?php
// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Inclusion du fichier de connexion à la base de données
  require("../bdd/connexionBDD.php");

  // Récupération des valeurs du formulaire
  $idJeux = $_POST['id_jeux'];
  $dateCreation = $_POST['date_creation'];
  $titre = $_POST['titre'];
  $descriptif = $_POST['descriptif'];
  $nomStudio = $_POST['nom_studio'];
  $support = isset($_POST['support']) ? implode(', ', $_POST['support']) : '';
  $poids = $_POST['poids'];
  $moteurJeux = $_POST['moteur_jeux'];
  $dateFinCreation = $_POST['date_fin_creation'];
  $budget = $_POST['budget'];
  $statut = $_POST['statut'];
  $type = $_POST['type_jeux'];
  $nbJoueur = $_POST['nb_joueur'];
  // $imageData = base64_encode(file_get_contents($_FILES['image_jeux']['tmp_name']));

  // Définition de la date de mise à jour à la date actuelle
  $dateMaj = date('Y-m-d');

  // Création
  if (empty($idJeux)) {
    // Requête SQL préparée pour insérer les valeurs dans la table "jeux"
    $sql = "INSERT INTO jeux (date_creation, titre, descriptif, nom_studio, support, poids, moteur_jeux, date_maj, date_fin_creation, budget, statut, type_jeux, nb_joueur, score) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";

    // Préparation de la requête
    $stmt = mysqli_prepare($conn, $sql);

    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "sssssisssissi", $dateCreation, $titre, $descriptif, $nomStudio, $support, $poids, $moteurJeux, $dateMaj, $dateFinCreation, $budget, $statut, $type, $nbJoueur);

    // Exécution de la requête
    mysqli_stmt_execute($stmt);
  } else {
    // Requête SQL préparée pour modifier les valeurs dans la table "jeux"
    $sql = "UPDATE jeux SET date_creation = ?, descriptif = ?, nom_studio = ?, support = ?, poids = ?, moteur_jeux = ?, date_maj = ?, date_fin_creation = ?, budget = ?, statut = ?, type_jeux = ?, nb_joueur = ? WHERE id_jeux = ?";

    // Préparation de la requête
    $stmt = mysqli_prepare($conn, $sql);

    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "ssssisssissii", $dateCreation, $descriptif, $nomStudio, $support, $poids, $moteurJeux, $dateMaj, $dateFinCreation, $budget, $statut, $type, $nbJoueur, $idJeux);

    // Exécution de la requête
    mysqli_stmt_execute($stmt);
  }

  // Vérification si l'insertion a réussi
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    // Redirection vers la page "espace_personnel.php" après l'enregistrement réussi
    header('Location: espace_personnel.php');
    exit;
  } else {
    // Gestion de l'erreur d'insertion
    $error = "Une erreur s'est produite lors de l'enregistrement des données.";
  }

  // Fermeture de la requête préparée
  mysqli_stmt_close($stmt);
}
?>

<?php

$defaultValues = (object)[
  'id_jeux' => "",
  'date_creation' => "",
  'titre' => "",
  'descriptif' => "",
  'nom_studio' => "",
  'poids' => "",
  'moteur_jeux' => "",
  'date_fin_creation' => "",
  'budget' => "",
  'statut' => "",
  'type_jeux' => "",
  'nb_joueur' => "",
  'support' => "",
];

$isModification = isset($_GET['ID_JEUX']);

if ($isModification) {
  require("../bdd/connexionBDD.php");

  $idJeux = $_GET['ID_JEUX'];

  $sql = "SELECT date_creation, titre, descriptif, nom_studio, support, poids, moteur_jeux, date_fin_creation, budget, statut, type_jeux, nb_joueur FROM jeux WHERE id_jeux = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $idJeux);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  // Vérifier si des données ont été trouvées
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $defaultValues = (object)[
      'id_jeux' => $idJeux,
      'date_creation' => $row['date_creation'],
      'titre' => $row['titre'],
      'descriptif' => $row['descriptif'],
      'nom_studio' => $row['nom_studio'],
      'poids' => $row['poids'],
      'moteur_jeux' => $row['moteur_jeux'],
      'date_fin_creation' => $row['date_fin_creation'],
      'budget' => $row['budget'],
      'statut' => $row['statut'],
      'type_jeux' => $row['type_jeux'],
      'nb_joueur' => $row['nb_joueur'],
      'support' => $row['support'],
    ];
  }
  mysqli_close($conn);
}
?>


<div class="">
  <h2 class="mt-3">
    <?php
    if ($isModification) {
      echo "Modification d'un jeux";
    } else {
      echo "Création de jeux";
    }
    ?>
  </h2>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
    </div>
  <?php } ?>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="id_jeux" value="<?= $defaultValues->id_jeux ?>">
    <div class="form-group">
      <label for="date_creation">Date de création :</label>
      <input type="date" class="form-control" id="date_creation" name="date_creation" required value="<?= $defaultValues->date_creation ?>">
    </div>
    <div class="form-group">
      <label for="titre">Titre :</label>
      <input type="text" class="form-control" id="titre" name="titre" required value="<?= $defaultValues->titre ?>" <?= $isModification ? "readonly" : "" ?>>
    </div>
    <div class="form-group">
      <label for="descriptif">Descriptif :</label>
      <textarea class="form-control" id="descriptif" name="descriptif" required><?= $defaultValues->descriptif ?></textarea>
    </div>
    <div class="form-group">
      <label for="nom_studio">Nom du studio :</label>
      <input type="text" class="form-control" id="nom_studio" name="nom_studio" required value="<?= $defaultValues->nom_studio ?>">
    </div>
    <div class="form-group">
      <label for="support">Support :</label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="PC" id="support_pc" name="support[]" <?= strpos($defaultValues->support, 'PC') !== false  ? 'checked' : '' ?>>
        <label class="form-check-label" for="support_pc">
          PC
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Xbox" id="support_xbox" name="support[]" <?= strpos($defaultValues->support, 'Xbox') !== false ? 'checked' : '' ?>>
        <label class="form-check-label" for="support_xbox">
          Xbox
        </label>
      </div>
    </div>
    <div class="form-group">
      <label for="poids">Poids :</label>
      <input type="number" class="form-control" id="poids" name="poids" required value="<?= $defaultValues->poids ?>">
    </div>
    <div class="form-group">
      <label for="support">moteur_jeux :</label>
      <select class="form-control" id="moteur_jeux" name="moteur_jeux" required">
        <option value="">Sélectionnez le moteur du jeu</option>
        <option value="Unity" <?= $defaultValues->moteur_jeux == "Unity" ? "selected" : "" ?>>Unity</option>
        <option value="Unreal" <?= $defaultValues->moteur_jeux == "Unreal" ? "selected" : "" ?>>Unreal</option>
        <option value="CryEngine" <?= $defaultValues->moteur_jeux == "CryEngine" ? "selected" : "" ?>>CryEngine</option>
      </select>
    </div>
    <div class="form-group">
      <label for="date_fin_creation">Date de fin de création :</label>
      <input type="date" class="form-control" id="date_fin_creation" name="date_fin_creation" required value="<?= $defaultValues->date_fin_creation ?>">
    </div>
    <div class="form-group">
      <label for="budget">Budget :</label>
      <input type="number" class="form-control" id="budget" name="budget" required value="<?= $defaultValues->budget ?>">
    </div>
    <div class="form-group">
      <label for="statut">Statut :</label>
      <select class="form-control" id="statut" name="statut" required>
        <option value="">Sélectionnez un statut</option>
        <option value="En développement" <?= $defaultValues->statut == "En développement" ? "selected" : "" ?>>En développement</option>
        <option value="Terminé" <?= $defaultValues->statut == "Terminé" ? "selected" : "" ?>>Terminé</option>
      </select>
    </div>
    <div class="form-group">
      <label for="type">Type :</label>
      <input type="text" class="form-control" id="type_jeux" name="type_jeux" required value="<?= $defaultValues->type_jeux ?>">
    </div>
    <div class="form-group">
      <label for="nb_joueur">Nombre de joueurs :</label>
      <input type="number" class="form-control" id="nb_joueur" name="nb_joueur" required value="<?= $defaultValues->nb_joueur ?>">
    </div>
    <!-- <div class="form-group">
          <label for="image_jeux">Image du jeu :</label>
          <input type="file" class="form-control-file" id="image_jeux" name="image_jeux" required> -->
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </form>
</div>
</div>