<?php
include '../common/header.php';
require("../bdd/connexionBDD.php");
?>

<body style="background-color: #77AF9C;" >
  <div class="container mt-5 pt-5">

    <!--Container Modale pour la vue détaillée d'un jeu vidéo -->
    <div class="modal" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModalLabel" aria-hidden="true"></div>

    <div class="row equal-height-cards">
      <div class="filters">
        <label for="status">Statut :</label>
        <select id="status" name="status">
          <option value="">Tous</option>
          <?php
          $sql = "SELECT statut FROM jeux GROUP BY statut";
          $result = $conn->query($sql);
          // Vérifier si des données ont été trouvées
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              print("<option value=\"" . $row["statut"] . "\">" . $row["statut"] . "</option>");
            }
          }
          ?>
        </select>

        <label for="date_fin_creation">Date de fin de création :</label>
        <input type="date" id="date_fin_creation" name="date_fin_creation">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom">

        <label for="type">Genre :</label>
        <select id="type" name="type">
          <option value="">Tous</option>
          <?php
          $sql = "SELECT type_jeux FROM jeux GROUP BY type_jeux";
          $result = $conn->query($sql);
          // Vérifier si des données ont été trouvées
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              print("<option value=\"" . $row["type_jeux"] . "\">" . $row["type_jeux"] . "</option>");
            }
          }
          ?>
        </select>

        <button id="filterBtn" onclick="RazFiltre()">Retirer filtre</button>
      </div>

      <div id="gamesList">
      </div>
    </div>
  </div>


  <script>
    window.addEventListener('load', (event) => {
      GamesList();
    });

    // Écouter les événements de saisie sur les champs de filtrage
    document.getElementById('status').addEventListener('change', function() {
      GamesList();
    });

    document.getElementById('date_fin_creation').addEventListener('input', function() {
      GamesList();
    });

    document.getElementById('nom').addEventListener('keyup', function() {
      //console.log(document.getElementById('nom').value.length)
      if (document.getElementById('nom').value.length >= 3) {
        GamesList();
      } else if (document.getElementById('nom').value.length < 3) {
        GamesList(true);
      }
    });

    document.getElementById('type').addEventListener('change', function() {
      GamesList();
    });

    function RazFiltre() {
      document.getElementById('date_fin_creation').value = "";
      document.getElementById('nom').value = "";
      document.getElementById('type').selectedIndex = 0;
      document.getElementById('status').selectedIndex = 0;
      GamesList();
    }

    // Fonction pour mettre à jour la liste des jeux via AJAX
    function GamesList(bInitial) {
      console.log("GameList appel");
      var status = document.getElementById('status').value
      var endDate = document.getElementById('date_fin_creation').value;
      var name = document.getElementById('nom').value;
      //Récuperation de la combo Genre (Type de jeux)
      var selectType = document.getElementById("type");
      var type = selectType.value;

      if (bInitial) {
        name = "";
      }

      var formdata = new FormData();
      formdata.append('status', status);
      formdata.append('date_fin_creation', endDate);
      formdata.append('nom', name);
      formdata.append('type', type);

      $.ajax({
        url: "jeux.php",
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'text',
        success: function(resultat) {
          document.getElementById('gamesList').innerHTML = resultat;
        },
        error: function(resultat, statut, erreur) {
          console.log(statut);
          console.log(erreur);
        }
      })
    }
  </script>
</body>
<?php include '../common/footer.html'; ?>