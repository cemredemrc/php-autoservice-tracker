<?php
session_start();

$host = "localhost";
$veritabani = "otoservis";
$kullanici = "root";
$sifre = "";
$charset = "utf8mb4";
$role = $_SESSION['role'] ?? null;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$veritabani;charset=$charset", $kullanici, $sifre);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Veritabanı bağlantısı hatası: " . $e->getMessage();
    exit;
}
?>