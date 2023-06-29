<?php session_start(); ?>
<!doctype html>
<html lang="fr">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://kit.fontawesome.com/64fdf29ef1.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

<header>
  <nav class="navbar navbar-light bg-dark text-white fixed-top col-12">      
      <a href="main.php" class="navbar-brand text-white col-3 mr-0">
        <img src="logo.png" class="d-inline-block align-top rounded-circle" alt="" width="60" height="60">
        <span class="fz-45"> Gamesoft </span>
      </a>
      <div class="text-center col-6">
        <a class="p-2 text-white a:hover fz-24" href="#">Jeux</a>
        <a class="p-2 text-white a:hover fz-24" href="#">Actualités</a>
        <a class="p-2 text-white a:hover fz-24" href="creation_jeux.php">Création</a>
        <a class="p-2 text-white a:hover fz-24" href="espace_personnel.php">Support</a>
      </div>
      <div class="text-right col-3">
        <a href="page_de_connexion.php" class="btn btn-primary btn-icon">
          <i class="fa-solid fa-circle-user"></i>
          <span class="ml-2">
          <?php if (isset($_SESSION['nomUtilisateur'])){
              echo $_SESSION['nomUtilisateur'];
            }else{
              echo "Connexion";
            }?>
          </span>
        </a>
      </div>      
  </nav>
</header>

