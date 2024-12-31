<?php
// Veritabanı Bağlantısı
include('db_connection.php');

// Sepet kontrolü
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Sepet başlatılıyor
}

// Sepete ürün ekleme
if (isset($_GET['add_to_cart'])) {
    $id = $_GET['id'];
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;

    // Ürün bilgilerini çekme
    $sql = "SELECT * FROM urunler WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $product['quantity'] = $quantity;
        $_SESSION['cart'][] = $product;
    }
}

// Sepetten ürün çıkarma
if (isset($_GET['remove_from_cart'])) {
    $index = $_GET['index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Diziyi yeniden indexliyoruz
}

// Sepetteki toplam fiyatı hesapla
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
    <title>Sepetim</title>
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

/* Sepet Sayfası */
.cart-container {
    display: flex;
    justify-content: center;
    padding: 50px;
}

.cart-items {
    width: 80%;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.cart-items h2 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 20px;
}

.cart-item img {
    width: 80px;
    height: 80px;
    border-radius: 8px;
}

.cart-item-details {
    flex-grow: 1;
    margin-left: 20px;
}

.cart-item-details h3 {
    font-size: 20px;
    color: #333;
}

.cart-item-details p {
    color: #777;
    margin: 5px 0;
}

.cart-item-details .price {
    font-size: 18px;
    font-weight: bold;
    color: #e74c3c;
}

.cart-item-details .quantity {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cart-item-details .quantity input {
    width: 50px;
    padding: 5px;
    font-size: 16px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.remove-item {
    color: #e74c3c;
    cursor: pointer;
    font-size: 16px;
    transition: color 0.3s;
}

.remove-item:hover {
    color: #c0392b;
}

/* Sepet Özeti */
.cart-summary {
    background-color: white;
    padding: 30px;
    margin-left: 30px;
    width: 30%;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.cart-summary h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.cart-summary .total-price {
    font-size: 22px;
    font-weight: bold;
    color: #e74c3c;
    margin-bottom: 20px;
}

.cart-summary .checkout-btn {
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

.cart-summary .checkout-btn:hover {
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
                <li><a href="#">Hakkında</a></li>
                <li><a href="#">İletişim</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="cart-container">
            <!-- Sepet Ürünleri -->
            <div class="cart-items">
                <h2>Sepetiniz</h2>
                <?php if (empty($_SESSION['cart'])): ?>
                    <p>Sepetinizde ürün bulunmamaktadır.</p>
                <?php else: ?>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <div class="cart-item">
                        <img src="resimler/<?php echo $item['resim']; ?>" alt="<?php echo $item['isim']; ?>">
                        <div class="cart-item-details">
                            <h3><?php echo $item['isim']; ?></h3>
                            <p><?php echo nl2br($item['aciklama']); ?></p>
                            <p class="price"><?php echo number_format($item['fiyat'], 2, ',', '.'); ?> TL</p>
                            <div class="quantity">
                                <input type="number" value="<?php echo $item['quantity']; ?>" min="1">
                                <span class="remove-item"><a href="?remove_from_cart=true&index=<?php echo $index; ?>">Ürünü Sil</a></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Sepet Özeti -->
            <div class="cart-summary">
                <h3>Sepet Özeti</h3>
                <p>Toplam Fiyat: <span class="total-price"><?php echo number_format($total_price, 2, ',', '.'); ?> TL</span></p>
                <a href="odeme.php" class="checkout-btn">Ödeme Yap</a>
            </div>
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>
