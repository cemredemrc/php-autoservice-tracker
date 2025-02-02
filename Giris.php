<?php
session_start(); 


$admin_password = "1";
$user_password = "1234";
$isError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role']; // Rol (admin veya user)
    $password = $_POST['password'];

    // Admin kontrolü
    if ($role === "Admin" && $password === $admin_password) {
        $isError = "";
        $_SESSION['role'] = 'admin'; // Admin rolü atanır
        header("Location: anasayfa.html"); // Admin sayfasına yönlendirilir
        exit();
    }
    // Kullanıcı kontrolü
    elseif ($role === "Kullanıcı" && $password === $user_password) {
        $isError = "";
        $_SESSION['role'] = 'user'; // Kullanıcı rolü atanır
        header("Location: anasayfa.html"); // Kullanıcı sayfasına yönlendirilir
        exit();
    } else {
        $isError = "Geçersiz şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            flex-direction: column; /* Dikey sıralama */
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-top: 40px;
        }
        .header {
            background-color:rgb(15, 18, 74); /* Yeşil renk */
            color: white;
            text-align: center;
            padding: 7px 0;
            margin: 15px;
            margin-bottom: 40px;
            width: 100%;
            max-width: 600px; /* Maksimum genişlik */
            border-radius:17px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .form-box {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0px 4px 8px rgba(105, 99, 99, 0.1);
            width: 500px;
            padding-bottom: 30px;
            text-align: center;
        }
        .form-box form{
            width: 200px;
            margin: 0 auto;
        }
        .form-box h2 {
            margin-bottom: 20px;
        }
        .form-box label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .form-box select,
        .form-box input[type="password"] {
            width: 100%;
            padding: 10px 0;            
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-box button {
            padding: 10px 20px;
            border: none;
            background-color:rgb(15, 18, 74);
            color: white;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin: 20px 0;
        }
        .form-box button:hover {
            background-color:rgb(134, 139, 232);
        }
        .form-box a {
            display: block;
            margin-top: 8px;
            text-decoration: none;
            color:rgb(134, 139, 232);
        }
        .form-box a:hover {
            text-decoration: underline;
        }
        .form-box .error{
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>OTO SERVİS TAKİP SİSTEMİ</h1>
    </div>

    <div class="container">
        <div class="form-box">
            <h2>Giriş</h2>
            <form action="" method="POST">
                <label for="role">Kullanıcı Türü</label>
                <select name="role" id="role" required>
                    <option value="Admin">Admin</option>
                    <option value="Kullanıcı">Kullanıcı</option>
                </select>
                <br>
                <label for="password">Parola</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit">Giriş</button>
            </form>
            <span class="error"><?php echo $isError ?></span>
        </div>
    </div>
</body>
</html>
