<title>Gamesoft</title>

<?php include '../common/header.php'; ?>

<body>
  <div id="header-placeholder"></div>

  <main role="main" class="home">

    <section id="section-banner">
      <?php include 'banner.php'; ?>
    </section>

    <!--Container Modale pour la vue détaillée d'un jeu vidéo -->
    <div class="modal" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModalLabel" aria-hidden="true"></div>

    <hr width="90%">

    <section id="section-actu" class="py-3">
      <!-- Liste des actu remplis par l'ajax plus bas -->
      <div id="newsList" class="container">
        <?php include 'actualites.php' ?>
      </div>
    </section>

    <section id="section-jeux" class="my-5 py-3">
      <!-- Liste des jeux remplis par l'ajax plus bas -->
      <div class="container">
        <div id="gamesList"></div>
      </div>
    </section>

  </main>

  <div id="footer-placeholder"></div>

  <?php include '../common/footer.html'; ?>

</body>

</html>

<script>
  window.addEventListener('load', (event) => {
    GamesList();
  });

  function GamesList() {
    var formdata = new FormData();
    formdata.append('nbJeux', 3);

    $.ajax({
      url: "jeux.php",
      type: 'post',
      data: formdata,
      contentType: false,
      processData: false,
      dataType: 'text',
      success: function(resultat) {
        //console.log(resultat);
        document.getElementById('gamesList').innerHTML = resultat;
      },
      error: function(resultat, statut, erreur) {
        console.log(statut);
        console.log(erreur);
      }
    })
  }
</script>