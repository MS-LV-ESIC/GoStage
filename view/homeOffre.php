<?php
session_start();
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
  e." . FIELD_EMAIL . " AS " . FIELD_EMAIL . ",
  e." . FIELD_IMAGE . " AS " . FIELD_IMAGE . "
FROM " . OFFRES . " o
JOIN " . ENTREPRISE . " e ON o." . ID_ENTREPRISE . " = e." . ID_ENTREPRISE . "
WHERE o." . ID_OFFRE . " = $id";

$result = mysqli_query($conn, $query);
$offre = mysqli_fetch_assoc($result);

$image = $offre[FIELD_IMAGE] ?? '';

require('../Composant/header.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Offre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Nunito', sans-serif;
        }

        body {
            background-image: url('https://img.freepik.com/vecteurs-premium/fond-courbe-simple-pour-entreprises-espace-pour-texte_336924-5580.jpg?semt=ais_hybrid&w=740');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .offre-container {
            background-color: rgba(255, 255, 255, 0.9);
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            max-width: 800px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .title img {
            border-radius: 10px;
        }

        .title h3 {
            margin-left: 20px;
        }

        .job-info {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            margin-top: 15px;
        }

        .bouton {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-postuler {
            background-color: rgba(0, 76, 170, 1);
            color: white;
        }

        .description {
            margin-top: 30px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="offre-container">
        <div class="title d-flex align-items-center">
            <?php if (!empty($image)): ?>
                <img src="<?php echo htmlspecialchars('../Profil-entreprise-be/' . $image); ?>" alt="Photo de profil" width="100" height="100">

            <?php else: ?>
                <img src="../Profil-be/default.png" alt="Photo de profil par défaut" width="100" height="100">
            <?php endif; ?>
            <h3 id="<?php echo FIELD_NAME; ?>-value"></h3>
        </div>

        <h2 class="mt-4" id="<?php echo INTITULE; ?>-value"></h2>

        <div class="job-info">
            <span><strong>Ville :</strong> <span id="<?php echo LOCALISATION; ?>-value"></span></span>
            <span><strong>Rémunération :</strong> <span id="<?php echo RENUMERATION; ?>-value"></span></span>
        </div>

        <div class="bouton">
            <button class="btn btn-postuler">Postuler</button>
            <span class="heart-icon">🤍</span>

                <?php if ($_SESSION['type'] === 'entreprise') : ?>
                    <form action="../Composant/tableauDeBord-be/deleteOffre.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">
                        <input type="hidden" name="id" value="<?php echo $offre[ID_OFFRE]; ?>">
                        <button type="submit" class="btn btn-danger">Supprimer l'offre</button>
                    </form>
                <?php endif; ?>
        </div>

        <div class="description">
            <h4>Description du poste</h4>
            <p id="<?php echo FIELD_APROPOS_OFFRE; ?>-value"></p>
        </div>
    </div>

    <?php require('../Composant/footer.php'); ?>

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
