<?php
require_once('../db.php');
session_start();

if ($_SESSION['type'] === 'etudiant') {
    header('Location: ../view/profil.php');
    exit();
} elseif ($_SESSION['type'] === 'entreprise') {
    header('Location: ../view/profil-entreprise.php');
    exit();
} else {
    header('Location: ../view/profil-entreprise.php');
}
?>