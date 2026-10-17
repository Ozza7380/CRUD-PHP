<?php
//config.php
$host = '127.0.0.1';
$port = '3306';
$db = 'belajar_php';
$user = '';
$pass = '';

try {
    $pdo = new PDO("mysql:host=;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAtributr(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOexception $e) {
    die("Koneksi gagal: ". $e->getMessage());
}

session_start();
?>