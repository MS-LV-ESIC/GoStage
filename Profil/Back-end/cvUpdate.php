<?php
require_once("../../db.php");
require_once("../../fieldsNames.php");

$cvPath = '';
$id = 3; // Replace with session-based or dynamic ID in production

if (isset($_FILES[FIELD_CV]) && $_FILES[FIELD_CV]['error'] === 0) {
    $targetDir = 'cv/';

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = basename($_FILES[FIELD_CV]['name']);
    $cvPath = $targetDir . $filename;

    if (move_uploaded_file($_FILES[FIELD_CV]['tmp_name'], $cvPath)) {
        $cvPathSafe = mysqli_real_escape_string($conn, $cvPath);

        $query = "UPDATE " . ETUDIANT . " SET " . FIELD_CV . " = '$cvPathSafe' WHERE " . ID . " = $id";

        if (mysqli_query($conn, $query)) {
            header("Location: ../profil.php");
            exit;
        } else {
            error_log("Erreur SQL : " . mysqli_error($conn));
            header("Location: ../profil.php");
            exit;
        }
    } else {
        error_log("Erreur lors du déplacement du fichier CV.");
        header("Location: ../profil.php");
        exit;
    }
} else {
    error_log("Aucun fichier CV envoyé ou erreur lors de l'envoi.");
    header("Location: ../profil.php");
    exit;
}
?>