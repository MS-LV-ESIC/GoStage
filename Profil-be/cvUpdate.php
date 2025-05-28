<?php
session_start();
require_once("../db.php");
require_once("../fieldsNames.php");

// Use session for student id:
$id = $_SESSION['id_etudiant'] ?? null;
if (!$id) {
    die("Erreur: ID étudiant manquant.");
}

if (isset($_FILES[FIELD_CV]) && $_FILES[FIELD_CV]['error'] === 0) {
    $targetDir = __DIR__ . '/cv/'; // Absolute path

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = basename($_FILES[FIELD_CV]['name']);
    $cvPath = 'cv/' . $filename;

    if (move_uploaded_file($_FILES[FIELD_CV]['tmp_name'], $targetDir . $filename)) {
        $cvPathSafe = mysqli_real_escape_string($conn, $cvPath);

        $query = "UPDATE " . ETUDIANT . " SET " . FIELD_CV . " = '$cvPathSafe' WHERE " . ID . " = $id";

        if (mysqli_query($conn, $query)) {
            header("Location: ../view/profil.php");
            exit;
        } else {
            die("Erreur SQL : " . mysqli_error($conn));
        }
    } else {
        die("Erreur lors du déplacement du fichier CV.");
    }
} else {
    die("Aucun fichier CV envoyé ou erreur lors de l'envoi.");
}