<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'bts1piscine';

    $conn = mysqli_connect($host, $user, $password, $db);

    if (!$conn) {
        die("Connection échouée : " . mysqli_connect_error());
    }

?>