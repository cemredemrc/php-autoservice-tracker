<?php
include 'db_baglanti.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();

    if ($query->rowCount() > 0) {
        header("Location: anasayfa.html"); // Admin girişi başarılı, yönlendirme
        exit();
    } else {
        echo "<script>alert('Kullanıcı adı veya şifre hatalı!');</script>";
        echo "<script>window.location.href = 'Giris.php';</script>";
    }
}
?>
