<?php
include 'db_baglanti.php'; 

$sql = "SELECT * FROM is_emirleri";
$stmt = $pdo->query($sql); 

//veri çekme
$isEmirleri = $stmt->fetchAll(PDO::FETCH_ASSOC);

//veri yollama
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Formdan gelen verileri al
    $is_emri_no = $_POST["is_emri_no"];
    $plaka = $_POST["plaka"];
    $model = $_POST["model"];
    $islem_tarihi = $_POST["islem_tarihi"];
    $durum = $_POST["durum"];

    // Veritabanına veri eklemek 
    $sql = "INSERT INTO is_emirleri (is_emri_no, plaka, model, islem_tarihi, durum)
            VALUES (:is_emri_no, :plaka, :model, :islem_tarihi, :durum)";
    
    // sorguyu çalıştır
    $stmt = $pdo->prepare($sql);
    
    // Parametreleri sorguya bağlıyoruz
    $stmt->bindParam(':is_emri_no', $is_emri_no);
    $stmt->bindParam(':plaka', $plaka);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':islem_tarihi', $islem_tarihi);
    $stmt->bindParam(':durum', $durum);
    
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
    <title>İş Emirleri</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(243, 242, 242);
        }

        header {
            background-color:rgb(6, 53, 92);
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

        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            padding: 15px;
            background-color: #e7e7e7;
            border-bottom: 1px solid #ccc;
        }

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

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions button {
            padding: 10px 20px;
            border: none;
            background-color: #0078d7;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .actions button:hover {
            background-color:rgb(38, 119, 177);
        }

        .totals-section {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color:rgb(191, 191, 191);
            border-top: 1px solid #ccc;
        }

        .totals-section div {
            font-weight: bold;
        }

        .modal-content form{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
        }

        .modal-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .modal-close {
            float: right;
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }

        .modal-close:hover {
            color: black;
        }

        .modal-content input, 
        .modal-content select, 
        .modal-content button {
            width: 400px;
            padding: 10px 0;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-content input::placeholder, 
        .modal-content select, 
        .modal-content button::placeholder{
            padding-left: 10px;
        }

        .modal-content button {
            background-color:rgb(32, 127, 205);
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color:rgb(5, 48, 78);
        }
    </style>
</head>
<body>

    <header>
        <a href="anasayfa.html" class="back-button"> < Geri </a>

        <h1>İş Emirleri | 
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
                    <th>İş Emri No</th>
                    <th>Plaka</th>
                    <th>Model</th>
                    <th>İşlem Tarihi</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($isEmirleri) {
                        foreach ($isEmirleri as $isEmri) {
                            echo "<tr>";
                            echo "<td>" . $isEmri['is_emri_no'] . "</td>";
                            echo "<td>" . $isEmri['plaka'] . "</td>";
                            echo "<td>" . $isEmri['model'] . "</td>";
                            echo "<td>" . $isEmri['islem_tarihi'] . "</td>";
                            echo "<td>" . $isEmri['durum'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Veri bulunamadı.</td></tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>

    <div class="totals-section">
        <div>Toplam İş Emri: <?php echo count($isEmirleri); ?></div>
    </div>

    <div class="modal" id="order-modal">
        <div class="modal-content">
            <span class="modal-close" id="close-modal">&times;</span>
            <div class="modal-header">Yeni İş Emri Oluştur</div>
            <form action="" method="POST">
                <input name="is_emri_no" type="text" placeholder="İş Emri No">
                <input name="plaka" type="text" placeholder="Plaka">
                <input name="model" type="text" placeholder="Model">
                <input name="islem_tarihi" type="date" placeholder="İşlem Tarihi">
                <select name="durum">
                    <option name="onaylandi" value="Onaylandı">Onaylandı</option>
                    <option name="beklemede" value="Beklemede">Beklemede</option>
                </select>
                <button type="submit">Kaydet</button>
            </form>
        </div>
    </div>

    <?php if ($role === 'admin'): ?>
            <div class="actions">
                <button id="new-order-btn">Yeni İş Emri</button>
            </div>
        <?php endif; 
    ?>

    <script>
        const modal = document.getElementById('order-modal');
        const openModalBtn = document.getElementById('new-order-btn');
        const closeModalBtn = document.getElementById('close-modal');

        openModalBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

</body>
</html>

