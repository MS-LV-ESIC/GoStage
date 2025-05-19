<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Piscine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="margin-top: 250px;">

            <div class="card p-4 shadow text-bg-info" style="min-width: 350px; max-width: 400px; width: 100%;">
                <h3 class="text-center text-white">Formulaire de connexion</h3>
                <p class="text-center text-secondary">veuillez vous connecter</p>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">

                        <span class="input-group-text" onclick="tooglePasswordType()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success w-100">connexion</button>
                    <p class="text-center mt-4" id="msgErr"></p>
                </form>

                <?php

                    if(isset($_GET['error']) && $_GET['error'] == 1){ 
                        echo "<p class='text-danger text-center'> Identifiant ou mot de passe incorrects </p>";
                    }
                ?>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>