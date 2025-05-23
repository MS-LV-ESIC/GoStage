<?php
require_once '../db.php';

// Example: get user by email (replace with your logic)
$id = "3"; // Or from $_SESSION, $_GET, etc.
$query = "SELECT * FROM utilisateurs WHERE id = '$id'";

$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$image = $user['image'];
$cv = $user['cv'] ?? '';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            background-color:#D9D9D9;
        }
        table{
        }
        tr{    /* to change remove the point . */
            padding: 10px;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 300px;
        }
        th{
            text-align:start
        }
        h1 {
            padding:10px
        }
        .profil{
            display:flex
        }
        .photo{
            display:flex;
        }
        .post{
            display:flex;
            flex-direction: row;
            align-items: flex-start;
        }

        .aPropos{
            background-color:white;
            padding: 10px;
        }
    </style>
</head>
<body>



    <div class="profil">
        <div>
            <div class="photo">
                
                <form id="updateImageForm" action="./Back-end/imageUpdate.php" method="POST" enctype="multipart/form-data"> <!-- ✅ Corrected 'multipart' -->
                        <!-- //si il y a une photo de profil dans le dossier image il va mettre cette image  -->
                        <?php if (!empty($image)) : ?> 
                            <img src="<?php echo htmlspecialchars('./Back-end/' . $image); ?>" alt="Photo de profil" width="250" height="250">
                        <?php else : ?>
                        <!-- //si il n'y a pas de photo de profil il va mettre un image default -->
                            <img src="Back-end/image/default.png" alt="Photo de profil par défaut" width="250" height="250">
                        <?php endif; ?>
                        
                         <input type="file" name="image" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary">Changer la photo</button>

                </form>

                <div>
                    <h1>Mon Profil</h1>
                    <form id="updateDataForm" action="./Back-end/dataUpdate.php" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <span id="label-nom" onclick="showInput('nom')">Nom: <span id="nom-value"></span></span>
                                        <input 
                                            type="text" 
                                            name="nom" 
                                            id="nom" 
                                            style="display:none;" 
                                            disabled
                                            maxlength="255"
                                            >
                                        <button 
                                            type="submit" 
                                            id="apply-nom" 
                                            style="display:none;" 
                                            onclick="applyInput('nom')"
                                            >
                                            Appliquer
                                        </button>
                                    </th>

                                    <th>
                                        <span id="label-prenom" onclick="showInput('prenom')">Prenom: <span id="prenom-value"></span></span>
                                        <input 
                                            type="text" 
                                            name="prenom" 
                                            id="prenom" 
                                            style="display:none;" 
                                            disabled
                                            maxlength="255"
                                            >
                                        <button 
                                            type="submit" 
                                            id="apply-prenom" 
                                            style="display:none;" 
                                            onclick="applyInput('prenom')"
                                            >
                                            Appliquer
                                        </button>
                                    </th>
                                    <th>
                                        <span>Email: <span id="email-value"></span></span>
                                    </th>
                                    <th>
                                        <span id="label-cursus" onclick="showInput('cursus')">Nom du cursus: <span id="cursus-value"></span></span>
                                        <input 
                                            type="text" 
                                            name="cursus" 
                                            id="cursus" 
                                            style="display:none;" 
                                            disabled
                                            maxlength="255"
                                        >
                                        <button 
                                            type="submit" 
                                            id="apply-cursus" 
                                            style="display:none;" 
                                            onclick="applyInput('cursus')"
                                            >
                                            Appliquer
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                    <form id="updateCvForm" action="./Back-end/cvUpdate.php" method="POST" enctype="multipart/form-data">
                        <!-- //si il y a une photo de profil dans le dossier image il va mettre cette image  -->
                         <!-- <h4>CV :</h4> -->
                        <?php if (!empty($cv)) : ?> 
                            <p src="<?php echo htmlspecialchars('./Back-end/' . $cv); ?>" alt="CV">CV :</p>
                        <?php endif; ?>
                         <input type="file" name="cv" class="form-control mb-2">

                    <button type="submit">Mettre a jour le CV</button>
                    <?php if (!empty($cv)) : ?>
                        <a href="<?php echo './Back-end/' . htmlspecialchars($cv); ?>" download>
                            <button type="button">Télécharger le CV</button>
                        </a>
                    <?php endif; ?>

                    </form>

                    
                </div>
            </div>
            <h1>Offre sauvgarder</h1>
            <div class="post">
                <img src="r.png" alt="">
                <div >
                    <h3>Nom entreprise</h3>
                    <p>Nome du poste</p>
                </div>
            </div>
        </div>

        <div class="aPropos">
            <h1>A propos de moi</h1>
            <form id="updateDataForm" action="./Back-end/dataUpdate.php" method="POST">
                <th>
                    <span id="label-aPropos" onclick="showInput('aPropos')">aPropos: <span id="aPropos-value"></span></span>
                    <textarea  
                        name="aPropos" 
                        id="aPropos" 
                        style="display:none;" 
                        disabled 
                        maxlength="500" 
                        rows="10" 
                        cols="50"
                        ></textarea>
                    <button 
                        type="submit" 
                        id="apply-aPropos" 
                        style="display:none;" 
                        onclick="applyInput('aPropos')"
                        >
                        Appliquer
                    </button>
                </th>
            </form>
            <p id="aPropos-value"></p>
        </div>
    </div>

    
</body>
</html>
<script>
document.querySelector('form').addEventListener('submit', function() {
    document.querySelectorAll('input').forEach(function(input) {
        input.disabled = false;
    });
});


['nom', 'prenom'].forEach(function(field) {
    document.getElementById(field).addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ' ]/g, '');
    });
});

//Verfifie si il y a des valeur dans les input , si non il y a une erreure qui va sortir qui va dire que il ny a pas de valeur dans l'input
document.querySelector('#updateDataForm').addEventListener('submit', function(e) {
    // Check if at least one field is not empty
    let hasValue = false;
    ['nom', 'prenom', 'cursus'].forEach(function(field) {
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

let user = <?php  echo json_encode($user); ?>

document.getElementById('nom-value').textContent = user.nom;
document.getElementById('prenom-value').textContent = user.prenom;
document.getElementById('email-value').textContent = user.email;
document.getElementById('cursus-value').textContent = user.cursus;
document.getElementById('aPropos-value').textContent = user.aPropos;

function showInput(field) {
    document.getElementById('label-' + field).style.display = 'none';
    var input = document.getElementById(field);
    input.style.display = 'inline';
    input.disabled = false;
    input.value = user[field]; // Pre-fill with current value
    input.focus();
    document.getElementById('apply-' + field).style.display = 'inline';
}

function applyInput(field) {
    var input = document.getElementById(field);

    user[field] = input.value; // Update user object
    document.getElementById(field + '-value').textContent = input.value; // Update label
    input.style.display = 'none';
    // input.disabled = true;
    document.getElementById('apply-' + field).style.display = 'none';
    document.getElementById('label-' + field).style.display = 'inline';
}



</script>