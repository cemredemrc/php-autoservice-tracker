<?php
include 'db_baglanti.php'; 

$sql = "SELECT * FROM cari_kartlar";
$stmt = $pdo->query($sql);  
//veri çekme
$cariKartlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

//veri yollama
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alıyoruz
    $musteri_no = $_POST["musteri_no"];
    $yetkili_isim = $_POST["yetkili_isim"];
    $cari_hesap_kodu = $_POST["cari_hesap_kodu"];
    $vergi_no = $_POST["vergi_no"];
    $telefon = $_POST["telefon"];
    $email = $_POST["email"];
    $il = $_POST["il"];

    // Veritabanına veri eklemek 
    $sql = "INSERT INTO cari_kartlar (musteri_no, yetkili_isim, cari_hesap_kodu, vergi_no, telefon, email, il)
            VALUES (:musteri_no, :yetkili_isim, :cari_hesap_kodu, :vergi_no, :telefon, :email, :il)";
    
    $stmt = $pdo->prepare($sql);
    
    // sorguya bağlıyoruz
    $stmt->bindParam(':musteri_no', $musteri_no);
    $stmt->bindParam(':yetkili_isim', $yetkili_isim);
    $stmt->bindParam(':cari_hesap_kodu', $cari_hesap_kodu);
    $stmt->bindParam(':vergi_no', $vergi_no);
    $stmt->bindParam(':telefon', $telefon);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':il', $il);
    
    if ($stmt->execute()) {
        header("Location: anasayfa.html");
        exit;
    } else {
        echo "Veri eklenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kartlar</title>
    <link rel="stylesheet" href="./style/carikartlar.css">

<style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(243, 242, 242);
            margin: 0;
            padding: 0;
        }

        .cari-kartlar{
            position: relative;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #1E3A8A;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Form Başlığı */
        .add-cari h2 {
            font-size: 24px;
            color: #1E40AF;
            margin-bottom: 20px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus {
            border-color: #1E40AF;
            outline: none;
            box-shadow: 0 0 8px rgba(30, 64, 175, 0.4);
        }

        input::placeholder {
            color: #9CA3AF;
        }

        button[type="submit"] {
            background-color:rgb(6, 25, 94);
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color:rgb(62, 30, 221);
        }

        small {
            font-size: 12px;
            color: #6B7280;
        }

        p[style="color:#0a0"] {
            text-align: center;
            font-size: 18px;
            color:rgb(2, 2, 67);
            font-weight: bold;
        }
        .back-button{
            position:absolute;
            top: 20px;
            left: 40px;
            color:#1D4ED8;
            font-weight: 500;
            text-decoration: none;
        }
</style>

</head>
<body>
    <div class="cari-kartlar">
        <a href="anasayfa.html" class="back-button">< Geri</a>

        <nav class="navbar">
            <div class="container">
                <h1>Cari Kartlar | 
                    <?php 
                        if ($role === "admin") {
                            echo "Admin";
                        } elseif ($role === "user") {
                            echo "Kullanıcı";
                        }
                    ?>
                </h1>
            </div>
        </nav>

        <div class="container">
            <!-- Cari Kart Ekleme Form -->
            <?php if ($role === 'admin'): ?>
                <div class="add-cari">
                    <h2>Yeni Cari Kart Ekle</h2>
                    <form action="" method="POST">
                        <div>
                            <label for="musteri_no">Müşteri No:</label>
                            <input type="text" id="musteri_no" name="musteri_no" required maxlength="50" placeholder="Müşteri numarasını girin">
                        </div>
                    
                        <div>
                            <label for="yetkili_isim">Yetkili İsim:</label>
                            <input type="text" id="yetkili_isim" name="yetkili_isim" required maxlength="100" placeholder="Yetkili ismini girin">
                        </div>
                    
                        <div>
                            <label for="cari_hesap_kodu">Cari Hesap Kodu:</label>
                            <input type="text" id="cari_hesap_kodu" name="cari_hesap_kodu" required maxlength="50" placeholder="Cari hesap kodunu girin">
                        </div>
                    
                        <div>
                            <label for="vergi_no">Vergi No:</label>
                            <input type="text" id="vergi_no" name="vergi_no" required maxlength="50" placeholder="Vergi numarasını girin">
                        </div>
                    
                        <div>
                            <label for="telefon">Telefon Numarası:</label>
                            <input type="tel" id="telefon" name="telefon" required pattern="^\+?\d{1,3}[-.\s]?\(?\d{1,4}?\)?[-.\s]?\d{3}[-.\s]?\d{4}$" maxlength="15" placeholder="Telefon numarasını girin">
                        </div>
                    
                        <div>
                            <label for="email">E-Mail:</label>
                            <input type="email" id="email" name="email" required placeholder="E-mail adresinizi girin">
                        </div>
                    
                        <div>
                            <label for="il">İl:</label>
                            <input type="text" id="il" name="il" required maxlength="100" placeholder="Yaşadığınız ili girin">
                        </div>
                
                    
                        <!-- Submit Button -->
                        <div>
                            <button type="submit">Müşteri Ekle</button>
                        </div>
                    </form>
                    
                </div>
            <?php endif; 
            ?>

            <!-- Cari Kartlar Tablo -->
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Müşteri No</th>
                            <th>Yetkili İsim</th>
                            <th>Cari Hesap Kodu</th>
                            <th>Vergi Numarası</th>
                            <th>Telefon</th>
                            <th>Email</th>
                            <th>İl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($cariKartlar) {
                            foreach ($cariKartlar as $kart) {
                                echo "<tr>";
                                echo "<td>" . $kart['musteri_no'] . "</td>";
                                echo "<td>" . $kart['yetkili_isim'] . "</td>";
                                echo "<td>" . $kart['cari_hesap_kodu'] . "</td>";
                                echo "<td>" . $kart['vergi_no'] . "</td>";
                                echo "<td>" . $kart['telefon'] . "</td>";
                                echo "<td>" . $kart['email'] . "</td>";
                                echo "<td>" . $kart['il'] . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Veri bulunamadı.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
