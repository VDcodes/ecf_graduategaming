<title>Connexion</title>
<?php include '../common/header.php'; ?>

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
              <button class="btn btn-primary btn-lg btn-block" id="loginButton" type="submit">Connexion</button>
              <div class="d-flex justify-content-center mt-4">
                <a href="mdp_oublie.php">Mot de passe oublié ?</a>
              </div>
              <hr class="my-4">
              <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" id="createAccountButton">Créer son compte</button>
              <div id="succesMessage" class="alert alert-succes" role="alert"></div>
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
                      <form id="registrationForm" novalidate">
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
                        <button class="btn btn-primary btn-lg btn-block" type="button" onclick="creationCompte('compteUtilisateur')">S'inscrire</button>
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

  <?php include '../common/footer.html'; ?>


  </html>