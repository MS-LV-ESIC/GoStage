<?php
require_once '../db.php';
require_once("../fieldsNames.php");
require_once('../Composant/header.php');

session_start();

if (!isset($_SESSION['email']) || $_SESSION['type'] !== 'entreprise') {
    header("Location: connexion.php");
    exit();
}

// ✅ Get dynamic entreprise ID
$idEntreprise = include('../Composant/getId-update-entreprise.php');
$_SESSION['id_entreprise'] = $idEntreprise;

// ✅ Fetch entreprise details
$query = "SELECT * FROM " . ENTREPRISE . " WHERE " . ID_ENTREPRISE . " = '$idEntreprise'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erreur SQL : " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);
$image = $user[FIELD_IMAGE] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .AjouteOffre{
            margin:20px
        }
    </style>
</head>
<body>

<div class="profil">
    <div class="info">
        <div class="photo">

            <form class="uploadPhoto" id="updateImageForm" action="../Profil-entreprise-be/imageUpdate.php" method="POST" enctype="multipart/form-data">
                <?php if (!empty($image)) : ?> 
                    <img src="<?php echo htmlspecialchars('../Profil-entreprise-be/' . $image); ?>" alt="Photo de profil" width="250" height="250">
                <?php else : ?>
                    <img src="../Profil-entreprise-be/image/default.png" alt="Photo de profil par défaut" width="250" height="250">
                <?php endif; ?>
                <input type="file" name="<?php echo FIELD_IMAGE; ?>" class="form-control mb-2">
                <button type="submit" class="btn btn-primary">Changer la photo</button>
            </form>



            <div>
                <h1>Profil</h1>
                <!-- updateDataForm Permet de modifier la les information sur l'entreprise -->
                <form id="updateDataForm" action="../Profil-entreprise-be/dataUpdate.php" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <span 
                                        id="label-<?php echo FIELD_NAME; ?>" 
                                        onclick="showInput('<?php echo FIELD_NAME; ?>')">Nom: 
                                        <span id="<?php echo FIELD_NAME; ?>-value"></span>
                                    </span>
                                    <input 
                                        type="text" 
                                        name="<?php echo FIELD_NAME; ?>" 
                                        id="<?php echo FIELD_NAME; ?>" 
                                        style="display:none;" 
                                        disabled 
                                        maxlength="255"
                                        >
                                    <button 
                                        type="submit" 
                                        id="apply-<?php echo FIELD_NAME; ?>" 
                                        style="display:none;" 
                                        onclick="applyInput('<?php echo FIELD_NAME; ?>')"
                                        >
                                        Appliquer
                                    </button>
                                </th>

                                <th>
                                    <span>Email: <span id="email-value"></span></span>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>



        </div>

            <h1>A propos de Nous</h1>
            <div class="post">
                <form 
                    id="updateDataForm" 
                    action="../Profil-entreprise-be/dataUpdate.php" 
                    method="POST">
                    <th>
                        <span 
                            id="label-<?php echo FIELD_APROPOS_ENTREPRISE; ?>" 
                            onclick="showInput('<?php echo FIELD_APROPOS_ENTREPRISE; ?>')">
                            <span id="<?php echo FIELD_APROPOS_ENTREPRISE; ?>-value"></span>
                        </span>
                        <textarea 
                            name="<?php echo FIELD_APROPOS_ENTREPRISE; ?>" 
                            id="<?php echo FIELD_APROPOS_ENTREPRISE; ?>" 
                            style="display:none;" 
                            disabled 
                            maxlength="500" 
                            rows="2" 
                            cols="70"
                            ></textarea>
                        <button 
                            type="submit" 
                            id="apply-<?php echo FIELD_APROPOS_ENTREPRISE; ?>" 
                            style="display:none;" 
                            onclick="applyInput('<?php echo FIELD_APROPOS_ENTREPRISE; ?>')"
                            >Appliquer</button>
                    </th>
                </form>
            </div>
        </div>   
    </div>
    
    <div class="Offre">
        <h1>Nos Offres</h1>
        <form class="AjouteOffre" action="ajoutOffres.php" method="post">
                <button type="submit" class="btn btn-primary">Ajouter une offre</button>
        </form>
        <?php 
            $id_entreprise = include('../Composant/getId-update-entreprise.php');
            $component_mode = 'entreprise';
            include("../composant/tableauDeBord.php");
        ?>
        <p id="Offre-value"></p>
    </div>
</div>

<script>
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
        form.querySelectorAll('input, textarea').forEach(function(input) {
            input.disabled = false;
        });
    });
});

['<?php echo FIELD_NAME; ?>'].forEach(function(field) {
    document.getElementById(field).addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ' ]/g, '');
    });
});

document.querySelector('#updateDataForm').addEventListener('submit', function(e) {
    let hasValue = false;
    ['<?php echo FIELD_NAME; ?>'].forEach(function(field) {
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
document.getElementById('email-value').textContent = user["<?php echo FIELD_EMAIL; ?>"];
document.getElementById('<?php echo FIELD_APROPOS_ENTREPRISE; ?>-value').textContent = user["<?php echo FIELD_APROPOS_ENTREPRISE; ?>"] || "Cliquez ici pour ajouter une description...";

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
<?php
require_once ('../Composant/footer.php')
?>