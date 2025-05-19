<?php
require_once('db.php');


if (
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm_pass'])
) {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_pass = htmlspecialchars(trim($_POST['confirm_pass']));

    if ($password != $confirm_pass) {
        header("Location: inscription.php?error=Les mots de passe ne correspondent pas");
        exit();
    }

    // insérer l'utilisateur dans la base de données
    // cette methode est vulnérable aux injections SQL
    // il est préférable d'utiliser des requêtes préparées
    $query = "INSERT INTO utilisateurs (nom, prenom, email, password) VALUES ('$nom', '$prenom', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    // vérifier si l'insertion a réussi
    if ($result) {
        // rediriger vers la page de connexion
        header("Location: index.php?success=Inscription réussie");
        exit();
    } else {
        // afficher un message d'erreur
        header("Location: inscription.php?error=Erreur lors de l'inscription");
        exit();
    }

} else {
    echo "erreur, une erreur s'est produite";
}
?>