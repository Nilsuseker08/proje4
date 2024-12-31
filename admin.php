<?php
session_start();
require_once 'db.php'; // Veritabanı bağlantısı dosyanız

// Giriş Kontrolü
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifre doğrulama
    if ($username == 'admin' && $password == 'admin') {
        $_SESSION['loggedin'] = true;
    } else {
        $error_message = "Geçersiz kullanıcı adı veya şifre!";
    }
}

// Eğer giriş yapılmışsa admin paneline yönlendir
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Ürün Sayısı
    $query_products = "SELECT COUNT(*) AS product_count FROM urunler";
    $result_products = $db->query($query_products);
    $product_count = $result_products->fetch_assoc()['product_count'];

    // Online Sipariş Sayısı
    $query_orders = "SELECT COUNT(*) AS order_count FROM siparisler WHERE durum IN ('Hazırlanıyor', 'Gönderildi')";
    $result_orders = $db->query($query_orders);
    $order_count = $result_orders->fetch_assoc()['order_count'];

    // Gelir Analizi (Son 30 Günlük)
    $query_income = "SELECT SUM(toplam_fiyat) AS total_income FROM siparisler WHERE durum = 'Tamamlandı' AND tarih > NOW() - INTERVAL 30 DAY";
    $result_income = $db->query($query_income);
    $total_income = $result_income->fetch_assoc()['total_income'];

    // Gider Analizi (Son 30 Günlük)
    $query_expenses = "SELECT SUM(amount) AS total_expenses FROM expenses WHERE date > NOW() - INTERVAL 30 DAY";
    $result_expenses = $db->query($query_expenses);
    $total_expenses = $result_expenses->fetch_assoc()['total_expenses'];

    // Kar/Zarar Durumu
    $query_profit_loss = "
        SELECT 
            (SELECT SUM(toplam_fiyat) FROM siparisler WHERE durum = 'Tamamlandı' AND tarih > NOW() - INTERVAL 30 DAY) - 
            (SELECT SUM(amount) FROM expenses WHERE date > NOW() - INTERVAL 30 DAY) AS profit_loss
    ";
    $result_profit_loss = $db->query($query_profit_loss);
    $profit_loss = $result_profit_loss->fetch_assoc()['profit_loss'];
} else {
    // Eğer giriş yapılmamışsa giriş ekranını göster
    $login_screen = true;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Giriş</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<style>
    /* Genel Stiller */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f9fc;
        margin: 0;
        padding: 0;
    }

    /* Giriş Ekranı */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #3498db;
    }

    .login-box {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        width: 400px;
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-box input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .login-box button {
        background-color: #3498db;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
    }

    .login-box button:hover {
        background-color: #2980b9;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }

    /* Admin Panel Stilleri */
    .header {
        background-color: #3498db;
        color: white;
        padding: 20px 0;
        text-align: center;
    }

    .statistics {
        display: flex;
        justify-content: space-between;
        margin: 30px 0;
        gap: 20px;
        flex-wrap: wrap;
    }

    .stat-card {
        background-color: white;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        flex: 1;
        min-width: 220px;
        max-width: 250px;
        transition: transform 0.3s ease;
    }

    .stat-card h3 {
        font-size: 18px;
        color: #7f8c8d;
    }

    .stat-card p {
        font-size: 24px;
        font-weight: 600;
        color: #2c3e50;
    }

    .stat-card:hover {
        transform: translateY(-10px);
    }

    .analysis {
        background-color: white;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 10px;
    }

    .analysis-card {
        padding: 20px;
        background-color: #ecf0f1;
        border-radius: 10px;
        margin-top: 20px;
    }

    .analysis-card h3 {
        font-size: 18px;
        color: #34495e;
    }

    .profit-loss {
        font-size: 22px;
        font-weight: 600;
    }

    .positive {
        color: #27ae60;
    }

    .negative {
        color: #e74c3c;
    }
</style>

<body>

<?php if (isset($login_screen) && $login_screen): ?>
    <!-- Giriş Ekranı -->
    <div class="login-container">
        <div class="login-box">
            <h2>Admin Girişi</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Kullanıcı Adı" required>
                <input type="password" name="password" placeholder="Şifre" required>
                <button type="submit">Giriş Yap</button>
                <?php if (isset($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
<?php else: ?>
    <!-- Admin Panel -->
    <header class="header">
        <h1>Admin Panel</h1>
    </header>

    <main>
        <section class="statistics">
            <div class="stat-card">
                <h3>Mağazada Mevcut Ürün Sayısı</h3>
                <p><?php echo $product_count; ?> Ürün</p>
            </div>
            <div class="stat-card">
                <h3>Aktif Sipariş Sayısı</h3>
                <p><?php echo $order_count; ?> Sipariş</p>
            </div>
            <div class="stat-card">
                <h3>Son 30 Günlük Gelir</h3>
                <p><?php echo number_format($total_income, 2, ',', '.'); ?> TL</p>
            </div>
            <div class="stat-card">
                <h3>Son 30 Günlük Gider</h3>
                <p><?php echo number_format($total_expenses, 2, ',', '.'); ?> TL</p>
            </div>
        </section>

        <section class="analysis">
            <h2>Analizler</h2>
            <div class="analysis-card">
                <h3>Toplam Gelir ve Gider Farkı</h3>
                <p class="profit-loss">
                    <?php 
                    if ($profit_loss >= 0) {
                        echo '<span class="positive">Kâr: ' . number_format($profit_loss, 2, ',', '.') . ' TL</span>';
                    } else {
                        echo '<span class="negative">Zarar: ' . number_format(abs($profit_loss), 2, ',', '.') . ' TL</span>';
                    }
                    ?>
                </p>
            </div>
        </section>
    </main>
<?php endif; ?>

</body>
</html>
