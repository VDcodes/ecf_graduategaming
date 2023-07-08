<?php include 'header.php'; ?>
<?php include 'bdd/connexionBDD.php'; ?>

<body>
  <div class="container mt-5">
    <h2>Vue globale du budget des jeux vidéo</h2>

    <div class="filters">
      <label for="status">Statut :</label>
      <select id="status" name="status">
        <option value="">Tous</option>
        <option value="En développement">En développement</option>
        <option value="Terminé">Terminé</option>
      </select>

      <!-- Ajoute d'autres filtres si nécessaire -->

      <button id="filterBtn">Filtrer</button>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Dernier budget</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Requête SQL pour récupérer les informations du budget de chaque jeu vidéo
        $query = "SELECT titre, budget FROM jeux";
        
        // Ajoute des conditions de filtrage si des filtres sont appliqués
        if (isset($_GET['status'])) {
          $status = $_GET['status'];
          if (!empty($status)) {
            $query .= " WHERE statut = '$status'";
          }
        }
        
        // Exécute la requête SQL
        $result = $conn->query($query);
        
        // Variables pour calculer le coût total des jeux vidéo
        $totalCost = 0;
        
        // Affiche les résultats
        while ($row = $result->fetch_assoc()) {
          $titre = $row['titre'];
          $budget = $row['budget'];
          
          echo "<tr>";
          echo "<td>$titre</td>";
          echo "<td>$budget</td>";
          echo "</tr>";
          
          // Ajoute le budget au coût total
          $totalCost += $budget;
        }
        ?>
      </tbody>
    </table>

    <h4>Coût total des jeux vidéo : <?php echo $totalCost; ?></h4>
  </div>

  <script>
    // Fonction pour mettre à jour la vue globale du budget via AJAX
    function updateBudgetView() {
      var status = document.getElementById('status').value;
      
      // Effectue la requête AJAX pour mettre à jour la vue globale du budget
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementsByTagName('tbody')[0].innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "vue_budget.php?status=" + status, true);
      xhttp.send();
    }
    
    // Écoute l'événement de clic sur le bouton de filtrage
    document.getElementById('filterBtn').addEventListener('click', function() {
      updateBudgetView();
    });
  </script>
</body>

<?php include 'footer.html'; ?>
</html>