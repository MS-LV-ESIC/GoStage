<?php
require_once('db.php');


var_dump($_POST);
// Affiche les erreurs MySQLi pour le debug
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (
    isset($_POST['nom']) &&
    isset($_POST['mail']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm_pass'])
) {
    // Nettoyage des données
    $nom = htmlspecialchars(trim($_POST['nom']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $password = trim($_POST['password']);
    $confirm_pass = trim($_POST['confirm_pass']);

    // Vérification des mots de passe
    if ($password !== $confirm_pass) {
        header("Location: ./view/inscriptionEntreprise.php?error=Les mots de passe ne correspondent pas");
        exit();
    }

    // Hash du mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Vérifie si le mail existe déjà
        $checkQuery = "SELECT id_entreprise FROM entreprises WHERE mail = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "s", $mail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            header("Location: ./view/inscriptionEntreprise.php?error=Adresse mail déjà utilisée");
            exit();
        }

        // Insertion dans la BDD
        $insertQuery = "INSERT INTO entreprises (nom, mail, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "sss", $nom, $mail, $password);
        mysqli_stmt_execute($stmt);

        header("Location: ./view/offre.php?success=Inscription réussie");
        exit();

    } catch (Exception $e) {
        echo "Erreur SQL : " . $e->getMessage();
        exit();
    }

} else {
    // Affiche une erreur si des champs sont manquants
    echo "Erreur : ERREURE.";
    exit();
}
?>
