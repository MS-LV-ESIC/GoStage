<?php
require_once '../db.php';
require_once("../fieldsNames.php");

$id = "3"; // Replace with session or GET logic in production
$query = "SELECT * FROM " . ETUDIANT . " WHERE " . ID . " = '$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$image = $user[FIELD_IMAGE] ?? '';
$cv = $user[FIELD_CV] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        body { background-color:#D9D9D9; }
        tr { padding: 10px; color: black; display: flex; flex-direction: column; align-items: flex-start; width: 300px; }
        th { text-align: start; }
        h1 { padding:10px; }
        .profil { display:flex; }
        .photo { display:flex; }
        .uploadPhoto{display:flex; flex-direction:column}
        .post { display:flex; flex-direction: row; align-items: flex-start; }
        .aPropos { background-color:white; padding: 10px; }
    </style>
</head>
<body>

<div class="profil">
    <div>
        <div class="photo">
            <form class="uploadPhoto" id="updateImageForm" action="../Profil-be/imageUpdate.php" method="POST" enctype="multipart/form-data">
                <?php if (!empty($image)) : ?> 
                    <img src="<?php echo htmlspecialchars('../Profil-be/' . $image); ?>" alt="Photo de profil" width="250" height="250">
                <?php else : ?>
                    <img src="../Profil-be/image/default.png" alt="Photo de profil par défaut" width="250" height="250">
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

        <h1>Offres sauvegardées</h1>
        <div class="post">
            <img src="r.png" alt="">
            <div>
                <h3>Nom entreprise</h3>
                <p>Nom du poste</p>
            </div>
        </div>
    </div>

    <div class="aPropos">
        <h1>A propos de moi</h1>
        <form id="updateDataForm" action="../Profil-be/dataUpdate.php" method="POST">
            <th>
                <span id="label-<?php echo FIELD_APROPOS; ?>" onclick="showInput('<?php echo FIELD_APROPOS; ?>')">
                    A propos: <span id="<?php echo FIELD_APROPOS; ?>-value"></span>
                </span>
                <textarea name="<?php echo FIELD_APROPOS; ?>" id="<?php echo FIELD_APROPOS; ?>" style="display:none;" disabled maxlength="500" rows="10" cols="50"></textarea>
                <button type="submit" id="apply-<?php echo FIELD_APROPOS; ?>" style="display:none;" onclick="applyInput('<?php echo FIELD_APROPOS; ?>')">Appliquer</button>
            </th>
        </form>
        <p id="<?php echo FIELD_APROPOS; ?>-value"></p>
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