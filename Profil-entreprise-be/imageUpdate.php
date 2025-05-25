<?php 
require_once('../db.php');
require_once('../fieldsNames.php');

$imagePath = '';
$id = 1; // Replace with actual user ID via session or token in production

if (isset($_FILES[FIELD_IMAGE]) && $_FILES[FIELD_IMAGE]['error'] === 0) {
    $targetDir = 'image/';

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = basename($_FILES[FIELD_IMAGE]['name']);
    $imagePath = $targetDir . $filename;

    // Move uploaded file
    if (move_uploaded_file($_FILES[FIELD_IMAGE]['tmp_name'], $imagePath)) {
        // Sanitize file path for DB insertion
        $imagePathSafe = mysqli_real_escape_string($conn, $imagePath);

        $query = "UPDATE " . ENTREPRISE . " SET " . FIELD_IMAGE . " = '$imagePathSafe' WHERE " . ID_ENTREPRISE . " = $id";

        if (mysqli_query($conn, $query)) {
            header("Location: ../view/profil-entreprise.php");
            exit;
        } else {
            error_log("Erreur SQL : " . mysqli_error($conn));
            header("Location: ../view/profil-entreprise.php");
            exit;
        }
    } else {
        error_log("Erreur lors du déplacement du fichier.");
        header("Location: ../view/profil-entreprise.php");
        exit;
    }
} else {
    error_log("Aucun fichier envoyé ou erreur lors de l'envoi.");
    header("Location: ../view/profil-entreprise.php");
    exit;
}
?>