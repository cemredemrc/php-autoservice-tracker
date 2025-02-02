<?php
include('db_baglanti.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Kullanıcıyı veritabanında ara
        $stmt = $conn->prepare("SELECT * FROM kullanici WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Şifre doğrulama (tuzlama örneği)
            $hashedPassword = password_hash($password . $user['salt'], PASSWORD_DEFAULT); // Eğer tuzlama kullanıyorsanız

            if (password_verify($password, $user['password'])) {
                // Şifre doğru ise oturum aç ve dashboard'a yönlendir
                session_start();
                $_SESSION['user_id'] = $user['id']; // Örnek oturum değişkeni
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Kullanıcı adı veya şifre yanlış.";
            }
        } else {
            echo "Kullanıcı bulunamadı.";
        }
    } catch (PDOException $e) {
        echo "Bir hata oluştu: " . $e->getMessage();
    }
}