<?php

require_once("../db.php");
require_once("../fieldsNames.php");
$query = "SELECT 
  o.". ID_OFFRE ." AS ". ID_OFFRE .",
  o.". INTITULE ." AS ". INTITULE .",
  o.". RENUMERATION ." AS ". RENUMERATION .",
  o.". FIELD_APROPOS_OFFRE ." AS ". FIELD_APROPOS_OFFRE .",
  o.". LOCALISATION ." AS ". LOCALISATION .",


  e.". ID_ENTREPRISE ." AS ". ID_ENTREPRISE .",
  e.". FIELD_NAME ." AS ". FIELD_NAME .",
  e.". FIELD_EMAIL ." AS ". FIELD_EMAIL ."
FROM ". OFFRES ." o
JOIN ". ENTREPRISE ." e ON o.". ID_ENTREPRISE ." = e.". ID_ENTREPRISE ."
WHERE o.". ID_OFFRE ." = 2";




$image = $user[FIELD_IMAGE] ?? '';
require ('../Composant/header.php');



$result = mysqli_query($conn, $query);


// Вариант 1: одна строка
$offre = mysqli_fetch_assoc($result);


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
    <title>Offre</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }


        body {
            background-color: #D9D9D9;
        }


        table {}


        button {
            padding-left: 5px;
            padding-right: 5px;
        }


        tr {
            /* to change remove the point . */
            padding: 10px;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 300px;
            gap: 5px;
        }


        th {
            text-align: start
        }


        h1 {
            padding: 10px
        }


        .profil {
            display: flex;
        }


        .info {
            width: 38%;
            margin: 25px;
            position: fixed;
        }


        .photo {
            display: flex;
        }


        .post {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }


        .Offre {
            background-color: white;
            width: 58%;
            padding: 2%;
            margin-left: 41%;
            padding-bottom: 60%;
        }
    </style>
</head>
<body>

<div class="profil">
    <div class="info">
        <div class="photo">

            <form class="uploadPhoto">
                <?php if (!empty($image)) : ?> 
                    <img src="<?php echo htmlspecialchars('../Profil-be/' . $image); ?>" alt="Photo de profil" width="100" height="100">
                <?php else : ?>
                    <img src="../Profil-be/image/default.png" alt="Photo de profil par défaut" width="100" height="100">
                <?php endif; ?>
                <h2>
                    <span id="label-<?php echo FIELD_NAME; ?>">
                        <span id="<?php echo FIELD_NAME; ?>-value"></span>
                    </span>
                </h2>
            </form>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <span id="label-<?php echo INTITULE; ?>">
                                    <span id="<?php echo INTITULE; ?>-value"></span>
                                </span>
                            </th>

                            <th>
                                <span id="label-<?php echo LOCALISATION; ?>">
                                    Ville : <span id="<?php echo LOCALISATION; ?>-value"></span>
                                </span>
                            </th>

                            <th>
                                <span id="label-<?php echo RENUMERATION; ?>">
                                    Ruenumeration : <span id="<?php echo RENUMERATION; ?>-value"></span>
                                </span>
                            </th>

                            <th>
                                <span id="label-<?php echo FIELD_APROPOS_OFFRE; ?>">
                                    <h1>Le poste</h1><br> <span id="<?php echo FIELD_APROPOS_OFFRE; ?>-value"></span>
                                </span>
                            </th>

                            
                        </tr>
                    </thead>
                </table>  
            </div>
        </div>


        

    </div>
</div>

<?php
require('../Composant/footer.php');
?>

<script>

let offre = <?php echo json_encode($offre); ?>;

document.getElementById('<?php echo FIELD_NAME; ?>-value').textContent = offre["<?php echo FIELD_NAME; ?>"];
document.getElementById('<?php echo INTITULE; ?>-value').textContent = offre["<?php echo INTITULE; ?>"];
document.getElementById('<?php echo FIELD_APROPOS_OFFRE; ?>-value').textContent = offre["<?php echo FIELD_APROPOS_OFFRE; ?>"];
document.getElementById('<?php echo RENUMERATION; ?>-value').textContent = offre["<?php echo RENUMERATION; ?>"];
document.getElementById('<?php echo LOCALISATION; ?>-value').textContent = offre["<?php echo LOCALISATION; ?>"];

</script>

</body>
</html>