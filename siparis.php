<?php
include 'db_baglanti.php'; 

$sql = "SELECT * FROM siparisler";
$stmt = $pdo->query($sql);  
//veri çekme
$siparisler = $stmt->fetchAll(PDO::FETCH_ASSOC);

//veri yollama
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alıyoruz
    $number = $_POST["number"];
    $cari_hesap_kodu = $_POST["cari_hesap_kodu"];
    $genel_toplam = $_POST["genel_toplam"];
    $siparis_tarihi = $_POST["siparis_tarihi"];

    // Veritabanına veri eklemek için parametreli SQL sorgusu
    $sql = "INSERT INTO siparisler (number, cari_hesap_kodu, genel_toplam, siparis_tarihi)
            VALUES (:number, :cari_hesap_kodu, :genel_toplam, :siparis_tarihi)";
    
    // PDO ile hazırlanan sorguyu çalıştırıyoruz
    $stmt = $pdo->prepare($sql);
    
    // Parametreleri sorguya bağlıyoruz
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':cari_hesap_kodu', $cari_hesap_kodu);
    $stmt->bindParam(':genel_toplam', $genel_toplam);
    $stmt->bindParam(':siparis_tarihi', $siparis_tarihi);
    
    if ($stmt->execute()) {
        header("Location: anasayfa.html");
        exit;
    } else {
        echo "Veri eklenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Sayfası</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(243, 242, 242);
        }

        header {
            background-color: #042744;
            color: white;
            padding: 10px;
            text-align: center;
            position: relative;
        }

        .back-button{
            position:absolute;
            top: 20px;
            left: 40px;
            color:#fff;
            font-weight: 500;
            text-decoration: none;
        }

        /* .filter-section {
            display: flex;
            gap: 15px;
            padding: 15px;
            background-color:rgb(97, 68, 68);
            border-bottom: 1px solid #ccc;
        } */

        .filter-section label {
            font-weight: bold;
            margin-right: 5px;
        }

        .filter-section input, .filter-section select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .main-content {
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color:rgb(191, 191, 191);
        }

        /* .totals-section {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: #e7e7e7;
            border-top: 1px solid #ccc;
        } */

        .totals-section div {
            font-weight: bold;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions button {
            padding: 10px 20px;
            border: none;
            background-color: #053b68;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .actions button:hover {
            background-color: #316994;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 60px;
            border-radius: 5px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .modal-content h2 {
            margin-bottom: 15px;
        }

        .modal-content label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .modal-content input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-content button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-content .save {
            background-color: #28a745;
            color: white;
        }

        .modal-content .cancel {
            background-color: #dc3545;
            color: white;
        }

        .modal-content button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <header>
        <a href="anasayfa.html" class="back-button">< Geri</a>

        <h1>Sipariş Sayfası | 
            <?php 
                if ($role === "admin") {
                    echo "Admin";
                } elseif ($role === "user") {
                    echo "Kullanıcı";
                }
            ?>
        </h1>
    </header>


    <div class="main-content">
        <table>
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Cari Hesap Kodu</th>
                    <th>Genel Toplam</th>
                    <th>Sipariş Tarihi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($siparisler) {
                        foreach ($siparisler as $siparis) {
                            echo "<tr>";
                            echo "<td>" . $siparis['number'] . "</td>";
                            echo "<td>" . $siparis['cari_hesap_kodu'] . "</td>";
                            echo "<td>" . $siparis['genel_toplam'] . "</td>";
                            echo "<td>" . $siparis['siparis_tarihi'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Veri bulunamadı.</td></tr>";
                    }
                    ?>
            </tbody>
        
        </table>
    </div>
    
    <?php if ($role !== 'user'): ?>
        <div class="actions">
            <button id="new-order-btn">Yeni Sipariş</button>
        </div>
    <?php endif; ?>

    <div class="modal" id="order-modal">
        <div class="modal-content">
            <h2>Yeni Sipariş Oluştur</h2>
            <form action="" method="POST">
                <label for="new-order-id">Numara:</label>
                <input type="text" id="new-order-id" name="number" placeholder="Numara Girin" required>
                <label for="new-order-cari_hesap_kodu">Cari Hesap Kodu:</label>
                <input type="text" id="new-order-cari_hesap_kodu" name="cari_hesap_kodu" placeholder="Cari Hesap Kodu" required>
                <label for="new-order-amount">Genel Toplam:</label>
                <input type="number" id="new-order-amount" name="genel_toplam" placeholder="Tutar Girin" required>
                <label for="new-order-date">Tarih:</label>
                <input type="date" id="new-order-date" name="siparis_tarihi" required>
                <button type="submit" name="save-order" class="save">Kaydet</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('order-modal');
        const newOrderBtn = document.getElementById('new-order-btn');
        const cancelOrderBtn = document.getElementById('cancel-order');

        newOrderBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        cancelOrderBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
