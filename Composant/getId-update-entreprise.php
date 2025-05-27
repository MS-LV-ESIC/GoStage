<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email']) || $_SESSION['type'] !== 'entreprise') {
    header("Location: ../connexion.php");
    exit();
}
require_once '../db.php'; 
$email = $_SESSION['email'];

$email_escaped = mysqli_real_escape_string($conn, $email);
$id_query = "SELECT id_entreprise FROM entreprises WHERE mail = '$email_escaped'";
$id_result = mysqli_query($conn, $id_query);

if ($id_row = mysqli_fetch_assoc($id_result)) {
    $id = $id_row['id_entreprise'];
}
return $id;
?>