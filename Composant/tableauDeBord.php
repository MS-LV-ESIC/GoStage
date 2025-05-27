<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../db.php");
require_once("../fieldsNames.php");

$profileEtudiant = isset($component_mode) && $component_mode === 'profil';
$profilEntreprise = isset($component_mode) && $component_mode === 'entreprise';

$component_mode = 'entreprise';



$validModes = ['profil', 'entreprise', 'etudiant'];
if (!in_array($component_mode, $validModes)) {
    die("Invalid mode: $component_mode");
}

$profileEtudiant = $component_mode === 'etudiant';
$profilEntreprise = $component_mode === 'entreprise';

$id_entreprise = 1;

if ($profileEtudiant) {
    // Show only favorite offers of student
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
    JOIN ". ENTREPRISE ." e ON o.". ID_ENTREPRISE ." = e.". ID_ENTREPRISE;

} else if($profilEntreprise){
    // Show all offers
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
    WHERE e.id_entreprise = $id_entreprise";  // <-- FIXED: removed JOIN favoris

}else if($defaultEtudiant){
    // Show all offers
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
    JOIN ". ENTREPRISE ." e ON o.". ID_ENTREPRISE ." = e.". ID_ENTREPRISE;

}else {
    die("Error: No valid component mode set. Cannot build SQL query.");
}

$image = $user[FIELD_IMAGE] ?? '';



$result = mysqli_query($conn, $query);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$offres = [];
while($row = mysqli_fetch_assoc($result)){
    $offres[] = $row;
}


if($profileEtudiant){
    $favorisResult = mysqli_query($conn, "SELECT id_offre FROM favoris WHERE id_etudiant = 1");
    $favoris = [];
    while($fav = mysqli_fetch_assoc($favorisResult)) {
        $favoris[] = $fav['id_offre'];
}
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
const ID_OFFRE = "<?php echo ID_OFFRE; ?>";
const FIELD_NAME = "<?php echo FIELD_NAME; ?>";
const INTITULE = "<?php echo INTITULE; ?>";
const LOCALISATION = "<?php echo LOCALISATION; ?>";

let offres = <?php echo json_encode($offres); ?>;

const container = document.getElementById("offres-container");

<?php if ($profileEtudiant): ?>
    let favoris = <?php echo json_encode($favoris ?? []); ?>;
    favoris = favoris.map(f => parseInt(f));
<?php else: ?>
    let favoris = [];
<?php endif; ?>

offres.forEach(offre => {
    const div = document.createElement("div");
    div.classList.add("offre");

    const offerId = parseInt(offre[ID_OFFRE]);
    
    // Decide button label depending on user type
    let buttonLabel;
    if (<?php echo json_encode($profileEtudiant); ?>) {
        const isFavori = favoris.includes(offerId);
        buttonLabel = isFavori ? "Retirer des favoris" : "Ajouter aux favoris";
    } else {
        buttonLabel = "Modifier l'offre";
    }

    div.innerHTML = `
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
        <strong>Entreprise :</strong> ${offre[FIELD_NAME]}<br>
        <strong>Titulaire :</strong> ${offre[INTITULE]}<br>
        <strong>Localisation :</strong> ${offre[LOCALISATION]}<br>
        <a href='../view/homeOffre.php?id=${offerId}'>Voir la description du poste</a><br>
        
        <form action='../view/homeOffre.php?id=${offerId}' method='POST'>
            <input type='hidden' name='id_offre' value='${offerId}'>
            <button type='submit'>${buttonLabel}</button>
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