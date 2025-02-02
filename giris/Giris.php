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
        }

        .header {
            background-color:rgb(15, 18, 74); /* Yeşil renk */
            color: white;
            text-align: center;
            padding: 7px 0;
            margin: 15px;
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
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 4px 8px rgba(105, 99, 99, 0.1);
            width: 300px;
            text-align: center;
        }
        .form-box h2 {
            margin-bottom: 20px;
        }
        .form-box label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .form-box input[type="text"],
        .form-box input[type="password"] {
            width: 100%;
            padding: 10px;
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
    </style>
</head>
<body>

    <div class="header">
        <h1>OTO SERVİS TAKİP SİSTEMİ</h1>
    </div>

    <div class="container">
        <div class="form-box">
            <h2>Admin Giriş</h2>
            <form action="" method="POST">
                <label for="admin-username">Kullanıcı Adı</label>
                <select name="role">
                    <option name="admin">Admin</option>
                    <option name="user">Kullanıcı</option>
                <label for="admin-password">Parola</label>
                <input type="password" id="admin-password" name="password" required>
                <button type="submit">Giriş</button>
            </form>
        </div>
    </div>
    
</body>
</html>
