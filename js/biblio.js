// Fonction pour afficher le détail d'un jeu via AJAX
function AfficheModalJeu(gameId) {
    console.log("AfficheModalJeu");

    var formdata = new FormData(); 
    formdata.append('id_jeux',gameId);      

    $.ajax({
            url: "../bdd/get_game_details.php",
            type: 'post',
            data: formdata,
            contentType: false,
            processData: false,
            dataType: 'text',
            success: function(resultat){
            document.getElementById('gameModal').innerHTML = resultat;
            $('#gameModal').modal('show');
            },
            error: function(resultat, statut, erreur){
                console.log(statut);
                console.log(erreur);
            }
    })
}

function creationCompte(p_PageAppel) {
    console.log('Fonction creationCompte() appelée. Page appelante:', p_PageAppel);
  
    // Récupérer les valeurs des champs
    var nom = $('#formName').val();
    var email = $('#formEmail').val();
    var motDePasse = $('#formPassword').val();
    var typeCompte = 2; // Par défaut
    if (p_PageAppel === "compteCMPM") {
      typeCompte = $('#formTypeCompte').val();
    }
  
    // Vérifier si les champs sont vides
    if (nom === "" || email === "" || motDePasse === "") {
      console.log('Champ(s) vide(s)');
      $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Merci de renseigner tous les champs.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      return; // Arrêter la fonction si un champ est vide
    }
  
    // Vérifier le format d'e-mail
    if (!isValidEmail(email)) {
      console.log('Format d\'e-mail invalide');
      $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Le format de l\'e-mail est invalide.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      return; // Arrêter la fonction si le format d'e-mail est invalide
    }
  
    // Envoyer la requête AJAX
    $.ajax({
      type: 'POST',
      url: '../bdd/inscription.php',
      data: {
        nom: nom,
        email: email,
        motDePasse: motDePasse,
        typeCompte: typeCompte
      },
      success: function(response) {
        console.log('Réponse AJAX reçue:', response);
        if (response === 'existing_user') {
          $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Ce nom d\'utilisateur est déjà pris.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          $('#errorModal').modal('show');
        } else if (response === 'success') {
          if (p_PageAppel !== "compteCMPM") {
            $('#registrationModal').modal('hide');
            $('#succesMessage').html('<div class="alert alert-success alert-dismissible" role="alert" id="succesMessage">Compte créé, merci de vous connecter<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          } else {
            location.reload();
          }
        } else {
          $('#errorMessage').text('Une erreur s\'est produite lors de l\'inscription.');
        }
      },
      error: function() {
        console.log('Une erreur s\'est produite lors de la requête.');
        $('#errorMessage').text('Une erreur s\'est produite lors de l\'inscription.');
      }
    });
  }
  
  // Fonction pour vérifier le format d'e-mail
  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  
  // Fonction pour vérifier le format d'e-mail
  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

function deconnexion(){
    if(confirm('Voulez-vous vous déconnecter ?')){
        var formdata = new FormData(); 
        $.ajax({
                url: "../bdd/deconnexion.php",
                type: 'post',
                data: formdata,
                contentType: false,
                processData: false,
                dataType: 'text',
                success: function(resultat){             
                    window.location.assign('../main/main.php');
                },
                error: function(resultat, statut, erreur){
                    console.log(statut);
                    console.log(erreur);
                }
        })
    }
}


function AjouterFavoris(idJeu) {  
    // Effectuer une requête AJAX pour ajouter le jeu aux favoris
    console.log(`Ajout du jeu ${idJeu} en favoris`);
    $.ajax({
    type: 'post',
    url: '../main/ajouter_favori.php',
    dataType: 'json', // Spécifie le type de données attendu pour la réponse JSON
    data: { id_jeux: idJeu },
        success: function(response) {
            if (response.success) {
                alert("Le jeu a été ajouté aux favoris et le score a été mis à jour.");
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log(status);
            console.log(error);
        }
    });
}

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
          url: '../bdd/inscription.php',
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
              $('#registrationModal').modal('hide');
              $('#succesMessage').html('<div class="alert alert-success alert-dismissible" role="alert" id="succesMessage">Compte crée, merci de vous connecter<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else if (response === 'vide') {
              $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Merci de renseigner tous les champs.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
        url: '../bdd/connexion.php',
        method: 'POST',
        data: {
          nom: username,
          motDePasse: password
        },
        success: function(response) {
          if (response === 'success') {
            // Rediriger vers la page de succès de connexion
            window.location.href = '../main/main.php';
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
  