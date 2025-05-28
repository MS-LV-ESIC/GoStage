<?php
require("../Composant/header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/5d4f51e2a9.js" crossorigin="anonymous"></script>
    <title>Connexion</title>
    <style>
        body {
            background-image: url(/GoStage/view/images/groupe-de-personnes-diverses-ayant-une-reunion-d-affaires.jpg);
            background-size: cover;
        }

        .Container {
            background-color: #000000;
            opacity: 0.77;
            margin: 100px auto;
            width: 750px;
            height: 400px;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Formulaire {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .inner-T {
            color: white;
            text-align: center;
            font-size: 30px;
        }

        .input-form {
            width: 400px;
            height: 50px;
            border-radius: 30px;
            margin-top: 40px;
            font-size: 15px;
            border: none;
            padding-left: 20px;
        }

        .button {
            margin-top: 10px;
            padding: 5px;
            border-radius: 5px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="body">
        <div class="Container">
            <form class="Formulaire" action="../Logs-be/login.php" method="POST">
                <h2 class="inner-T">Connexion</h2>
                <input type="email" class="input-form" id="email" name="email" required
                    placeholder="Exemple.mail@gmail.com">
                <input type="password" class="input-form" id="password" name="password" placeholder="Mot de passe">
                <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo "<p class='error'> Identifiant ou mot de passe incorrectes </p>";
                }
                ?>
                <button type="submit" class="button">Log in</button>
                <a href="" style="margin-top: 10px; color: white;">S'inscrire</a>

            </form>
        </div>
    </div>
</body>

</html>