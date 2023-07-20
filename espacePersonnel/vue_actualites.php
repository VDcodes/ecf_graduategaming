<?php include '../bdd/connexionBDD.php'; ?>

<body>
  <div class="container mt-5">
    <h2>Gestion des actualités</h2>

    <button type="button" class="btn btn-primary" id="hrefPost" href="#" data-url="editActualite.php" onclick="editActu(0)">Ajouter une actualité</button>

    <table class="table table-striped mt-2">
      <thead class="thead-dark">
        <tr>
          <th>Titre</th>
          <th>Descriptif</th>
          <th>Date Création</th>
          <th>Modifier</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Requête SQL pour récupérer les informations du budget de chaque jeu vidéo
        $sql = "SELECT id_actualites,titre, date_creation, descriptif FROM actualites";

        // Exécute la requête SQL
        $result = $conn->query($sql);

        // Affiche les résultats
        while ($row = $result->fetch_assoc()) {
          $titre = $row['titre'];          
          $descriptif = $row['descriptif'];
          $date_creation = $row['date_creation'];
          $id_actualites = $row['id_actualites'];

          echo "<tr>";
          echo "  <td>$titre</td>";
          echo "  <td>".reduireChaineMot($descriptif,40)."</td>";
          echo "  <td>$date_creation</td>";
          echo "  <td class=\"text-center\"><a id=\"hrefPost\" href=\"#\" data-url=\"espacePersonnel/editActualite.php\" onclick=\"editActu('".$id_actualites."');\"><i class=\"fas fa-pencil-alt text-dark\"></i></a></td>";    
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->

  <div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="ModalPostLabel" aria-hidden="true">
  <div id="modalPost_Contenu">
    <!-- rempli en ajax -->
    </div> 
  </div>

  <?php
      function reduireChaineMot($chaine, $nb_mots, $delim='...') {
        $txt = "";
        $stringTab=explode(" ", $chaine) ;
        if (count($stringTab) > $nb_mots){
          for($i=0;$i<$nb_mots;$i++){
            $txt.=" ".$stringTab[$i] ;
          }
          $txt.= $delim ;
        }else{
          $txt = $chaine;
        }

        $txt = str_replace("<img","<img class=\"img-fluid\" ",$txt);    

        return $txt ;
      }
  ?>

  <script>

function SubmitForm() {
  if (document.forms["FormulairePost"]["titre"].value == "") {
    alert("Merci de saisir un titre");
  } else if (document.forms["FormulairePost"]["texte"].value == ""){
    alert("Merci de saisir un texte");
  }else {
    document.getElementById("FormulairePost").submit();
  }
}

// function supprActu(ID){
//   if (confirm("Voulez-vous supprimer cette actu ?")) {
//     //alert('SupprimeDepense.php?ID='+ID)
//     window.location='supprActu.php?ID='+ID
//   } else{
//     event.stopPropagation();
//     event.preventDefault();
//   };
// }

function editActu(id_actu){
    var url = $("#hrefPost").data("url"); 
    $.ajax({
        url: url,
        type : 'GET', 
        data : 'ID_ACTU=' + id_actu,
        success: function(res) {
            var data = res;
            document.getElementById('modalPost_Contenu').innerHTML = data;
            $('#modalPost').modal('show');
        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
}
  </script>
</body>


