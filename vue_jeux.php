<?php include 'header.php'; ?>
<?php include 'jeux.php'; ?>
<body>
  <div class="container mt-5 pt-5">
    <div class="row equal-height-cards">
      <div class="filters">
        <label for="status">Statut :</label>
        <select id="status" name="status">
          <option value="">Tous</option>
          <option value="En développement">En développement</option>
          <option value="Terminé">Terminé</option>
        </select>

        <label for="date_fin_creation">Date de fin de création :</label>
        <input type="date" id="date_fin_creation" name="date_fin_creation">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom">

        <label for="type">Type :</label>
        <input type="text" id="type" name="type">

        <button id="filterBtn">Filtrer</button>
      </div>

      <div id="gamesList">
        <?php echo listeJeuxAccueil(); ?>
      </div>
    </div>
  </div>

  <!-- Modale pour la vue détaillée d'un jeu vidéo -->
  <div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="gameModalLabel">Détails du jeu vidéo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="gameModalBody">
          <!-- Les informations du jeu vidéo seront ajoutées ici -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Fonction pour mettre à jour la liste des jeux via AJAX
    function updateGamesList() {
      var status = document.getElementById('status').value;
      var endDate = document.getElementById('date_fin_creation').value;
      var name = document.getElementById('nom').value;
      var type = document.getElementById('type').value;

      // Effectuer la requête AJAX
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Mettre à jour la liste des jeux avec la réponse AJAX
          document.getElementById('gamesList').innerHTML = this.responseText;

          // Réattacher l'événement de clic sur les boutons "Voir détails"
          attachGameModalEvents();
        }
      };
      xhttp.open("GET", "jeux.php?status=" + status + "&date_fin_creation=" + endDate + "&nom=" + name + "&type=" + type, true);
      xhttp.send();
    }

    // Écouter l'événement de clic sur le bouton de filtrage
    document.getElementById('filterBtn').addEventListener('click', function() {
      updateGamesList();
    });

    // Écouter les événements de saisie sur les champs de filtrage
    document.getElementById('status').addEventListener('change', function() {
      updateGamesList();
    });
    document.getElementById('date_fin_creation').addEventListener('input', function() {
      updateGamesList();
    });
    document.getElementById('nom').addEventListener('input', function() {
      updateGamesList();
    });
    document.getElementById('type').addEventListener('input', function() {
      updateGamesList();
    });

    // Fonction pour attacher les événements de clic sur les boutons "Voir détails"
    function attachGameModalEvents() {
      var gameButtons = document.querySelectorAll('.card-body button.view-button');
      gameButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          var gameId = button.getAttribute('data-id');

          // Effectuer une requête AJAX pour récupérer les informations détaillées du jeu vidéo
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var gameData = JSON.parse(this.responseText);
              updateGameModal(gameData);
            }
          };
          xhttp.open("GET", "get_game_details.php?id=" + gameId, true);
          xhttp.send();
        });
      });
    }

    // Fonction pour mettre à jour la modale avec les informations du jeu vidéo
    function updateGameModal(gameData) {
      var modalBody = document.getElementById('gameModalBody');
      modalBody.innerHTML = `
        <h4>${gameData.titre}</h4>
        <p>${gameData.descriptif}</p>
        <p>Score : ${gameData.score}</p>
        <!-- Ajouter d'autres informations du jeu vidéo si nécessaire -->
      `;
    }

    // Attacher les événements de clic sur les boutons "Voir détails"
    attachGameModalEvents();
  </script>
</body>
<?php include 'footer.html'; ?>
</html>
