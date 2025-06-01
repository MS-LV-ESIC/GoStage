<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'gostage_database';

    $conn = mysqli_connect($host, $user, $password, $db);

    if (!$conn) {
        die("Connection échouée : " . mysqli_connect_error());
    }

?>