<?php
session_start();
require_once("../../db.php");

// Sécurité : vérifier si les données sont présentes
if (!isset($_SESSION['id_entreprise']) || !isset($_POST['id'])) {
    echo "Erreur : ID entreprise ou ID offre manquant.";
    var_dump($_SESSION);
    var_dump($_POST);
    exit;
}

$id_entreprise = intval($_SESSION['id_entreprise']);
$id_offre = intval($_POST['id']);

// Vérifie que l’offre appartient bien à l’entreprise connectée
$query = "SELECT * FROM offres WHERE id_offre = $id_offre AND id_entreprise = $id_entreprise";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    die("Offre introuvable ou non autorisée.");
}

// Suppression de l'offre
$delete = "DELETE FROM offres WHERE id_offre = $id_offre";
if (mysqli_query($conn, $delete)) {
    header("Location: ../../view/offres.php?success=suppression");
    exit;
} else {
    echo "Erreur lors de la suppression : " . mysqli_error($conn);
}
?>