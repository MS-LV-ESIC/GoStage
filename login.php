<?php
// on inclut le fichier de connexion à la base de données db.php
require_once('db.php');

//on vérifie si le formulaire a "t" soumis avec la méthode POST et si les champs email et password sont remplis
// $_POST est un tabeau associatif contenant les données envoyées par le formualire
// $_POST['email'] et $_POST['password'] contiennent les valeurs des champs email et password du formulaire
// isset() permet de vérifier si une variable est définie et n'est pas NULL
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    //htmlspecialchars pour éviter tout attaque malveillante

    //Requête pour vérifier si l'utilisateur existe dans la BD
    $sql = "SELECT * FROM utilisateurs WHERE email = 'email' AND password =  '$password'";
    // Exécutez la requête, on se connecte à la base de données et on ecécute la requête
    $result = mysqli_query($conn, $sql);
    // Vérifiez si la requête  reussi
    // mysqli_query() renvoie TRUE en cas de succès ou FALSE en cas d'échec
    // mysqli_num_rows() renvoie le nombre de lignes dans le résultat de la requête
    if(mysqli_num_rows($result) > 0){
        header("Location: accueil.php");
        exit();
    } else{
        //si l'utilisateur n'existe pas, on renvoie l'utilisateur vers la page de connexion avec un message d'erreur
        // header() envoie un en-tête HTTP brut au client
        header("location: index.php?error=1");
        exit();
    }
    
} else {
    // si le formulaire n'a pas été soumis ou si les champs email et password ne sont pas remplis
    echo "erreur, une erreur s'est produite";
}
?>