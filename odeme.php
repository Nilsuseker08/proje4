<?php
session_start();

// Sepet ve toplam fiyat kontrolü
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['fiyat'] * $item['quantity'];
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    /* Genel Stil */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f9f9f9;
    color: #333;
}

/* Başlık ve Menü */
.header {
    background-color: #2c3e50;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .logo a {
    color: #fff;
    font-size: 24px;
    text-decoration: none;
    font-weight: bold;
}

.header nav ul {
    list-style-type: none;
    display: flex;
    gap: 20px;
}

.header nav ul li {
    display: inline;
}

.header nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
}

.header nav ul li a:hover {
    text-decoration: underline;
}

/* Ödeme Sayfası */
.payment-container {
    display: flex;
    justify-content: center;
    padding: 50px;
}

.payment-form {
    width: 50%;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.payment-form h2 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    font-size: 16px;
    color: #333;
    display: block;
    margin-bottom: 5px;
}

.input-group input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.input-group input:focus {
    border-color: #2ecc71;
    outline: none;
}

.payment-summary {
    margin-top: 30px;
    padding: 20px;
    background-color: #f1f1f1;
    border-radius: 10px;
}

.payment-summary h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.payment-summary .total-price {
    font-size: 22px;
    font-weight: bold;
    color: #e74c3c;
}

.payment-summary .payment-btn {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #2ecc71;
    color: white;
    text-align: center;
    font-size: 18px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.payment-summary .payment-btn:hover {
    background-color: #27ae60;
}
</style>

<body>
    <header class="header">
        <div class="logo">
            <a href="#">E-Commerce</a>
        </div>
        <nav>
            <ul>
                <li><a href="#">Ana Sayfa</a></li>
                <li><a href="#">Ürünler</a></li>
                <li><a href="#">Sepetim</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="payment-container">
            <form class="payment-form" action="#" method="POST">
                <h2>Ödeme Bilgileri</h2>
                
                <!-- Kredi Kartı Bilgileri -->
                <div class="input-group">
                    <label for="name">Adınız Soyadınız</label>
                    <input type="text" id="name" name="name" placeholder="Adınızı ve soyadınızı girin" required>
                </div>

                <div class="input-group">
                    <label for="card_number">Kredi Kartı Numarası</label>
                    <input type="text" id="card_number" name="card_number" placeholder="Kart numaranızı girin" required>
                </div>

                <div class="input-group">
                    <label for="expiry_date">Son Kullanma Tarihi</label>
                    <input type="text" id="expiry_date" name="expiry_date" placeholder="AA/YY" required>
                </div>

                <div class="input-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV kodunu girin" required>
                </div>

                <!-- Adres Bilgileri -->
                <div class="input-group">
                    <label for="address">Adres</label>
                    <input type="text" id="address" name="address" placeholder="Adresinizi girin" required>
                </div>

                <!-- Sepet Özeti -->
                <div class="payment-summary">
                    <h3>Sepet Özeti</h3>
                    <p>Toplam Tutar: <span class="total-price"><?php echo number_format($total_price, 2, ',', '.'); ?> TL</span></p>
                    <a href="odeme_onay.php" class="payment-btn">Ödeme Yap</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
