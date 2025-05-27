<?php
require_once("../db.php");
require_once("../fieldsNames.php");

// ✅ Start session at the very top
session_start();

// ✅ Basic session validation
if (!isset($_SESSION['email']) || !isset($_SESSION['type'])) {
    header('Location: ../connexion.php');
    exit();
}

// ✅ Set component mode and get the appropriate ID
$component_mode = '';
$id_etudiant = null;
$id_entreprise = null;

if ($_SESSION['type'] === 'etudiant') {
    $component_mode = 'etudiant';
    $id_etudiant = include("../composant/getId-update-etudiant.php");
} elseif ($_SESSION['type'] === 'entreprise') {
    $component_mode = 'entreprise';
    $id_entreprise = include("../composant/getId-update-entreprise.php");
} else {
    die("Invalid mode: unknown user type");
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
    @import url('https://img.freepik.com/vecteurs-libre/cercle-abstrait-affaires-bleu_1182-678.jpg?semt=ais_hybrid&w=740');

    body {
        margin: 0;
        font-family: 'Nunito', sans-serif;
    }

    .offre-title {
        padding: 30px 20px;
        text-align: center;
        background-image: url('https://img.freepik.com/vecteurs-libre/cercle-abstrait-affaires-bleu_1182-678.jpg?semt=ais_hybrid&w=740');
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 30px;
    }
</style>

<body>

<?php
require_once("../composant/header.php");
?>

<h1 class="offre-title">Liste des Offres</h1>

<?php
// ✅ Pass the correct mode and ID to the component
include("../composant/tableauDeBord.php");

require_once("../composant/footer.php");
?>

</body>
</html>