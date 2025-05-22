<?php
require_once('../../db.php');
// require_once('profil.php');
$id='3';


//On verifie si la REQUEST a est bien le POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fields = [];

    if(isset($_POST['nom']) && $_POST['nom'] !==''){
        $nom = mysqli_real_escape_string($conn, trim($_POST['nom']));
        $fields[] = "`nom` = '$nom'";
    }
    if(isset($_POST['prenom']) && $_POST['prenom'] !==''){
        $prenom = mysqli_real_escape_string($conn, trim($_POST['prenom']));
        $fields[] = "`prenom` = '$prenom'";
    }
    if(isset($_POST['cursus']) && $_POST['cursus'] !==''){
        $cursus = mysqli_real_escape_string($conn, trim($_POST['cursus']));
        $fields[] = "`cursus` = '$cursus'";
    }

    if(!empty($fields)){
        $query = "UPDATE `utilisateurs` SET " . implode(', ', $fields) . " WHERE `id` = $id";
        $result = mysqli_query($conn, $query);

        if($result){
            header("Location: ../profil.php?success=Modification resussie");
            exit();
        }
    } 
}else{
    header("ERREUR, MAUVAISE REQUEST");
}
?>