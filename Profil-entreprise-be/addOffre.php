<?php
require_once '../db.php';
require_once("../fieldsNames.php");
require('../Composant/header.php');
session_start();

$intitule = '';
$description = '';
$lieu = '';
$salaire = '';
$typeContrat = 'Stage'; // Default value

// Get entreprise ID from file
$idEntreprise = include('../Composant/getId-update-entreprise.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $intitule = htmlspecialchars(trim($_POST['intitule']));
    $salaire = htmlspecialchars(trim($_POST['renumeration']));
    $description = htmlspecialchars(trim($_POST['description']));
    $lieu = htmlspecialchars(trim($_POST['id_adresse']));

    $query = "INSERT INTO " . OFFRES . " (
        intitule, 
        " . FIELD_APROPOS_OFFRE . ", 
        " . LOCALISATION . ", 
        " . RENUMERATION . ", 
        " . ID_ENTREPRISE . "
    ) VALUES (
        '$intitule', 
        '$description', 
        '$lieu', 
        '$salaire', 
        '$idEntreprise'
    )";

    if (mysqli_query($conn, $query)) {
        header("Location: ../view/profil-entreprise.php?success=Offre ajouter au Liste d'offres") ;
        exit();
    } else {
        echo "<script>alert('Erreur lors de la publication de l\\'offre');</script>";
    }
}
?>
