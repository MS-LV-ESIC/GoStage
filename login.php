<?php

    require_once('db.php');


    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);


        $sql = "SELECT * FROM utilisateur WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){

            header("Location: accueil.php");

            exit();
        }else{
            header("Location: index.php?error=1");
            exit();
        }
       
    }else{

        echo "erreur, une erreur s'est produite";
    }
?>