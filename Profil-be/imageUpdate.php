<?php 
require_once('../db.php');
require_once('../fieldsNames.php');


require_once('../Composant/getId-update-etudiant.php');


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

        $query = "UPDATE " . ETUDIANT . " SET " . FIELD_IMAGE . " = '$imagePathSafe' WHERE " . ID . " = $id";

        if (mysqli_query($conn, $query)) {
            header("Location: ../view/profil.php");
            exit;
        } else {
            header("Location: ../view/profil.php");
            echo "<script>console.log('Upload failed: Aucun fichier envoyé ou erreur lors de l\'envoi.');</script>";
            exit;
        }
    } else {
        echo "<script>console.log('Upload failed: Aucun fichier envoyé ou erreur lors de l\'envoi.');</script>";
        header("Location: ../view/profil.php");
        exit;
    }
} else {
    echo "<script>console.log('Upload failed: Aucun fichier envoyé ou erreur lors de l\'envoi.');</script>";
    header("Location: ../view/profil.php");
    exit;
}
?>