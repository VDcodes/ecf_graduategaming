<?php include 'header.php'; ?>
<body style="background-color: #f0f0f0;">
  <div class="container mt-5 pt-5">
    <img src="utilisateur.png" alt="Profile Image" class="profile-image">

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-Profil-tab" data-toggle="tab" href="#nav-Profil" role="tab" aria-controls="nav-Profil" aria-selected="true">Profil</a>
       
        <?php if ($_SESSION["typeUtilisateur"] == 1) { ?>
          <a class="nav-item nav-link" id="nav-createCompteCM-tab" data-toggle="tab" href="#nav-createCompteCM" role="tab" aria-controls="nav-createCompteCM" aria-selected="false">Création de compte CM/PM</a>
          <a class="nav-item nav-link" id="nav-createJeux-tab" data-toggle="tab" href="creation_jeux.php" role="tab" aria-controls="nav-createJeux" aria-selected="false">Création de Jeux</a>
          <a class="nav-item nav-link" id="nav-modifJeux-tab" data-toggle="tab" href="#nav-modifJeux" role="tab" aria-controls="nav-modifJeux" aria-selected="false">Modification de Jeux</a>
        <?php } ?> 
        
        <?php if ($_SESSION["typeUtilisateur"] == 2) { ?>
          <a class="nav-item nav-link" id="nav-jeuxFavoris-tab" data-toggle="tab" href="#nav-jeuxFavoris" role="tab" aria-controls="nav-jeuxFavoris" aria-selected="false">Liste des jeux favoris</a>
        <?php } ?>

        <?php if ($_SESSION["typeUtilisateur"] == 3) { ?>
          <a class="nav-item nav-link" id="nav-filActualite-tab" data-toggle="tab" href="#nav-filActualite" role="tab" aria-controls="nav-filActualite" aria-selected="false">Fil d'actualité</a>
        <?php } ?>

        <?php if ($_SESSION["typeUtilisateur"] == 4) { ?>
          <a class="nav-item nav-link" id="nav-budget-tab" data-toggle="tab" href="#nav-budget" role="tab" aria-controls="nav-budget" aria-selected="false">Budget des jeux</a>
          <a class="nav-item nav-link" id="nav-vueGlobale-tab" data-toggle="tab" href="#nav-vueGlobale" role="tab" aria-controls="nav-vueGlobale" aria-selected="false">Vue globale des jeux vidéos</a>
          <a class="nav-item nav-link" id="nav-createJeux-tab" data-toggle="tab" href="creation_jeux.php" role="tab" aria-controls="nav-createJeux" aria-selected="false">Création de Jeux</a>
          <?php } ?>

     </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-Profil" role="tabpanel" aria-labelledby="nav-Profil-tab">Contenu du Profil</div>
      <div class="tab-pane fade" id="nav-jeuxFavoris" role="tabpanel" aria-labelledby="nav-jeuxFavoris-tab">Contenu de la Liste des jeux favoris</div>
      <div class="tab-pane fade" id="nav-createCompteCM" role="tabpanel" aria-labelledby="nav-createCompteCM-tab">Contenu de la Création de compte CM/PM</div>
      <div class="tab-pane fade" id="nav-createJeux" role="tabpanel" aria-labelledby="nav-createJeux-tab">Contenu de la Création de jeux</div>
      <div class="tab-pane fade" id="nav-modifJeux" role="tabpanel" aria-labelledby="nav-modifJeux-tab">Contenu de la Modification de jeux</div>
    </div>
  </div>
  
  <?php include 'footer.html'; ?>
</body>
</html>



