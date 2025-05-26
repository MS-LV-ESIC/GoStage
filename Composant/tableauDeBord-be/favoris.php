<?php

session_start();
require_once('../../db.php');
require_once('../../fieldsNames.php');

$id_etudiant = $_SESSION['id_etudiant'] ?? 1;
$id_offre = $_POST['id_offre'] ?? null;

echo "ID etudiant: " . $id_etudiant . "<br>";
echo "ID offre: " . $id_offre . "<br>";

if ($id_etudiant && $id_offre) {
    $query = "INSERT IGNORE INTO favoris (id_etudiant, id_offre) VALUES (?, ?)";

    // Sécurisation contre les injections SQL 
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_etudiant, $id_offre);
    $stmt->execute();

    header("Location: ../../view/offres.php");
} else {
    echo "Erreur est survenue lors de la sauvegarde de l'offre.";
    // header("Location: ../../view/offres.php");
}
?>