<?php
require_once '../db.php';
require_once("../fieldsNames.php");
require('../Composant/header.php');
session_start();

$intitule = '';
$description = '';
$lieu = '';
$salaire = '';
$entrepriseId = '';
$typeContrat = 'Stage'; // Default value for typeContrat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $intitule = htmlspecialchars(trim($_POST['intitule']));
      $salaire = htmlspecialchars(trim($_POST['renumeration']));
    $description = htmlspecialchars(trim($_POST['description']));
    $lieu = htmlspecialchars(trim($_POST['id_adresse']));
  
    // Ensure typeContrat is set, defaulting to 'Stage' if not provided
    $typeContrat = htmlspecialchars(trim($_POST['typeContrat']));

    // Assuming you have a session variable for the entreprise ID
    $entrepriseId = $_SESSION['id_entreprise']; // Replace with actual session variable

    $query = "INSERT INTO " . OFFRES . " (" . FIELD_INTITULE . ", " . FIELD_APROPOS_OFFRE . ", " . FIELD_LIEU . ", " . FIELD_RENUMERATION . ", " . ID_ENTREPRISE . ") VALUES ('$intitule', '$description', '$lieu', '$salaire', '$entrepriseId')";
    

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Offre postée avec succès');</script>";
        header("Location: profil-entreprise.php");
        exit();
    } else {
        echo "<script>alert('Erreur lors de la publication de l\'offre');</script>";
    }
}

?>