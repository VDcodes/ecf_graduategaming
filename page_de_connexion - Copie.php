
<title>Connexion</title>

<?php include 'header.php'; ?>

<script>
    $(document).ready(function() {
      $('#createAccountButton').click(function() {
        $('#registrationModal').modal('show');
      });
    });

    $(document).ready(function() {
      $('#registrationModal form').submit(function(event) {
        // console.log(document.getElementById('formAgree').checked);
        if(!document.getElementById('formAgree').checked){ //Si checkbox non check alors renvoi faux et stop le formualure
          alert('Merci d\'accepter les conditions d\'utilisations')
          return false;
        }else{
          event.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire

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
                //alert('Ce nom d\'utilisateur est déjà pris.');
                document.getElementById('errorMessage').innerHTML= '<div class=\'alert alert-danger alert-dismissible\' role=\'alert\' id=\'errorMessage\'>Ce nom d\'utilisateur est déjà pris.<button type=\'button\' class=\'close\' data-dismiss=\'alert\' aria-label=\'Close\'><span aria-hidden=\'true\'>&times;</span></button></div>';                        
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
        }
      });
    });
  </script>

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
  <form>
    <div class="form-outline mb-4">
      <label class="form-label" for="formName">Nom</label>
      <input type="text" id="formName" class="form-control form-control-lg" name="username" />
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="formEmail">Email</label>
      <input type="email" id="formEmail" class="form-control form-control-lg" name="email" />
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="formPassword">Mot de passe</label>
      <input type="password" id="formPassword" class="form-control form-control-lg" name="password" />
    </div>
    
                        <div class="form-check justify-content-center mb-5">
                          <input class="form-check-input me-2" type="checkbox" value="" id="formAgree" />
                          <label class="form-check-label" for="formAgree">
                            J'accepte les conditions d'utilisation
                          </label>
                        </div>
                        <!-- Ici remplis par ajax -->
                        <div id="errorMessage"></div>                      
                        <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">S'inscrire</button>
                        </div>
                      </form>
                      
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



 

  <!-- Fenêtre modale d'erreur
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
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div> -->

  <?php include 'footer.html'; ?>

</body>



