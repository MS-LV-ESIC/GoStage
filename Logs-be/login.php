<?php
require_once('../db.php');
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    
    $sql = "SELECT * FROM etudiants WHERE mail='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['type'] = 'etudiant'; 
        header("Location: ../view/profil.php");
        exit();
    } else {

        $sql = "SELECT * FROM entreprises WHERE mail='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['type'] = 'entreprise';
            header("Location: ../view/profil-entreprise.php");
            exit();
        } else {

            header("Location: ../view/connexion.php?error=1");
            exit();
        }
    }
} else {
    echo "erreur, une erreur s'est produite";
}
?>