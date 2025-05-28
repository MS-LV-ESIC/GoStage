<?php

require_once("../db.php");
require_once("../fieldsNames.php");
$id = $_GET['id'];
$query = "SELECT 
  o." . ID_OFFRE . " AS " . ID_OFFRE . ",
  o." . INTITULE . " AS " . INTITULE . ",
  o." . RENUMERATION . " AS " . RENUMERATION . ",
  o." . FIELD_APROPOS_OFFRE . " AS " . FIELD_APROPOS_OFFRE . ",
  o." . LOCALISATION . " AS " . LOCALISATION . ",


  e." . ID_ENTREPRISE . " AS " . ID_ENTREPRISE . ",
  e." . FIELD_NAME . " AS " . FIELD_NAME . ",
  e." . FIELD_EMAIL . " AS " . FIELD_EMAIL . "
FROM " . OFFRES . " o
JOIN " . ENTREPRISE . " e ON o." . ID_ENTREPRISE . " = e." . ID_ENTREPRISE . "
WHERE o." . ID_OFFRE . " = $id";




$image = $user[FIELD_IMAGE] ?? '';
require('../Composant/header.php');



$result = mysqli_query($conn, $query);


// Вариант 1: одна строка
$offre = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }
        .job .title{
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .job-info {
            display: flex;
            gap: 50px;
            font-size: 20px;
        }
        h2 {
            font-size: 50px;
        }
        .bouton{
            display: flex;
            justify-content: space-between;
        }
        body {
            background-image: url('https://img.freepik.com/vecteurs-premium/fond-courbe-simple-pour-entreprises-espace-pour-texte_336924-5580.jpg?semt=ais_hybrid&w=740');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    </header>
    <div class="job m-5 border p-2"
        style="box-shadow: rgba(0, 76, 170, 0.4) -5px 5px, rgba(0, 76, 170, 0.3) -10px 10px, rgba(0, 76, 170, 0.2) -15px 15px, rgba(0, 76, 170, 0.1) -20px 20px, rgba(0, 76, 170, 0.05) -25px 25px;">
        <div class="title m-2">
            <?php if (!empty($image)): ?>
                <img src="<?php echo htmlspecialchars('../Profil-be/' . $image); ?>" alt="Photo de profil" width="100"
                    height="100">
            <?php else: ?>
                <img src="../Profil-be/image/default.png" alt="Photo de profil par défaut" width="100px">
            <?php endif; ?>
            <h3> <span id="label-<?php echo FIELD_NAME; ?>">
                    <span id="<?php echo FIELD_NAME; ?>-value"></span>
                </span></h3>
        </div>
        <h2><strong> <span id="label-<?php echo INTITULE; ?>">
                    <span id="<?php echo INTITULE; ?>-value"></span>
                </span></strong></h2>
        <div class="job-info m-2">
            <span id="label-<?php echo LOCALISATION; ?>"><strong>Ville : </strong><span
                    id="<?php echo LOCALISATION; ?>-value"></span>
            </span>
            <span id="label-<?php echo RENUMERATION; ?>"><strong>Remuneration : </strong><span
                    id="<?php echo RENUMERATION; ?>-value"></span>
            </span>
        </div>

        <div class="bouton">
            <button type="button" class="btn active" style="background-color: rgba(0, 76, 170, 1); color: white;"
                data-bs-toggle="button" aria-pressed="true">Postuler</button>
            <span class="heart-icon">🤍</span>
        </div>
    </div>
    <div class="description m-5 border p-2"
        style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; background-color: rgba(255, 255, 255, 0.308);">
        <h4><strong> <span id="label-<?php echo FIELD_APROPOS_OFFRE; ?>">
                    <h1>Description du poste</h1><br> <span
                        id="<?php echo FIELD_APROPOS_OFFRE; ?>-value"></span></strong></h4>
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