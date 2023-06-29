<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://kit.fontawesome.com/64fdf29ef1.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#createAccountButton').click(function() {
        $('#registrationModal').modal('show');
      });
    });
  </script>
</head>

</head>

<body>
  <section class="vh-100" style="background-color:  #77AF9C;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <h3 class="mb-5">Se connecter</h3>
              <div class="form-outline mb-4">
                <label class="form-label" for="typeEmailX-2">Nom d'utilisateur</label>
                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="username" />
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="typePasswordX-2">Mot de passe</label>
                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
              </div>
              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input" type="checkbox" value="" id="check1" />
                <label class="form-check-label" for="check1"> Se souvenir du mot de passe </label>
              </div>
              <button class="btn btn-primary btn-lg btn-block" type="submit">Connexion</button>
              <hr class="my-4">
              <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" id="createAccountButton">Créer son compte</button>
              <!-- Fenêtre modale d'inscription -->
              <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="registrationModalLabel">Créer un compte</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <form action="bdd/connexion.php" method="post" onsubmit="return submitForm(event)">
                        <div class="form-outline mb-4">
                          <label class="form-label" for="formName">Nom</label>
                          <input type="text" id="formName" class="form-control form-control-lg" name="nom" />
                        </div>
                        <div class="form-outline mb-4">
                          <label class="form-label" for="formEmail">Email</label>
                          <input type="email" id="formEmail" class="form-control form-control-lg" name="email" />
                        </div>
                        <div class="form-outline mb-4">
                          <label class="form-label" for="formPassword">Mot de passe</label>
                          <input type="password" id="formPassword" class="form-control form-control-lg" name="motDePasse" />
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input class="form-check-input me-2" type="checkbox" value="" id="formAgree" />
                          <label class="form-check-label" for="formAgree">
                            J'accepte les conditions d'utilisation
                          </label>
                        </div>
                        <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">S'inscrire</button>
                        </div>
                     </form>
<!-- Fenêtre modale d'erreur -->
<div id="errorModal" class="modal" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Erreur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="errorMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'header.html'; ?>
  <?php include 'footer.html'; ?>

<script>
  $(document).ready(function() {
    $('#registrationModal form').submit(function(event) {
      event.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire

      // Récupérer les valeurs des champs
      var nom = $('#formName').val();
      var email = $('#formEmail').val();
      var motDePasse = $('#formPassword').val();

      // Envoyer la requête AJAX
      $.ajax({
        type: 'POST',
        url: 'bdd/connexion.php',
        data: {
          nom: nom,
          email: email,
          motDePasse: motDePasse
        },
        success: function(response) {
          if (response === 'existing_user') {
            $('#errorMessage').text('Ce nom d\'utilisateur est déjà pris.');
            $('#errorModal').modal('show');
          } else if (response === 'success') {
            $('#successModal').modal('show');
          } else {
            $('#errorMessage').text('Une erreur s\'est produite lors de l\'inscription.');
            $('#errorModal').modal('show');
          }
        },
        error: function() {
          console.log('Une erreur s\'est produite lors de la requête.');
        }
      });
    });
  });
</script>
</body>
</html>


