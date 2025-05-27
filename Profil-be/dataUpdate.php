<?php
require_once('../db.php');
require_once('../fieldsNames.php');
require_once('../Composant/getId-update-etudiant.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [];

    if (isset($_POST[FIELD_NAME]) && $_POST[FIELD_NAME] !== '') {
        $value = mysqli_real_escape_string($conn, trim($_POST[FIELD_NAME]));
        $fields[] = "`" . FIELD_NAME . "` = '$value'";
    }

    if (isset($_POST[FIELD_PENOM]) && $_POST[FIELD_PENOM] !== '') {
        $value = mysqli_real_escape_string($conn, trim($_POST[FIELD_PENOM]));
        $fields[] = "`" . FIELD_PENOM . "` = '$value'";
    }

    if (isset($_POST[FIELD_CURSUS]) && $_POST[FIELD_CURSUS] !== '') {
        $value = mysqli_real_escape_string($conn, trim($_POST[FIELD_CURSUS]));
        $fields[] = "`" . FIELD_CURSUS . "` = '$value'";
    }

    if (isset($_POST[FIELD_APROPOS]) && $_POST[FIELD_APROPOS] !== '') {
        $value = mysqli_real_escape_string($conn, trim($_POST[FIELD_APROPOS]));
        $fields[] = "`" . FIELD_APROPOS . "` = '$value'";
    }

    if (!empty($fields)) {
        $query = "UPDATE `" . ETUDIANT . "` SET " . implode(', ', $fields) . " WHERE `" . ID . "` = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../view/profil.php?success=Modification réussie");
            exit();
        }
    } 
} else {
    header("Location: ../view/profil.php?error=BadRequest");
    exit;
}
?>