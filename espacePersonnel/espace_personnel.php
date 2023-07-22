<?php include '../common/header.php'; ?>

<body style="background-color: #77AF9C;" >
  <main class="container mt-5 pt-5">
    <img src="../img/utilisateur.png" alt="Profile Image" class="profile-image">

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-Profil-tab" data-page="profil.php" data-toggle="tab" href="#nav-Profil" role="tab" aria-controls="nav-Profil" aria-selected="true">Profil</a>

        <!-- Admin -->
        <?php if ($_SESSION["typeUtilisateur"] == 1) { ?>
          <a class="nav-item nav-link" id="nav-gestion_compte-tab" data-page="gestion_compte.php" data-toggle="tab" href="#nav-gestion_compte" role="tab" aria-controls="nav-gestion_compte" aria-selected="false">Gestion des compte CM/PM</a>
          <a class="nav-item nav-link" id="nav-createJeux-tab" data-toggle="tab" href="#nav-createJeux" role="tab" aria-controls="nav-createJeux" data-page="creation_jeux.php" aria-selected="false">Création de Jeux</a>
          <a class="nav-item nav-link" id="nav-listejeux-tab" data-page="liste_jeux.php" data-toggle="tab" href="#nav-listejeux" role="tab" aria-controls="nav-listejeux" aria-selected="false">Vue globale des jeux vidéos</a>
        <?php } ?>

        <!-- Utilisateur -->
        <?php if ($_SESSION["typeUtilisateur"] == 2) { ?>
          <a class="nav-item nav-link" id="nav-jeuxFavoris-tab" data-toggle="tab" href="#nav-jeuxFavoris" role="tab" aria-controls="nav-jeuxFavoris" data-page="liste_jeux_favoris.php" aria-selected="false">Liste des jeux favoris</a>
        <?php } ?>

        <!-- Community Manager -->
        <?php if ($_SESSION["typeUtilisateur"] == 3) { ?>
          <a class="nav-item nav-link" id="nav-vue_actualites-tab" data-page="vue_actualites.php" data-toggle="tab" href="#nav-vue_actualites" role="tab" aria-controls="nav-vue_actualites" aria-selected="false">Gestion des actualités</a>
        <?php } ?>

        <!-- Producteur -->
        <?php if ($_SESSION["typeUtilisateur"] == 4) { ?>
          <a class="nav-item nav-link" id="nav-budget-tab" data-page="vue_budget.php" data-toggle="tab" href="#nav-budget" role="tab" aria-controls="nav-budget" aria-selected="false">Budget des jeux</a>
          <a class="nav-item nav-link" id="nav-createJeux-tab" data-toggle="tab" href="#nav-createJeux" role="tab" aria-controls="nav-createJeux" data-page="creation_jeux.php" aria-selected="false">Création de Jeux</a>
        <?php } ?>

      </div>
    </nav>

    <script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(event) {
    console.log("Onglet activé :", event.target);

    $('#espace-personnel-content').empty();

    const pageUrl = $(event.target).attr('data-page');
    console.log("Chargement ajax de la page :", pageUrl);
    $('#espace-personnel-content').load(pageUrl);
  });
</script>

    <div class="tab-content" id="espace-personnel-content">
    <?php
  // Vérifier si l'utilisateur est connecté
  if (isset($_SESSION['idUtilisateur'])) {
    // Inclure le contenu du profil si l'utilisateur est connecté
    include 'profil.php';
  } else {
    // Afficher le message de connexion si l'utilisateur n'est pas connecté
    echo '<p>Veuillez vous connecter pour accéder à votre profil.</p>';
  }
  ?>
    </div>
  </main>

  <?php include '../common/footer.html'; ?>
</body>

</html>