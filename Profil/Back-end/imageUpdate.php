<?php 
require_once('../../db.php');

$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = './Back-end/image/';

    // Ensure the folder exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = basename($_FILES['image']['name']);
    $imagePath = $targetDir . $filename;
    $id = 3; 

    // Move the uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {

        // Update user record
        $query = "UPDATE utilisateurs SET image = '$imagePath' WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            // ✅ Redirect back to profile
            header("Location: ../profil.php");
            exit;
        } else {
            echo "Erreur SQL : " . mysqli_error($conn);
        }

    } else {
        echo "Erreur lors du déplacement du fichier.";
    }

} else {
    echo "Aucun fichier envoyé ou erreur lors de l'envoi.";
}
?>