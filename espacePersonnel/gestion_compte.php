<?php include '../bdd/connexionBDD.php'; ?>

<h3 class="mt-3">Renseigner les informations du compte Community Manager / producteur(trice) / productrice</h3>
<form class="mb-2">
  <div class="form-group">
    <label for="">Nom : </label>
    <input type="text" class="form-control col-6" id="formName" placeholder=Nom>
  </div>
  <div class="form-group">
    <label for="">Email :</label>
    <input type="text" class="form-control col-6" id="formEmail" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="">Mot de passe :</label>
    <input type="password" class="form-control col-6" id="formPassword" placeholder="Mot de passe">
  </div>
  <div class="form-group">
    <label for="">Type de compte :</label>
    <select id="formTypeCompte" class="form-control col-4">
      <option value="3" selected>Community Manager</option>
      <option value="4">Producteur(trice)</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary" onclick="creationCompte('compteCMPM')">Enregistrer</button> 
  <div id="errorMessage" class="col-4 mt-2 pl-0" role="alert"> </div>
</form>

<hr class="" width="100%">

<!-- Affichage de la liste des utilisateurs de type CM/PM -->
<h3 class="mt-3">Liste des comptes Community Manager / producteur(trice) / productrice</h3>
<div class="mt-4">
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th class="col-3">Nom</th>
        <th class="col-4">Email</th>
        <th class="col-3">Type de compte</th>
        <th class="col-2">Reinit. mdp</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Requête SQL pour récupérer les informations du budget de chaque jeu vidéo
      $sql = "SELECT nom_utilisateur,email_utilisateur,valeur_typeUtilisateurs FROM utilisateur WHERE valeur_typeUtilisateurs IN (3,4) ORDER BY date_inscription_u";

      $result = $conn->query($sql);
      // Vérifier si des données ont été trouvées
      if ($result->num_rows > 0) {
        // Affiche les résultats
        while ($row = $result->fetch_assoc()) {
          $typeUtilisateur = "";
          echo "<tr>";
          echo "<td>" . $row['nom_utilisateur'] . "</td>";
          echo "<td>" . $row['email_utilisateur'] . "</td>";
          switch ($row["valeur_typeUtilisateurs"]) {
            case 3:
              $typeUtilisateur = "Community Manager";
              break;
            case 4:
              $typeUtilisateur = "Producteur(trice)";
              break;
          }
          echo "<td>" . $typeUtilisateur . "</td>";
          echo "<td text-center title=\"Réinitilisaer le mot de passe\"><i class=\"fa-solid fa-retweet pointer\"></i></td>";
          echo "</tr>";
        }
      }
      ?>
    </tbody>
  </table>
</div>