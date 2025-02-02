<?php
include('db_baglanti.php');  // Veritabanı bağlantısını dahil et

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Parolayı hash'leme
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Kullanıcıyı veritabanına kaydetme
    try {
        // Kullanıcı adının zaten var olup olmadığını kontrol et
        $stmt = $conn->prepare("SELECT * FROM kullanici WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Eğer kullanıcı adı zaten varsa, hata mesajı ver
        if ($stmt->rowCount() > 0) {
            echo "Bu kullanıcı adı zaten alındı!";
        } else {
            // Kullanıcıyı veritabanına kaydet
            $stmt = $conn->prepare("INSERT INTO kullanici (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);  // Hash'lenmiş parolayı kullan
            $stmt->execute();

            // Kullanıcı başarıyla kaydedildiği mesajını göster
            echo "Kullanıcı başarıyla kaydedildi!";

            // 2 saniye sonra giriş.php sayfasına yönlendir
            header("Refresh: 2; url=giris.php");
            exit();  // Yönlendirmeden sonra kodun çalışmaması için exit()
        }
    } catch (PDOException $e) {
        // Hata mesajını göster
        echo "Hata: " . $e->getMessage();
    }
}
?>
