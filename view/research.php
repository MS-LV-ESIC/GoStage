<?php
// Page de connexion
session_start();
// Inclure le fichier de connexion à la base de données
require_once '../db.php';
require_once('../fieldsNames.php');
require_once('../Composant/header.php');

$motcle = isset($_GET['motcle']) ? trim($_GET['motcle']) : '';

if ($motcle) {
    // Requête avec LIKE pour une recherche partielle
    $sql = "SELECT * FROM offres WHERE intitule LIKE :motcle OR description LIKE :motcle";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['motcle' => '%' . $motcle . '%']);
    
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($resultats) {
        echo "<h2>Résultats pour : " . htmlspecialchars($motcle) . "</h2>";
        foreach ($resultats as $offre) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($offre['titre']) . "</h3>";
            echo "<p>" . htmlspecialchars($offre['description']) . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "Aucune offre trouvée pour : " . htmlspecialchars($motcle);
    }
} else {
    echo "Veuillez entrer un mot-clé.";
}


?>