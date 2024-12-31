<?php
// Veritabanı bağlantısını dahil et
include 'php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen verileri al
    $tag = $_POST['tag'];
    $tur = $_POST['tur'];  // Tür verisi
    $isim = $_POST['isim'];
    $fiyat = $_POST['fiyat'];
    $indirim = $_POST['indirim'];
    $uye_ozel_fiyat = $_POST['uye_ozel_fiyat'];
    $taksitli_fiyat = $_POST['taksitli_fiyat'];
    $resim = $_FILES['resim']['name'];

    // Resim yükleme işlemi
    $target_dir = "img/ürünler/";
    $target_file = $target_dir . basename($resim);
    move_uploaded_file($_FILES['resim']['tmp_name'], $target_file);

    // Veritabanına verileri ekle
    $query = "INSERT INTO urunler (tag, tur, isim, fiyat, indirim, uye_ozel_fiyat, taksitli_fiyat, resim)
              VALUES ('$tag', '$tur', '$isim', '$fiyat', '$indirim', '$uye_ozel_fiyat', '$taksitli_fiyat', '$resim')";
    if (mysqli_query($conn, $query)) {
        echo "Ürün başarıyla eklendi.";
    } else {
        echo "Hata: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekleme</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/urunstyle.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Ürün Ekleme</h2>
        <form action="product_add.php" method="POST" enctype="multipart/form-data" class="form">
    <!-- Tag seçimi -->
    <label for="tag">Tag:</label>
    <select id="tag" name="tag" required>
        <option value="">Tag Seçin</option>
        <option value="firsatlar">Fırsatlar</option>
        <option value="hizli_gonderi">Hızlı Gönderi</option>
        <option value="cok_satan">Çok Satan</option>
        <option value="evlilik_teklifi">Evlilik Teklifi</option>
        <option value="zen_lights">Vav Lights</option>
        <option value="dugun">Düğün</option>
        <option value="setler">Setler</option>
        <option value="yeni_gelenler">Yeni Gelenler</option>
    </select>

    <!-- Tür seçimi -->
    <label for="tur">Tür:</label>
    <select id="tur" name="tur" required>
        <option value="">Tür Seçin</option>

        <option value="">-- Baget Türleri --</option>
        <option value="Baget Küpe">Baget Küpe</option>
        <option value="Baget Bileklik">Baget Bileklik</option>
        <option value="Baget Kolye">Baget Kolye</option>
        <option value="Baget Yüzük">Baget Yüzük</option>

        <option value="">-- Yüzük Türleri --</option>
        <option value="Tektaş Yüzük">Tektaş Yüzük</option>
        <option value="Baget Yüzük">Baget Yüzük</option>
        <option value="5 Taş Pırlanta Yüzük">5 Taş Pırlanta Yüzük</option>
        <option value="Tamtur Yüzük">Tamtur Yüzük</option>
        <option value="Yarım Tur Yüzük">Yarım Tur Yüzük</option>
        <option value="Tasarım Yüzük">Tasarım Yüzük</option>
        <option value="Reina Yüzük">Reina Yüzük</option>
        <option value="Safir Yüzük">Safir Yüzük</option>
        <option value="Zümrüt Yüzük">Zümrüt Yüzük</option>
        <option value="Yakut Yüzük">Yakut Yüzük</option>
        <option value="Renkli Taş Yüzük">Renkli Taş Yüzük</option>
        <option value="Elmas Yüzük">Elmas Yüzük</option>
        <option value="Taç Yüzük">Taç Yüzük</option>

        <option value="">-- Kolye Türleri --</option>
        <option value="Tektaş Kolye">Tektaş Kolye</option>
        <option value="Tasarım Kolye">Tasarım Kolye</option>
        <option value="Baget Kolye">Baget Kolye</option>
        <option value="Reina Kolye">Reina Kolye</option>
        <option value="Harf Kolye">Harf Kolye</option>
        <option value="Pırlanta Kolye">Pırlanta Kolye</option>
        <option value="Zümrüt Kolye">Zümrüt Kolye</option>
        <option value="Safir Kolye">Safir Kolye</option>
        <option value="Yakut Kolye">Yakut Kolye</option>
        <option value="Renkli Taş Kolye">Renkli Taş Kolye</option>
        <option value="Gümüş Ve Çelik Kolye">Gümüş Ve Çelik Kolye</option>
        <option value="Pırlanta Burç Kolye">Pırlanta Burç Kolye</option>

        <option value="">-- Küpe Türleri --</option>
        <option value="Halka Küpe">Halka Küpe</option>
        <option value="Tektaş Küpe">Tektaş Küpe</option>
        <option value="Baget Küpe">Baget Küpe</option>
        <option value="Reina Küpe">Reina Küpe</option>
        <option value="Tasarım Küpe">Tasarım Küpe</option>
        <option value="Tria Küpe">Tria Küpe</option>
        <option value="Saift Küpe">Saift Küpe</option>
        <option value="Zümrüt Küpe">Zümrüt Küpe</option>
        <option value="Yakut Küpe">Yakut Küpe</option>
        <option value="Renli Taş Küpe">Renli Taş Küpe</option>
        <option value="Piercing">Piercing</option>

        <option value="">-- Bileklik Türleri --</option>
        <option value="Tasarım Bileklik">Tasarım Bileklik</option>
        <option value="Pırlanta Bileklik">Pırlanta Bileklik</option>
        <option value="Baget Bileklik">Baget Bileklik</option>
        <option value="Renkli Taş Bileklik">Renkli Taş Bileklik</option>
        <option value="Char Bileklik">Char Bileklik</option>
        <option value="Şahmeran Bileklik">Şahmeran Bileklik</option>
        <option value="Gümüş Ve Çelik Bileklik">Gümüş Ve Çelik Bileklik</option>

        <option value="">-- İnci Türleri --</option>
        <option value="İnci Kolye">İnci Kolye</option>
        <option value="İnci Bileklik">İnci Bileklik</option>
        <option value="İnci Yüzükler">İnci Yüzükler</option>
        <option value="İnci Küpeler">İnci Küpeler</option>

        <option value="">-- Forevarmark Türleri --</option>
        <option value="Forevarmark Tektaş Yüzük">Forevarmark Tektaş Yüzük</option>
        <option value="Forevarmark Tekteş Kolye">Forevarmark Tekteş Kolye</option>
        <option value="Forevarmark Tekteş Küpe">Forevarmark Tekteş Küpe</option>
        <option value="Forevarmark Beştaş Yüzük">Forevarmark Beştaş Yüzük</option>
        <option value="Forevarmark Trial">Forevarmark Trial</option>
        <option value="Forevarmark Tribute">Forevarmark Tribute</option>

        <option value="">-- Saat Türleri --</option>
        <option value="Erkek Saati">Erkek Saati</option>
        <option value="Kadın Saati">Kadın Saati</option>

        <option value="">-- Erkek Türleri --</option>
        <option value="Erkek Yüzük">Erkek Yüzük</option>
        <option value="Erkek Kolye">Erkek Kolye</option>
        <option value="Erkek Parfüm">Erkek Parfüm</option>
        <option value="Erkek Bileklik">Erkek Bileklik</option>
        <option value="Erkek Küpe">Erkek Küpe</option>
        <option value="Kol Düğmesi">Kol Düğmesi</option>
        <option value="Kalem">Kalem</option>
        <option value="Tesbih">Tesbih</option>
        <option value="Erkek Saat">Erkek Saat</option>
        <option value="Deri Ve Pırlanta">Deri Ve Pırlanta</option>
        <option value="Hobi Aksesuarları">Hobi Aksesuarları</option>

        <option value="">-- Parfüm Türleri --</option>
        <option value="Erkek Parfüm">Erkek Parfüm</option>
        <option value="Kadın Parfüm">Kadın Parfüm</option>

        <option value="">-- Çocuk Türleri --</option>
        <option value="Çocuk Bileklik">Çocuk Bileklik</option>
        <option value="Çocuk Kolye">Çocuk Kolye</option>
        <option value="Çocuk Küpe">Çocuk Küpe</option>
        <option value="Bebek İğnesi">Bebek İğnesi</option>
    </select>
            <label for="isim">Ürün Adı:</label>
            <input type="text" id="isim" name="isim" required>

            <label for="fiyat">Fiyat:</label>
            <input type="number" step="0.01" id="fiyat" name="fiyat" required>

            <label for="indirim">İndirim (%):</label>
            <input type="number" step="0.01" id="indirim" name="indirim" required>

            <label for="uye_ozel_fiyat">Üyelere Özel Fiyat:</label>
            <input type="number" step="0.01" id="uye_ozel_fiyat" name="uye_ozel_fiyat" required>

            <label for="taksitli_fiyat">Taksitli Fiyat:</label>
            <input type="number" step="0.01" id="taksitli_fiyat" name="taksitli_fiyat" required>

            <label for="resim">Ürün Resmi:</label>
            <input type="file" id="resim" name="resim" accept="image/*" required>

            <button type="submit" class="submit-btn">Ürün Ekle</button>
        </form>
    </div>
</body>
</html>
