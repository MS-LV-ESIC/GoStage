<?php
require_once 'db.php';
 
//  requête pour avoir tous les utilisateurs
$query = "Select * FROM utilisateurs";
$result = mysqli_query($conn, $query);
?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Projet Piscine</title>
</head>
 
<body>
    <h1>Bienvenue sur la page d'accueil</h1>
    <p>Vous êtes connecté</p>
    <p>Voici la liste des utilisateurs :</p>
    <table>
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // mysqli_fetch_assoc() renvoie un tableau associatif représentant la ligne de résultat
            // ou FALSE si aucune ligne n'est trouvée
            // tant qu'il y a des lignese à lire, on continue
            while($row=mysqli_fetch_assoc($result)) {
                echo "<tr>";
                // echo "<td>" . htmlspecialchars( $row["idUtilisateur"] ) ."</td>";
                echo "<td>" . htmlspecialchars( $row["nom"] ) ."</td>";
                echo "<td>" . htmlspecialchars( $row["prenom"] ) ."</td>";
                echo "<td>" . htmlspecialchars( $row["email"] ) ."</td>";
                echo "<tr>";
            }
            ?>
            <button onclick="location.href='profil.php'">

            </button>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>
 
</html>
 