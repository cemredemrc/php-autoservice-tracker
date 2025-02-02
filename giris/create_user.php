<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Oluştur</title>
    <style>
        /* Genel Sayfa Stili */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5; /* Hafif gri arka plan */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff; /* Beyaz form kutusu */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hafif gölge */
            width: 400px;
            text-align: center;
        }

        .form-container h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-container label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #555;
        }

        .form-container input {
            width: calc(100% - 40px); /* İkon için alan */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            padding-left: 40px; /* İkon için iç boşluk */
            position: relative;
        }

        .form-container .icon {
            position: absolute;
            margin-left: 10px;
            margin-top: -40px;
            color: #888;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color:rgb(15, 18, 74);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color:rgb(134, 139, 232);
        }

        .form-container .link {
            margin-top: 15px;
            font-size: 14px;
            color:rgb(15, 18, 74);
            text-decoration: none;
            display: inline-block;
        }

        .form-container .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Kullanıcı Oluştur</h2>
        <form action="save_user.php" method="POST">
            <label for="username">Kullanıcı Adı</label>
            <div>
                <input type="text" id="username" name="username" placeholder="Kullanıcı adınızı giriniz" required>
            </div>
            <label for="password">Parola 🔑</label>
            <div>
                <input type="password" id="password" name="password" placeholder="Parolanızı giriniz" required>
            </div>
            <button type="submit">Giriş</button>
        </form>
</body>
</html>
