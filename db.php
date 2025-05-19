<?php
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/'); // path to .env
$dotenv->load();
// print_r($_ENV);
//autentification
$host = $_ENV['HOST_IP_ADDRESS'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['USER'];
$password = $_ENV['PASSWORD'];


$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("connection échoué : " . mysqli_connect_error());
}else if($conn){
    die("connection a reussi ");
}

$conn-> close();
// echo json_encode($users);
?>