<?php
require_once '../db.php';
require_once('../fieldsNames.php');
require_once('../Composant/header.php');
$idEntreprise = include('../Composant/getId-update-entreprise.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une offre</title>
    <style>
        body {
            background-image: url("fond.avif");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        td {
            padding: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;

        }

        .button {
            text-align: center;
            margin-top: 10px;
            margin: 30px;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            flex-direction: row;
            align-items: center ;
        }
    </style>
</head>

<body>
<!--  -->
    <h2>Poster des offres d'emploi</h2>
    <form action="../Profil-entreprise-be/addOffre.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="intitule">Intitule ( intitule )</label></td>
                <td><input type="text" id="intitule" name="intitule" required></td>
            </tr>

            <tr>
                <td><label for="description">description de l'offre:</label></td>
                <td><textarea id="description" name="description" rows="4" cols="50" required></textarea></td>
            </tr>

            <tr>
                <td><label for="id_adresse">Lieu de travail:</label></td>
                <td><input type="text" id="id_adresse" name="id_adresse" required></td>
            </tr>

            <tr>
                <td><label for="renumeration">renumeration:</label></td>
                <td><input type="number" id="renumeration" name="renumeration" required></td>
            </tr>

            <tr>
                <td><label for="typeContrat">Type de contrat:</label></td>
                <td>
                    <select id="typeContrat" name="typeContrat">
                        <option value="Stage" selected >Stage</option>
                    </select></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" value="Poster l'offre"> <input type="reset" value="Annuler"></td>
            </tr>
        </table>
    </form>
    <br>
    <div class="button">
        <button onclick=" location.href='profil-entreprise.php'">Voir les offres postees</button>
        <br>
        <br>
        <button onclick=" location.href='profil-entreprise.php'">Retour au profil</button>

    </div>

</body>

</html>