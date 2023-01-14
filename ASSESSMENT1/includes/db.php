<?php 
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$database = "naxum1";

$con = '';

try {

    $con = new PDO("mysql:host={$host};dbname={$database}", $user,$pass );
} catch (PDOException $e) {
   echo $e->getMessage();
}


?>