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
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }
        header {
            background-color: rgba(0, 76, 170, 1);
            display: flex;
            position: sticky;
            top: 0;
            justify-content: space-between;
        }  
        body{
            background-image: url(groupe-de-personnes-diverses-ayant-une-reunion-d-affaires.jpg);
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
            opacity: 1;
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
        .button{
            margin-top: 20px;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
     <header>
        <div class="header-logo">
            <img src="Logo_site_stage_-_2-removebg-preview.png" alt="" width="100px">
        </div>
        <div class="header-icon">
            <i class="fa-regular fa-bell" style="color: white; font-size: 150%; margin: 40px;"></i>
            <i class="fa-solid fa-magnifying-glass" style="color:white; font-size: 150%; margin:40px;"></i>
            <i class="fa-solid fa-user" style="color: #ffffff; font-size: 150%; margin: 40px;"></i>
        </div>
    </header>
    <div class="Container">
        <form class="Formulaire" action="">
            <h2 class="inner-T">Connexion</h2>
            <input type="email" class="input-form" id="email" name="email" required placeholder="Exemple.mail@gmail.com">
            <input type="password" class="input-form" id="password" name="password" required placeholder="Mot de passe">
            <button type="submit" class="button">Log in</button>
            <a href="" style="margin-top: 10px;">S'inscrire</a>
        </form>
    </div>
</body>
</html>