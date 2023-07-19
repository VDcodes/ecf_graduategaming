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

//  Fonction qui gére le forumulaire d'inscription
function creationCompte(p_PageAppel){

    event.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire

    // Récupérer les valeurs des champs
    var nom = $('#formName').val();
    var email = $('#formEmail').val();
    var motDePasse = $('#formPassword').val();
    var typeCompte = 2; //Par défaut
    if(p_PageAppel == "compteCMPM"){
        typeCompte = $('#formTypeCompte').val();
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
        console.log(response);
        if (response === 'existing_user') {
            $('#errorMessage').html('<div class="alert alert-danger alert-dismissible" role="alert" id="errorMessage">Ce nom d\'utilisateur est déjà pris.</div>');
            if(p_PageAppel != "compteCMPM") $('#errorModal').modal('show');
            } else if (response === 'success') {
            if(p_PageAppel != "compteCMPM"){
                $('#registrationModal').modal('hide');
                $('#succesMessage').html('<div class="alert alert-success alert-dismissible" role="alert" id="succesMessage">Compte crée, merci de vous connecter<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }else{
                location.reload();  
            }            
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
    data: { id_jeux: idJeu }, 
    success: function(response) {
        if (response.success) {
            alert("Le jeu a été ajouté aux favoris et le score a été mis à jour.");
        } else {
            alert("Le jeu est déjà en favori pour cet utilisateur.");
        }
    },
    error: function(xhr, status, error) {
        console.log(status);
        console.log(error);
    }
    });
}
  
  