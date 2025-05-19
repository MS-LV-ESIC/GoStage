<?php
$host = 'localhost'; //'ip adress'pour server non local
$user = 'root'; //'root' pour ce connecter un utilisateur sql pour acceder a sql car root est une personne par défaut 
$password = ''; // root n'a pas de mot de passe
$db = 'mydb';

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("connection échoué : " . mysqli_connect_error());
}
?>