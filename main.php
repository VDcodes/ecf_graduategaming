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

<?php include 'header.html'; ?>

  <main role="main ">

    <section class="p-5 text-center custom-backgound mt-5">
      <div class="container">
        <p class="lead text-white text-container fz-24">
          Gamesoft est un studio de jeu vidéo français, développant des jeux vidéo. Ils proposent des jeux vidéo, principalement de type RPG. C'est également une société ayant pour valeur forte l'écologie, et qui privilégie la transparence auprès de ses joueurs pour satisfaires au mieux leurs attentes.
        </p>
      </div>
    </section>
    <section class="card-section">
      <div class="album py-5 ">
        <div class="container">
          <?php echo listeJeuxAccueil(); ?>
    </section>
  </main>

<div id="footer-placeholder"></div>

<?php include 'footer.html'; ?>
</body>

</html>