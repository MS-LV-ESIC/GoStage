<?php

require_once("../db.php");
require_once("../fieldsNames.php");



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
JOIN " . ENTREPRISE . " e ON o." . ID_ENTREPRISE . " = e." . ID_ENTREPRISE;





$image = $user[FIELD_IMAGE] ?? '';




$result = mysqli_query($conn, $query);


// Вариант 1: одна строка
$offres = [];

while ($row = mysqli_fetch_assoc($result)) {
    $offres[] = $row;
}

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
    <script src="https://kit.fontawesome.com/5d4f51e2a9.js" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        body {
            margin: 0;
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }

        h1 {
            padding: 40px;
            text-align: center;
            background-image: url('https://img.freepik.com/vecteurs-libre/cercle-abstrait-affaires-bleu_1182-678.jpg?semt=ais_hybrid&w=740');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-size: 500%;
        }
    </style>

    <h1>Offre</h1>
    <div id="offres-container">
    </div>


    <script>
        let offres = <?php echo json_encode($offres); ?>;
        const container = document.getElementById("offres-container")
        offres.forEach(offre => {
            const div = document.createElement("div");
            div.classList.add("offre");
            div.innerHTML = `<div class="container m-5"><div style="background-color: #f1f1f1;border-radius: 10px;padding: 20px;margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
        <div style="flex: 2;"><strong>Entreprise :</strong> ${offre['<?php echo FIELD_NAME; ?>']}<br>
        <div style="font-weight: bold;margin-bottom: 5px;"><strong>Titre du poste :</strong> ${offre['<?php echo INTITULE; ?>']}<br></div>
        <strong>Localisation :</strong> ${offre['<?php echo LOCALISATION ?>']}<br></div>

        <div style="text-align: right;flex: 1;">
        <form action='../Composant/tableauDeBord-be/favoris.php' method='POST'>
            <input type='hidden' name='id_offre' value='${offre["id_offre"]}'>
            <div style="font-size: 20px;margin-right: 10px;cursor: pointer;"><span class="heart-icon">🤍</span></div></div>
        </form>
        <div button class="btn apply-button" style="background-color: rgba(0, 76, 170, 1);color: white;padding: 8px 16px;border: none;border-radius: 20px;cursor: pointer;margin-bottom: 5px;">Postuler</button></div>
        <div style="font-size: 12px;color: #555;text-decoration: underline;margin: 10px"><a href='../view/homeOffre.php?id=${offre['<?php echo ID_OFFRE ?>']}' >Voir la description du poste</a><br></div>
        </div>
        </div>
    `;
            container.appendChild(div);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>