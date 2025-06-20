<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
</head>

<body>
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("./images/groupe-de-personnes-diverses-ayant-une-reunion-d-affaires.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            opacity: 0.4;
            /* règle ici l’opacité de l’image */
            z-index: -1;
        }

        .choice {
            display: flex;
        }

        .choice div {
            justify-content: space-around;
        }
    </style>
    <?php
    require_once('../Composant/header.php')
        ?>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="margin-top: 5%; margin-bottom: 10%;">

            <div class="form shadow"
                style="min-width: 350px; max-width: 400px; width: 100%; background: rgba(255, 255, 255, 0.774); padding: 30px; border-radius: 3%;">
                <h3 class="text-center" style="color: rgba(0, 76, 170, 1);"><strong>Inscription</strong></h3><br>
                <form action="../Profil-be/create-user.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prenom">
                    </div>

                    <div class="mb-3">
                        <input type="mail" name="mail" id="mail" class="form-control" placeholder="mail@gmail.com">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Mot de passe">

                        <span class="input-group-text" onclick="tooglePasswordType()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control"
                            placeholder="Confirmer le mot de passe">
                        <span class="input-group-text" onclick="tooglePasswordType()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn w-100 mt-2"
                        style="background-color: rgba(0, 76, 170, 1); color: white;">Inscription</button>
                    <button type="button" onclick="location.href='connexion.php'" class="btn w-100 mt-1"
                        style="color: rgba(0, 76, 170, 1);">Se
                        connecter ?</button>
                    <button type="button" onclick="location.href='inscriptionEntreprise'" class="btn w-100 mt-1"
                        style="color: rgba(0, 76, 170, 1);">
                        Inscription entreprise?</button>
                    <p class="text-center mt-4" id="msgErr"></p>
                </form>
            </div>
        </div>
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger text-center" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
        }

        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success text-center" role="alert">' . htmlspecialchars($_GET['success']) . '</div>';
        }

        ?>
    </div>
    <?php
    require_once('../Composant/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>