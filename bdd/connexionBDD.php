<?php
// Paramètres de connexion à la base de données local
$servername = "localhost";
$username = "root";
$password = "root";
$database = "ecf_g";

//Prod
// $servername = "localhost";
// $username = "kcxqbyac_root";
// $password = "Wishmasterdu31$";
// $database = "kcxqbyac_ecf_g";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8");
// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

?>