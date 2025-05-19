<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Piscine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <div class="d-flex justify-content-center align-item-center" style="margin-top: 250px;">
            <div class="card p-4 shadow" style="min-width: 350px; max-width: 400px; width: 100%;">
                <h3 class="text-center text-info">Formulaire de connexion</h3>
                <form action="login.php" method="POST"><!--post pour envoyer de l'information-->
                    <div class="mb-3">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Nom d'utilisateur">
                    </div>
                    <div class=" input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Mot de passe">
                        <span class="input-group-text" onclick="tooglePasswordType()">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <button type="submit" onclick="connexion()" class="btn btn-outline-primary w-100">connexion</button>
                    <button type="button" onclick="location.href='inscription.php'" class="btn btn-warning w-100 mt-1">inscription ?</button>
                    <button type="button" class="btn btn-link w-100 mt-1">Mot de passe oublié ?</button>
                    <p class="text-center text" id="msgErr"> </p>
                </form>
                <?php
                //si on a un message d'erreur dans l'URL, on l'affiche 
                // $_GET est un tableau associatif contenant les données envoyées par l'URL
                // $_GET['error'] contient la valeur du paramètre error dans l'URL
                // isset() permet de vérifier si une varaible est définie et n'est pas NULL, du coup on vérifie si
                // le paramètre error est présent dans l'URL et s'il est égal à 1
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo "<p class='text-danger text-center'> Identifiant ou mot de passe incorrectes </p>";
                }
                ?>
            </div>
        </div>
    </div>



    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>