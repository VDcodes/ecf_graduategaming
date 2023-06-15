<?php
require_once("jeux.php");

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="">
  <meta name="description" content="">

  <title>Gamesoft</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://kit.fontawesome.com/64fdf29ef1.js" crossorigin="anonymous"></script>  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>  
</head>

<body>

<div id="header-placeholder"></div>
<script>
  fetch("header.html")
    .then(response => response.text())
    .then(data => {
      const headerPlaceholder = document.getElementById("header-placeholder");
      headerPlaceholder.innerHTML = data;
    });
</script>

  <main role="main ">

    <section class="p-5 text-center custom-background mt-5">
      <div class="container">
        <!-- <h1 class="display-1">Album example</h1> -->
        <p class="lead text-white text-container fz-24">
          Gamesoft est un studio de jeu vidéo français, développant des jeux vidéo. Ils proposent des jeux vidéo, principalement de type RPG. C'est également une société ayant pour valeur forte l'écologie, et qui privilégie la transparence auprès de ses joueurs pour satisfaires au mieux leurs attentes.
        </p>
        <p>
          <a href="#" class="btn btn-primary my-4">Catalogue de jeux</a>
        </p>
      </div>
    </section>
    <section class="card-section">
      <div class="album py-5 ">
        <div class="container">
          <?php echo listeJeuxAccueil(); ?>


              <!-- <p class="card-text">Le Jugement Céleste, prenez le contrôle d'un être Divin capricieux, et façonné le monde à votre façon, dans ce jeu de gestion, la seule limite est votre imagination !</p>
              <p class="card-text">Voici Clystidia, notre dernier RPG de médival fantasy, dans un vaste monde ouvert, où vous attendent aventure, intrigue, et lutte pour sa propre suvie.</p>
              <p class="card-text">Argenta revient avec son deuxième volet, la Cité des Félons, marchandage, intimidation, escroquerie, tout est bon pour survivre dans cet environnement hostile où personne ne viendra vous prendra en pitié.</p>
              <p class="card-text">Titanium, suite à de nombreuses demandes de la part des fans, nous avons l'honneur de vous annoncer aujourd'hui, notre premier RTS, prenant place dans l'univers de Clystidia.</p>
              <p class="card-text">Bienvenue sur l'accès anticipé de La Guerre des pôtres, ici un seul mot d'ordre, l'amusement ! Et n'oubliez pas de nous faire part de vos retours.</p> -->

    </section>
  </main>

  <footer class="text-muted p-3 bg-dark">
    <div class="text-white">
      <span>Copyright © Gamesoft Interactive Ltd. All rights reserved.</span>
      <span class="float-right">
        <a href="#">Haut de page</a>
      </span>
    </div>
  </footer>
</body>

</html>