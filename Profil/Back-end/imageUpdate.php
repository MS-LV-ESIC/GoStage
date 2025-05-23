<?php 
require_once('../../db.php');

//set to nothing 
$imagePath = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = 'image/';

    // Ensure the folder exists if not this script will create one 
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Take only the last part of the url when the file is uploaded
    // transform:   C:/Users/User/Pictures/photo.jpg => image/image.png
    $filename = basename($_FILES['image']['name']);
    $imagePath = $targetDir . $filename;
    $id = 3; //I will need to take the id thta check the email via the connexion

    // Move the uploaded file from tmp_name to the $filePath
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {

        // Update user record
        $query = "UPDATE utilisateurs SET image = '$imagePath' WHERE id = $id";

        //Execute mysql_query that connect and then execute the query that i declared before
        if (mysqli_query($conn, $query)) {
            // ✅ Redirect back to profile
            header("Location: ../profil.php");
            exit;
        } else {
            header("Location: ../profil.php");
            echo "Erreur SQL : " . mysqli_error($conn);
        }

    } else {
        header("Location: ../profil.php");
        echo "<script>console.log('Aucun fichier envoyé ou erreur lors de l\'envoi.');</script>";
    }

} else {
    header("Location: ../profil.php");
    echo "<script>console.log('Aucun fichier envoyé ou erreur lors de l\'envoi.');</script>";

}
?>