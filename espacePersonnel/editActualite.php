<?php
include '../bdd/connexionBDD.php';

$id_actu = 0;
if (isset($_GET['ID_ACTU'])) {
    $id_actu = $_GET['ID_ACTU'];
}

$form = "../bdd/ajoutActualite.php";
$titre = "Ajouter";

$titre_actu = "";
$descriptif = "";
$date_creation = date('Y-m-d');

if ($id_actu != 0) {
    // En modification
    $form = "modifActualite.php";
    $titre = "Modifier";
    // Requête SQL pour récupérer les informations de l'actualité
    $sql = "SELECT * FROM actualites WHERE id_actualites =" . $id_actu;

    // Exécute la requête SQL
    $result = $conn->query($sql);

    // Vérifie si des données ont été trouvées
    if ($result->num_rows > 0) {
        // Récupère les informations de l'actualité
        $row = $result->fetch_assoc();
        $titre_actu = $row['titre'];
        $descriptif = $row['descriptif'];
        $date_creation = $row['date_creation'];
    } else {
        // Gérer le cas où l'ID_ACTU n'existe pas dans la base de données (éventuellement rediriger l'utilisateur)
    }
}
?>

<form action="<?php echo $form ?>" id="FormulairePost" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="ModalPost"><?php echo $titre ?> une actualité</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control form-control-sm" name="id_actu" value="<?php echo $id_actu ?>">
                <div class="mb-3">
                    <i class="fas fa-question mb-2"></i> Titre :
                    <input type="text" class="form-control form-control-sm" name="titre" value="<?php echo $titre_actu ?>">
                </div>
                <div class="mb-3">
                    <i class="fas fa-paragraph"></i> Texte :
                    <div>
                        <textarea id="textArea_edit" name="texte"><?php echo $descriptif ?></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <i class="far fa-calendar-alt mb-2"></i> Date création:
                    <input class="form-control form-control-sm" type="date" value="<?php echo $date_creation ?>" id="date_creation" name="date_creation" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="validation" class="btn btn-info"><?php echo $titre ?></button>
            </div>
        </div>
    </div>
</form>
