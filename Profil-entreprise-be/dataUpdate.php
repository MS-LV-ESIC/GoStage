<?php
require_once('../db.php');
require_once('../fieldsNames.php');
$logFile = __DIR__ . '/execution_log.txt';
require_once('../Composant/getId-update-entreprise.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [];

    if (isset($_POST[FIELD_NAME]) && $_POST[FIELD_NAME] !== '') {
        $value = mysqli_real_escape_string($conn, trim($_POST[FIELD_NAME]));
        $fields[] = "`" . FIELD_NAME . "` = '$value'";
    }

    if (isset($_POST[FIELD_APROPOS_ENTREPRISE]) && $_POST[FIELD_APROPOS_ENTREPRISE] !== '') {
        $value = mysqli_real_escape_string($conn, trim($_POST[FIELD_APROPOS_ENTREPRISE]));
        $fields[] = "`" . FIELD_APROPOS_ENTREPRISE . "` = '$value'";
    }

    if (!empty($fields)) {
        $query = "UPDATE `" . ENTREPRISE . "` SET " . implode(', ', $fields) . " WHERE `" . ID_ENTREPRISE . "` = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../view/profil-entreprise.php?success=Modification réussie");
            exit();
        } else {
            $error = mysqli_error($conn);
            header("Location: ../view/profil-entreprise.php?success=Modification non reussi");
            exit();
        }
    } 
} else {
    header("Location: ../view/profil-entreprise.php?error=BadRequest");
    exit;
}
?>