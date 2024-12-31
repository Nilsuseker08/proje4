<?php
// Veritabanı Bağlantısı
include('db_connection.php');

// Ürün ID'si
$id = $_GET['id'];

// Ürün detaylarını çekmek için sorgu
$sql = "SELECT * FROM urunler WHERE id = $id";
$result = $conn->query($sql);

// Ürün var mı kontrolü
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Ürün bulunamadı.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Detayları</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    /* Genel stil */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f7f7f7;
    color: #333;
}

/* Başlık ve menü */
.header {
    background-color: #1a1a1a;
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

/* Ürün Detayları */
.product-detail-container {
    display: flex;
    justify-content: center;
    gap: 40px;
    padding: 40px;
}

.product-image img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.product-info {
    max-width: 500px;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.product-info h1 {
    font-size: 32px;
    margin-bottom: 20px;
    font-weight: bold;
    color: #333;
}

.product-info .price,
.product-info .discount,
.product-info .special-price {
    font-size: 18px;
    margin-bottom: 15px;
}

.product-info .amount {
    font-weight: bold;
    color: #ff6a00;
}

.product-info .discount {
    color: #ff3b3b;
    text-decoration: line-through;
}

.product-info .special-price {
    font-size: 20px;
    color: #28a745;
}

.product-info .description {
    font-size: 16px;
    margin-bottom: 20px;
    color: #666;
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    background-color: #ff6a00;
    color: white;
    text-decoration: none;
    font-size: 18px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #ff4500;
}

/* Footer */
footer {
    background-color: #1a1a1a;
    padding: 20px;
    text-align: center;
    color: white;
}

footer p {
    font-size: 14px;
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
        <div class="product-detail-container">
            <div class="product-image">
                <img src="resimler/<?php echo $product['resim']; ?>" alt="<?php echo $product['isim']; ?>">
            </div>
            <div class="product-info">
                <h1><?php echo $product['isim']; ?></h1>
                <p class="price">Fiyat: <span class="amount"><?php echo number_format($product['fiyat'], 2, ',', '.'); ?> TL</span></p>
                <?php if ($product['indirim'] > 0): ?>
                    <p class="discount">İndirimli Fiyat: <span class="amount"><?php echo number_format($product['fiyat'] - $product['indirim'], 2, ',', '.'); ?> TL</span></p>
                <?php endif; ?>
                <p class="special-price">Özel Üye Fiyatı: <span class="amount"><?php echo number_format($product['uye_ozel_fiyat'], 2, ',', '.'); ?> TL</span></p>
                <p class="description"><?php echo nl2br($product['aciklama']); ?></p>
                <a href="sepet.php?id=<?php echo $product['id']; ?>" class="btn add-to-cart">Sepete Ekle</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024  Tüm Hakları Saklıdır.</p>
        </div>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
