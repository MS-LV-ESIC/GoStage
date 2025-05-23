<?php
require_once("../../db.php");


$cvPath = '';

if(isset($_FILES['cv']) && $_FILES['cv']['error']==0){
    $targetdir= 'cv/';

    if(!is_dir($targetdir)){
        mkdir($targetdir,0755,true);
    }

    $filename = basename($_FILES['cv']['name']);
    $cvPath = $targetdir . $filename;

    $id = 3;

    if(move_uploaded_file($_FILES['cv']['tmp_name'], $cvPath)){
        $query = "UPDATE utilisateurs SET cv = '$cvPath' WHERE id = $id";

        if(mysqli_query($conn, $query)){
            header("Location: ../profil.php");
            exit;
        }else{
            header("Location: ../profil.php");
            echo "Erreur AQL : " . mysqli_error($conn);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";
        }
    }else{
        header("Location: ../profil.php");
        echo "<script>console.log('Erreur lors du déplacement du fichier.');</script>";
    }
}else{
    header("Location: ../profil.php");
    echo "<script>console.log('Erreur lors du déplacement du fichier.');</script>";
}
?>