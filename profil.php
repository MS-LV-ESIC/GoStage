<?php
require_once 'db.php';

$query = "SELECT * FROM utilisateurs";
$result = mysqli_query($conn, $query);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            background-color:#D9D9D9;
        }
        table{
        }
        tr{    /* to change remove the point . */
            padding: 10px;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 150px;
        }
        th{
            text-align:start
        }
        h1 {
            padding:10px
        }
        .profil{
            display:flex
        }
        .photo{
            display:flex;
        }
        .post{
            display:flex;
            flex-direction: row;
            align-items: flex-start;
        }

        .aPropos{
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="profil">
        <div>
            <div class="photo">
                <img src="f.png" alt="my photo">
                <div>
                    <h1>Mon Profil</h1>
                    <form action="dataInsert.php" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <span id="label-nom" onclick="showInput('nom')">Nom: <span id="nom-value"></span></span>
                                        <input type="text" name="nom" id="nom" style="display:none;" disabled>
                                        <button type="button" id="apply-nom" style="display:none;" onclick="applyInput('nom')">Appliquer</button>
                                    </th>
                                    <th>
                                        <span id="label-prenom" onclick="showInput('prenom')">Prenom: <span id="prenom-value"></span></span>
                                        <input type="text" name="prenom" id="prenom" style="display:none;" disabled>
                                        <button type="button" id="apply-prenom" style="display:none;" onclick="applyInput('prenom')">Appliquer</button>
                                    </th>
                                    <th>
                                        <span id="label-email" onclick="showInput('email')">Email</span>
                                        <input type="email" name="email" id="email" style="display:none;" disabled>
                                    </th>
                                    <th>
                                        <span id="label-cursus" onclick="showInput('cursus')">Nom du cursus</span>
                                        <input type="text" name="cursus" id="cursus" style="display:none;" disabled>
                                    </th>
                                    <th>
                                        Cv en pièce jointe
                                        <input type="file" name="cv">
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
            <h1>Offre sauvgarder</h1>
            <div >
                <div class="post">
                    <img src="r.png" alt="">
                    <div >
                        <h3>Nom entreprise</h3>
                        <p>Nome du poste</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="aPropos">
            <h1>A propos de moi</h1>
            <p>texttexttex ttexttexttext texttexttex  ttexttexttex ttexttextte xttext texttextt extte xtt extt exttex ttexttex ttexttexttextt exttext texttex ttexttex ttextt exttextte xttexttex ttexttexttex  ttexttextte xttexttexttexttexttextte</p>
        </div>
    </div>

    
</body>
</html>
<script>
let user = {
    nom: "Alice",
    prenom:"Braun",
    email:"aliceBraun@gmail.com",
    cursus:"BTS-SIO"
}

document.getElementById('nom-value').textContent = user.nom;
document.getElementById('prenom-value').textContent = user.prenom;
document.getElementById('email-value').textContent = user.email;
document.getElementById('cursus-value').textContent = user.cursus;

function showInput(field) {
    document.getElementById('label-' + field).style.display = 'none';
    var input = document.getElementById(field);
    input.style.display = 'inline';
    input.disabled = false;
    input.value = user[field]; // Pre-fill with current value
    input.focus();
    document.getElementById('apply-' + field).style.display = 'inline';
}

function applyInput(field) {
    var input = document.getElementById(field);
    user[field] = input.value; // Update user object
    document.getElementById(field + '-value').textContent = input.value; // Update label
    input.style.display = 'none';
    input.disabled = true;
    document.getElementById('apply-' + field).style.display = 'none';
    document.getElementById('label-' + field).style.display = 'inline';
}

</script>