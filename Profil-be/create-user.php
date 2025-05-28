<?php
require_once('../db.php');
 
// Activer les erreurs MySQLi pour faciliter le debug (à retirer en production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
if (
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['mail']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm_pass'])
) {
    // Nettoyage des données
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $password = trim($_POST['password']);
    $confirm_pass = trim($_POST['confirm_pass']);
 
    // Vérification des mots de passe
    if ($password !== $confirm_pass) {
        header("Location: inscription.php?error=Les mots de passe ne correspondent pas");
        exit();
    }
 
    // Hash du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
 
    try {
        // Vérifier si l'mail existe déjà
        $checkQuery = "SELECT id_etudiant FROM etudiants WHERE mail = ?
        Union
        SELECT id_entreprise FROM entreprises WHERE mail = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "ss", $mail,$mail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
 
        if (mysqli_stmt_num_rows($stmt) > 0) {
            header("Location: inscription.php?error=mail déjà utilisé");
            exit();
        }
 
        // Insertion dans la base de données
        $insertQuery = "INSERT INTO etudiants (nom, prenom, mail, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssss", $nom, $prenom, $mail, $password);
        mysqli_stmt_execute($stmt);
 
        header("Location: ../view/connexion.php?success=Inscription réussie");
        exit();
 
    } catch (Exception $e) {
    // Affiche l'erreur sur la page pour diagnostiquer
        echo "Erreur : " . $e->getMessage();
        exit();
    }
 
} else {
    header("Location: inscription.php?error=Champs manquants");
    exit();
}
?>
 