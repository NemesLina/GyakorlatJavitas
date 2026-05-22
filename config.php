<?php

$host = 'localhost';          
$db   = 'cukraszda_nel';      
$user = 'cukraszda_nel';      
$pass = 'Cukraszda2026!'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Sikertelen adatbázis kapcsolódás a Nethelyen: " . $e->getMessage());
}
?>