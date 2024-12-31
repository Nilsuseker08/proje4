<?php
// Veritabanı Bağlantı Ayarları
$servername = "localhost"; // Veritabanı sunucu adresi
$username = "root";       // Veritabanı kullanıcı adı
$password = "";           // Veritabanı şifresi
$database = "ecommerce"; // Veritabanı adı

// Bağlantı Oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı Kontrol Et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Türkçe karakterler için UTF-8 ayarı
$conn->set_charset("utf8");

// Bağlantı başarılı mesajı (isteğe bağlı, genelde kaldırılır)
// echo "Bağlantı başarılı";
?>
