<?php
// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Inclusion du fichier de connexion à la base de données
  require("../bdd/connexionBDD.php");

  // Récupération des valeurs du formulaire
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

  // Requête SQL préparée pour insérer les valeurs dans la table "jeux"
  $sql = "INSERT INTO jeux (date_creation, titre, descriptif, nom_studio, support, poids, moteur_jeux, date_maj, date_fin_creation, budget, statut, type_jeux, nb_joueur) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  // Préparation de la requête
  $stmt = mysqli_prepare($conn, $sql);

  // Vérification si la préparation de la requête a réussi
  if ($stmt) {
    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $dateCreation, $titre, $descriptif, $nomStudio, $support, $poids, $moteurJeux, $dateMaj, $dateFinCreation, $budget, $statut, $type, $nbJoueur);

    // Exécution de la requête
    mysqli_stmt_execute($stmt);

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
  } else {
    // Gestion de l'erreur de préparation de la requête
    $error = "Une erreur s'est produite lors de la préparation de la requête.";
  }

  // Fermeture de la connexion à la base de données
  mysqli_close($conn);
}
?>

<div class="">
  <h2 class="mt-3">Création de jeux</h2>
  <?php if (isset($error)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
    </div>
  <?php } ?>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div class="form-group">
      <label for="date_creation">Date de création :</label>
      <input type="date" class="form-control" id="date_creation" name="date_creation" required>
    </div>
    <div class="form-group">
      <label for="titre">Titre :</label>
      <input type="text" class="form-control" id="titre" name="titre" required>
    </div>
    <div class="form-group">
      <label for="descriptif">Descriptif :</label>
      <textarea class="form-control" id="descriptif" name="descriptif" required></textarea>
    </div>
    <div class="form-group">
      <label for="nom_studio">Nom du studio :</label>
      <input type="text" class="form-control" id="nom_studio" name="nom_studio" required>
    </div>
    <div class="form-group">
      <label for="support">Support :</label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="PC" id="support_pc" name="support[]">
        <label class="form-check-label" for="support_pc">
          PC
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Xbox" id="support_xbox" name="support[]">
        <label class="form-check-label" for="support_xbox">
          Xbox
        </label>
      </div>
    </div>
    <div class="form-group">
      <label for="poids">Poids :</label>
      <input type="number" class="form-control" id="poids" name="poids" required>
    </div>
    <div class="form-group">
      <label for="support">moteur_jeux :</label>
      <select class="form-control" id="moteur_jeux" name="moteur_jeux" required>
        <option value="">Sélectionnez le moteur du jeu</option>
        <option value="Unity">Unity</option>
        <option value="Unreal">Unreal</option>
        <option value="CryEngine">CryEngine</option>
      </select>
    </div>
    <div class="form-group">
      <label for="date_fin_creation">Date de fin de création :</label>
      <input type="date" class="form-control" id="date_fin_creation" name="date_fin_creation" required>
    </div>
    <div class="form-group">
      <label for="budget">Budget :</label>
      <input type="number" class="form-control" id="budget" name="budget" required>
    </div>
    <div class="form-group">
      <label for="statut">Statut :</label>
      <select class="form-control" id="statut" name="statut" required>
        <option value="">Sélectionnez un statut</option>
        <option value="En développement">En développement</option>
        <option value="Terminé">Terminé</option>
      </select>
    </div>
    <div class="form-group">
      <label for="type">Type :</label>
      <input type="text" class="form-control" id="type_jeux" name="type_jeux" required>
    </div>
    <div class="form-group">
      <label for="nb_joueur">Nombre de joueurs :</label>
      <input type="number" class="form-control" id="nb_joueur" name="nb_joueur" required>
    </div>
    <!-- <div class="form-group">
          <label for="image_jeux">Image du jeu :</label>
          <input type="file" class="form-control-file" id="image_jeux" name="image_jeux" required> -->
    </div> 
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </form>
</div>
</div>