<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../db.php");
require_once("../fieldsNames.php");

// The parent file must set $component_mode and $idEtudiant if 'etudiant'
$component_mode = $component_mode ?? 'etudiant';

$validModes = ['profil', 'entreprise', 'etudiant'];
if (!in_array($component_mode, $validModes)) {
    die("Invalid mode: $component_mode");
}

$profileEtudiant = $component_mode === 'etudiant';
$profilEntreprise = $component_mode === 'entreprise';


if ($profileEtudiant && isset($id_etudiant) && ($showOnlyFavorites ?? false)) {
    // ✅ Show only favorite offers of student
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
    JOIN favoris f ON f.id_offre = o.". ID_OFFRE ."
    WHERE f.id_etudiant = $id_etudiant";

} else if ($profilEntreprise) {
    // Show all offers from one entreprise
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
    WHERE e.id_entreprise = $id_entreprise";

} else {
    // Default: show all offers
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
}

$result = mysqli_query($conn, $query);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$offres = [];
while($row = mysqli_fetch_assoc($result)){
    $offres[] = $row;
}


if($profileEtudiant && isset($id_etudiant)){
    $favorisResult = mysqli_query($conn, "SELECT id_offre FROM favoris WHERE id_etudiant = $id_etudiant");
    $favoris = [];
    while($fav = mysqli_fetch_assoc($favorisResult)) {
        $favoris[] = $fav['id_offre'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Liste des Offres</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />

    <!-- Google Fonts Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f9fafb;
        }

        h2 {
            text-align: center;
            margin: 30px;
            color: #004caa;
            font-weight: 700;
        }

        #offres-container {
            display: flex;
            gap: 20px;
            flex-direction: column;
            align-items: center;
            max-height: 450px;   /* Set the fixed height you want */
            /* overflow-y: auto;    Enable vertical scroll if content is taller */
        }

        .offre {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 650px;
            height: 140px;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
            display: flex;
            justify-content: space-between;
            transition: box-shadow 0.3sease;
        }

        .offre:hover {
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.15);
        }

        .offre strong {
            color: #333;
        }

        .submit{
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .offre .details {
            margin-bottom: 15px;
            font-size: 1rem;
            line-height: 1.4;
        }

        .offre a.details-link {
            text-decoration: none;
            color: #004caa;
            font-weight: 600;
            margin-top: auto;
            align-self: flex-start;
        }

        .offre a.details-link:hover {
            text-decoration: underline;
        }

        form button, 
        .offre a.details-link.button-link {
            background-color: #004caa;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.25s ease;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            margin-top: 10px;

        }

        form button:hover,
        .offre a.details-link.button-link:hover {
            background-color: #003580;
        }
    </style>
</head>
<body>


    <div id="offres-container"></div>

    <script>
        const userType = "<?php echo $_SESSION['type'] ?? 'guest'; ?>";
        const ID_OFFRE = "<?php echo ID_OFFRE; ?>";
        const FIELD_NAME = "<?php echo FIELD_NAME; ?>";
        const INTITULE = "<?php echo INTITULE; ?>";
        const LOCALISATION = "<?php echo LOCALISATION; ?>";

        let offres = <?php echo json_encode($offres); ?>;
        let favoris = <?php echo json_encode($favoris ?? []); ?>;
        favoris = favoris.map(f => parseInt(f));

        const container = document.getElementById("offres-container");

        offres.forEach(offre => {
            const div = document.createElement("div");
            div.classList.add("offre");

            const offerId = parseInt(offre[ID_OFFRE]);
            const isFavori = favoris.includes(offerId);
            const buttonFavoris = isFavori ? "Retirer des favoris" : "Ajouter aux favoris";

            // Construct offer details with bootstrap styling
            let htmlContent = `
                <div class="details">
                    <p><strong>Entreprise :</strong> ${offre[FIELD_NAME]}</p>
                    <p><strong>Titulaire :</strong> ${offre[INTITULE]}</p>
                    <p><strong>Localisation :</strong> ${offre[LOCALISATION]}</p>
                </div>
            `;

            if (userType === "etudiant") {
                htmlContent += `
                
                    <form action='../Composant/tableauDeBord-be/favoris.php' method='POST' style="margin-top: 15px;">
                    <div class='submit'>
                        <input type='hidden' name='id_offre' value='${offerId}'>
                        <button type='submit'>${buttonFavoris}</button>
                        <a href='../view/homeOffre.php?id=${offerId}' class="details-link">Voir la description du poste</a>
                        </div>
                    </form>
                
                `;
            } else if (userType === "entreprise") {
                // For entreprise: just a styled link (like a button)
                htmlContent += `
                    <a href='../view/homeOffre.php?id=${offerId}' class="details-link button-link" style="margin-top: 15px;">
                        Voir l'offre
                    </a>
                `;
            }

            div.innerHTML = htmlContent;
            container.appendChild(div);
        });
    </script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
