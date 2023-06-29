<?php
require_once("jeux.php");
?>



  <title>Gamesoft</title>

  <?php include 'header.php'; ?>

<body>

<div id="header-placeholder"></div>



<main role="main">

  <section class="p-5 text-center custom-background mt-5">
    <div class="container">
      <p class="lead text-white text-container fz-24">
        Gamesoft est un studio de jeu vidéo français, développant des jeux vidéo. Ils proposent des jeux vidéo, principalement de type RPG. C'est également une société ayant pour valeur forte l'écologie, et qui privilégie la transparence auprès de ses joueurs pour satisfaire au mieux leurs attentes.
      </p>
    </div>
  </section>

  <section class="card-section">
    <div class="album py-5">
      <div class="container">
        <?php echo listeJeuxAccueil(); ?>
      </div>
    </div>
  </section>

</main>

<div id="footer-placeholder"></div>

<?php include 'footer.html'; ?>

</body>
</html>
