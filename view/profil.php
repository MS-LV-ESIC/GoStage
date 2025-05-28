<?php
require_once '../db.php';
require_once("../fieldsNames.php");
require_once('../Composant/header.php');
session_start();

if (!isset($_SESSION['email']) || $_SESSION['type'] !== 'etudiant') {
    header("Location: connexion.php");
    exit();
}

// ✅ Get the dynamic student ID from component
$id_etudiant = include('../Composant/getId-update-etudiant.php');

// ✅ Now get student info
$query = "SELECT * FROM etudiants WHERE id_etudiant = '$id_etudiant'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erreur SQL : " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);
$image = $user[FIELD_IMAGE] ?? '';
$cv = $user[FIELD_CV] ?? '';
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
    <title>Profil</title>
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


        #updateImageForm .form-control {
            background-color: var(--bs-body-bg, #fff);
            color: var(--bs-body-color, #212529);
            border: var(--bs-border-width, 1px) solid var(--bs-border-color, #dee2e6);
            border-radius: var(--bs-border-radius, 0.375rem);
            padding: .375rem .75rem;
            font-size: 1rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            max-width: 220px
        }
        .uploadPhoto{
            margin-right:16px;
        }

        .profil {
            display: flex;
        }


        .info {
            width: 45%;
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
            width: 50%;
            padding: 2%;
            margin-left: 48%;
            padding-bottom: 60%;
        }
    </style>
</head>
<body>

<div class="profil">
    <div class="info">
        <div class="photo">
<!-- IMAGE -->
            <form class="uploadPhoto" id="updateImageForm" action="../Profil-be/imageUpdate.php" method="POST" enctype="multipart/form-data">
                <?php if (!empty($image)) : ?> 
                    <img src="<?php echo htmlspecialchars('../Profil-be/' . $image); ?>" alt="Photo de profil" width="220" height="220">
                    <?php else : ?>
                    <img src="../Profil-be/image/default.png" alt="Photo de profil par défaut" width="220" height="220">
                <?php endif; ?>
                <input type="file" name="<?php echo FIELD_IMAGE; ?>" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Changer la photo</button>
            </form>

            <div>
                <h1>Mon Profil</h1>
                <form id="updateDataForm" action="../Profil-be/dataUpdate.php" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <span id="label-<?php echo FIELD_NAME; ?>" onclick="showInput('<?php echo FIELD_NAME; ?>')">
                                        Nom: <span id="<?php echo FIELD_NAME; ?>-value"></span>
                                    </span>
                                    <input type="text" name="<?php echo FIELD_NAME; ?>" id="<?php echo FIELD_NAME; ?>" style="display:none;" disabled maxlength="255">
                                    <button type="submit" id="apply-<?php echo FIELD_NAME; ?>" style="display:none;" onclick="applyInput('<?php echo FIELD_NAME; ?>')">Appliquer</button>
                                </th>

                                <th>
                                    <span id="label-<?php echo FIELD_PENOM; ?>" onclick="showInput('<?php echo FIELD_PENOM; ?>')">
                                        Prénom: <span id="<?php echo FIELD_PENOM; ?>-value"></span>
                                    </span>
                                    <input type="text" name="<?php echo FIELD_PENOM; ?>" id="<?php echo FIELD_PENOM; ?>" style="display:none;" disabled maxlength="255">
                                    <button type="submit" id="apply-<?php echo FIELD_PENOM; ?>" style="display:none;" onclick="applyInput('<?php echo FIELD_PENOM; ?>')">Appliquer</button>
                                </th>

                                <th>
                                    <span>Email: <span id="email-value"></span></span>
                                </th>

                                <th>
                                    <span id="label-<?php echo FIELD_CURSUS; ?>" onclick="showInput('<?php echo FIELD_CURSUS; ?>')">
                                        Cursus: <span id="<?php echo FIELD_CURSUS; ?>-value"></span>
                                    </span>
                                    <input type="text" name="<?php echo FIELD_CURSUS; ?>" id="<?php echo FIELD_CURSUS; ?>" style="display:none;" disabled maxlength="255">
                                    <button type="submit" id="apply-<?php echo FIELD_CURSUS; ?>" style="display:none;" onclick="applyInput('<?php echo FIELD_CURSUS; ?>')">Appliquer</button>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </form>
<!-- CV -->
                <form id="updateCvForm" action="../Profil-be/cvUpdate.php" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($cv)) : ?> 
                        <p>CV: <?php echo basename($cv); ?></p>
                    <?php endif; ?>
                    <input type="file" name="<?php echo FIELD_CV; ?>" class="form-control mb-2">
                    <button type="submit">Mettre à jour le CV</button>
                    <?php if (!empty($cv)) : ?>
                        <a href="<?php echo '../Profil-be/' . htmlspecialchars($cv); ?>" download>
                            <button type="button">Télécharger le CV</button>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

<!-- A Propos -->
        <h1>A propos de moi</h1>
        <div class="post">
            <form id="updateDataForm" action="../Profil-be/dataUpdate.php" method="POST">
                <th>
                    <span id="label-<?php echo FIELD_APROPOS; ?>" onclick="showInput('<?php echo FIELD_APROPOS; ?>')">
                        A propos: <span id="<?php echo FIELD_APROPOS; ?>-value"></span>
                    </span>
                    <textarea name="<?php echo FIELD_APROPOS; ?>" id="<?php echo FIELD_APROPOS; ?>" style="display:none;" disabled maxlength="500" rows="5" cols="50"></textarea>
                    <button type="submit" id="apply-<?php echo FIELD_APROPOS; ?>" style="display:none;" onclick="applyInput('<?php echo FIELD_APROPOS; ?>')">Appliquer</button>
                </th>
            </form>
        <p id="<?php echo FIELD_APROPOS; ?>-value"></p>
        </div>
    </div>

    <div class="Offre">
        <h1>Offre sauvegarder</h1>
        <?php 
            $id_etudiant = include('../Composant/getId-update-etudiant.php');
            $component_mode = 'etudiant';
            $showOnlyFavorites = true;
            include("../composant/tableauDeBord.php")
        ?>
        <p id="Offre-value"></p>
    </div>
</div>

<?php
require('../Composant/footer.php');
?>

<script>
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
        form.querySelectorAll('input, textarea').forEach(function(input) {
            input.disabled = false;
        });
    });
});

