<?php

session_start();
require_once('../../db.php');
require_once('../../fieldsNames.php');

$id_etudiant = $_SESSION['id_etudiant'] ?? 1;
$id_offre = $_POST['id_offre'] ?? null;
$redir = $_SERVER['HTTP_REFERER'];


if ($id_etudiant && $id_offre && is_numeric($id_offre)) {
    // Check if already in favoris
    $check = $conn->prepare("SELECT 1 FROM favoris WHERE id_etudiant = ? AND id_offre = ?");
    $check->bind_param("ii", $id_etudiant, $id_offre);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Remove
        $delete = $conn->prepare("DELETE FROM favoris WHERE id_etudiant = ? AND id_offre = ?");
        $delete->bind_param("ii", $id_etudiant, $id_offre);
        $delete->execute();
    } else {
        // Add
        $insert = $conn->prepare("INSERT INTO favoris (id_etudiant, id_offre) VALUES (?, ?)");
        $insert->bind_param("ii", $id_etudiant, $id_offre);
        $insert->execute();
    }

    header("Location: ". $redir);
    exit;
} else {
    echo "Erreur est survenue lors de la sauvegarde de l'offre.";
    echo "id: ",$id_etudiant;
    // header("Location: ../../view/offres.php");
}
?>