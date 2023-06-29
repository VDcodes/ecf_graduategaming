<!DOCTYPE html>
<html>  

<head>
  <title>Connexion</title>
  <?php include 'header.php'; ?>  
  
  <script>
    $(document).ready(function() {
      $('#createAccountButton').click(function() {
        $('#registrationModal').modal('show');
      });

      $('#registrationModal form').submit(function(event) {
        event.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire

        // Vérifier si le formulaire est valide
        if (this.checkValidity()) {
          // Récupérer les valeurs des champs
          var nom = $('#formName').val();
          var email = $('#formEmail').val();
          var motDePasse = $('#formPassword').val();

          // Envoyer la requête AJAX
          $.ajax({
            type: 'POST',
            url: 'bdd/inscription.php',
            data: {
              nom: nom,
              email: email,
              motDePasse: motDePasse
            },
            success: function(response) {
              console.log(response);
              if (response === 'existing_user') {
                $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Ce nom d\'utilisateur est déjà pris.</div>');
                $('#errorModal').modal('show');
              } else if (response === 'success') {
                // $('#succesMessage').html('<div class="alert alert-success alert-dismissible" role="alert" id="succesMessage">OK</div>');
                // setTimeout(function() {
                //   location.reload(); // Rafraîchir la page après 2 secondes
                // }, 2000);
                location.reload();
              } else if (response === 'vide') {
                $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Merci de renseigner tous les champs.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              } else {
                $('#errorMessage').text('Une erreur s\'est produite lors de l\'inscription.');
                $('#errorModal').modal('show');
              }
            },
            error: function() {
              console.log('Une erreur s\'est produite lors de la requête.');
            }
          });
        }
      });

      $('#loginButton').click(function(e) {
        e.preventDefault();

        // Récupérer les valeurs des champs
        var username = $('#typeEmailX-2').val();
        var password = $('#typePasswordX-2').val();

        // Envoyer la requête AJAX vers connexion.php
        $.ajax({
          url: 'bdd/connexion.php',
          method: 'POST',
          data: {
            nom: username,
            motDePasse: password
          },
          success: function(response) {
            if (response === 'success') {
              // Rediriger vers la page de succès de connexion
              window.location.href = 'main.php';
            } else {
              // Afficher le message d'erreur dans la modale
              $('#errorMessage').text('Nom d\'utilisateur ou mot de passe incorrect');
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
</head>
<body>
  <section class="vh-100" style="background-color: #77AF9C;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <h3 class="mb-5">Se connecter</h3>
              <div class="form-outline mb-4">
                <label class="form-label" for="typeEmailX-2">Nom d'utilisateur</label>
                <input type="text" id="typeEmailX-2" class="form-control form-control-lg" name="username" />
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
              <button class="btn btn-primary btn-lg btn-block" id="loginButton" type="submit">Connexion</button>
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
                      <form id="registrationForm" novalidate>
                        <div class="form-outline mb-4">
                          <label class="form-label" for="formName">Nom</label>
                          <input type="text" id="formName" class="form-control form-control-lg" name="username" required />
                        </div>
                        <div class="form-outline mb-4">
                          <label class="form-label" for="formEmail">Email</label>
                          <input type="email" id="formEmail" class="form-control form-control-lg" name="email" required />
                        </div>
                        <div class="form-outline mb-4">
                          <label class="form-label" for="formPassword">Mot de passe</label>
                          <input type="password" id="formPassword" class="form-control form-control-lg" name="password" required />
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">S'inscrire</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fenêtre modale d'erreur -->
              <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="errorModalLabel">Erreur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div id="errorMessage" class="alert alert-danger" role="alert"> </div>
                      <div id="successMessage" class="alert alert-succes" role="alert"> </div>
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

  <?php include 'footer.html'; ?>


</html>