['<?php echo FIELD_NAME; ?>', '<?php echo FIELD_PENOM; ?>'].forEach(function(field) {
    document.getElementById(field).addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ' ]/g, '');
    });
});

document.querySelector('#updateDataForm').addEventListener('submit', function(e) {
    let hasValue = false;
    ['<?php echo FIELD_NAME; ?>', '<?php echo FIELD_PENOM; ?>', '<?php echo FIELD_CURSUS; ?>'].forEach(function(field) {
        let input = document.getElementById(field);
        if (input && input.value.trim() !== "") {
            hasValue = true;
        }
    });
    if (!hasValue) {
        e.preventDefault();
        alert("Veuillez remplir au moins un champ avant de valider.");
    }
});

let user = <?php echo json_encode($user); ?>;

document.getElementById('<?php echo FIELD_NAME; ?>-value').textContent = user["<?php echo FIELD_NAME; ?>"];
document.getElementById('<?php echo FIELD_PENOM; ?>-value').textContent = user["<?php echo FIELD_PENOM; ?>"];
document.getElementById('email-value').textContent = user["<?php echo FIELD_EMAIL; ?>"];
document.getElementById('<?php echo FIELD_CURSUS; ?>-value').textContent = user["<?php echo FIELD_CURSUS; ?>"];
document.getElementById('<?php echo FIELD_APROPOS; ?>-value').textContent = user["<?php echo FIELD_APROPOS; ?>"];

function showInput(field) {
    document.getElementById('label-' + field).style.display = 'none';
    let input = document.getElementById(field);
    input.style.display = 'inline';
    input.disabled = false;
    input.value = user[field];
    input.focus();
    document.getElementById('apply-' + field).style.display = 'inline';
}

function applyInput(field) {
    let input = document.getElementById(field);
    user[field] = input.value;
    document.getElementById(field + '-value').textContent = input.value;
    input.style.display = 'none';
    document.getElementById('apply-' + field).style.display = 'none';
    document.getElementById('label-' + field).style.display = 'inline';
}
</script>

</body>
</html>