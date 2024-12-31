<?php
session_start();

// Sepeti boşaltma ve ödeme sonrası mesajı
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo 'Ödeme işlemi başarısız. Sepetinizde ürün bulunmuyor.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Onay</title>
</head>
<body>
    <h2>Ödeme Başarılı!</h2>
    <p>Ödemeniz başarılı bir şekilde alınmıştır. Siparişiniz hazırlanıyor.</p>
    <a href="index.php">Ana Sayfaya Dön</a>
</body>
</html>
