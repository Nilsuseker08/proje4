<?php
// Veritabanı Bağlantısı
include('db_connection.php');

// Ürünleri çekmek için sorgu
$sql = "SELECT * FROM urunler";
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql .= " WHERE tag = '" . $category . "'";  // Seçilen kategoriye göre ürünleri filtrele
}

$result = $conn->query($sql);

// Kategorileri almak için sorgu
$category_sql = "SELECT DISTINCT tag FROM urunler";
$category_result = $conn->query($category_sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
/* Genel ayarlar */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline-block;
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
}

nav ul li a:hover {
    color: #ff6600;
}

.product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 20px;
}

.product {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 200px;
    padding: 15px;
    margin: 15px;
    text-align: center;
}

.product img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.product h2 {
    font-size: 20px;
    margin: 10px 0;
}

.product p {
    font-size: 16px;
    color: #666;
}

.product .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #333;
    color: white;
    text-decoration: none;
    margin-top: 10px;
    border-radius: 5px;
}

.product .btn:hover {
    background-color: #ff6600;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}
</style>

<body>
    <header>
        <h1>Ürünlerimiz</h1>
        <!-- Kategori Menüsü -->
        <nav>
            <ul>
                <li><a href="urunler.php">Tüm Ürünler</a></li>
                <?php while($row = $category_result->fetch_assoc()): ?>
                    <li><a href="urunler.php?category=<?php echo $row['tag']; ?>"><?php echo $row['tag']; ?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Ürünler Listesi -->
        <div class="product-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="product">
                        <img src="resimler/<?php echo $row['resim']; ?>" alt="<?php echo $row['isim']; ?>">
                        <h2><?php echo $row['isim']; ?></h2>
                        <p>Fiyat: <?php echo $row['fiyat']; ?> TL</p>
                        <p>İndirim: <?php echo $row['indirim']; ?> TL</p>
                        <p>Özel Üye Fiyatı: <?php echo $row['uye_ozel_fiyat']; ?> TL</p>
                        <a href="urun_detay.php?id=<?php echo $row['id']; ?>" class="btn">Detaylar</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Henüz ürün bulunmamaktadır.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Tüm Hakları Saklıdır.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
