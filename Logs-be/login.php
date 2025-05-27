<?php
require_once('../db.php');
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    
    // Use prepared statements to avoid SQL injection! But for now:
    $sql = "SELECT * FROM etudiants WHERE mail='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $email;
        $_SESSION['type'] = 'etudiant'; 
        $_SESSION['id_etudiant'] = $user['id_etudiant']; // <-- SET the ID here
        header("Location: ../view/profil.php");
        exit();
    } else {

        $sql = "SELECT * FROM entreprises WHERE mail='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $email;
            $_SESSION['type'] = 'entreprise';
            $_SESSION['id_entreprise'] = $user['id_entreprise']; // <-- SET the ID here
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