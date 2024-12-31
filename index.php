<?php
// Veritabanı bağlantısını dahil et
include 'php/db_connection.php';

// Veritabanından ürünleri çekmek için sorgu
$query = "SELECT * FROM urunler ORDER BY RAND() LIMIT 4";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vav Pırlanta - Vav Pırlanta Fırsatları Online Mağzada</title>
    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;500&display=swap" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/fav2.png">
</head>
<body>
    <!-- Üst Bar -->
    <div class="top-bar">
        Üyelere Özel %50 İndirim!
    </div>

    <!-- Menü Konteyner -->
    <div class="menu-container">
        <!-- Üst Menü -->
        <div class="top-menu">
            <img src="img/logo-new.webp" alt="Zen Pırlanta Logo" class="logo">
            
            <ul class="menu">
                <li>Mağazalar</li>
                <li>Garanti Kayıt</li>
                <li>Siparişlerim</li>
                <li>
                    <span class="material-symbols-outlined">favorite</span>
                </li>
                <li>
                    <span class="material-symbols-outlined">account_circle</span>
                </li>
                <li>
                    <span class="material-symbols-outlined">shopping_bag</span>
                </li>
            </ul>
        </div>

        <!-- İkinci Menü -->
        <ul class="ıkıncımenu">
            <li> <a href="firsat.html">FIRSATLAR | </a></li>
            <li> <a href="hizli.html">HIZLI GÖNDER | </a></li>
            <li><a href="coksatan.html">ÇOK SATANLAR | </a></li>
            <li><a href="evlilik.html">EVLİLİK TEKLİFİ | </a></li>
            <li><a href="zenlig.html">Vav LIGHTS | </a></li>
            <li><a href="dugun.html">DÜĞÜN | </a></li>
            <li><a href="setler.html">SETLER | </a></li>
            <li><a href="yenigelenler.html">YENİ GELENLER | </a></li>
        </ul>
    </div>

    <div class="menu-3">
        <ul>
            <li>Vav BAGET</li>
            <li>PIRLANTA YÜZÜK</li>
            <li>PIRLANTA KOLYE</li>
            <li>PIRLANTA KÜPE</li>
            <li>PIRLANTA BİLEKLİK</li>
            <li>İNCİ IŞILTISI</li>
            <li>Vav ALYANS</li>
            <li>FOREVERMARK</li>
            <li>SAAT</li>
            <li>ERKEK</li>
            <li>PARFÜM</li>
            <li>Vav ÇOCUK</li>
        </ul>
    </div>
    
    <div class="slider-bar">
        <span class="material-symbols-outlined sol-ok">arrow_back_ios</span>
        <img src="img/11122023diamondc.webp" alt="Slider Görseli">
        <span class="material-symbols-outlined sag-ok">arrow_forward_ios</span>
    </div>
    <div class="slider-index">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    
    <div class="icerik">
        <img src="img/sevs/resim1.png" alt="" class="resim1"><br><br>
        <h2 class="baslik"> <u>İncelediğiniz Mücevherler</u></h2><br>
        <div class="container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card">
                <div class="ribbon top-left">ÇOK SATAN <span>FIRSAT</span></div>
                <div class="wishlist">♡</div>
                <!-- Ürün ID'sine göre resmi çekme -->
                <img src="img/ürünler/<?php echo $row['id']; ?>.jpg" alt="<?php echo $row['isim']; ?>" class="product-image">
                <h3><?php echo $row['isim']; ?></h3>
                <p class="price"><?php echo $row['fiyat']; ?> TL</p>
                <div class="discount-box">
                    <span class="discount"><?php echo $row['indirim']; ?>%</span>
                    <span class="member-price">ÜYELERE ÖZEL <strong><?php echo $row['uye_ozel_fiyat']; ?> TL</strong></span>
                </div>
                <p class="installment"><?php echo $row['taksitli_fiyat']; ?> TL x 3 taksit</p>
            </div>
        <?php } ?>
        </div><br>



        <h2 class="baslik"> <u>Yılın En Sevilen Pırlantalar</u></h2><br>
        <div class="container">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="card">
                    <div class="ribbon top-left">ÇOK SATAN <span>FIRSAT</span></div>
                    <div class="wishlist">♡</div>
                    <!-- Ürün ID'sine göre resmi çekme -->
                    <a href="urun-detay.php?id=<?php echo $row['id']; ?>">
                        <img src="img/ürünler/<?php echo $row['id']; ?>.jpg" alt="<?php echo $row['isim']; ?>" class="product-image">
                        <h3><?php echo $row['isim']; ?></h3>
                        <p class="price"><?php echo $row['fiyat']; ?> TL</p>
                    </a>
                    <div class="discount-box">
                        <span class="discount"><?php echo $row['indirim']; ?>%</span>
                        <span class="member-price">ÜYELERE ÖZEL <strong><?php echo $row['uye_ozel_fiyat']; ?> TL</strong></span>
                    </div>
                    <p class="installment"><?php echo $row['taksitli_fiyat']; ?> TL x 3 taksit</p>
                </div>
            <?php } ?>
        </div>

        <br><br>
        <img src="img/sevs/resim2.webp" alt="" class="resim1"><br><br>
        <img src="img/sevs/resim3.webp" alt="" class="resim1"><br><br>
        <img src="img/sevs/resim4.webp" alt="" class="resim1"><br><br>
        <img src="img/sevs/resim5.webp" alt="" class="resim1"><br><br>
        <img src="img/sevs/resim6.webp" alt="" class="resim1"><br><br>

        <section class="cards-container">
            <!-- Kart 1 -->
            <div class="card">
                <img src="img/cards/alt_1.webp" alt="Parmakta yüzük görünümü" class="card-image">
                <p class="card-title">Parmakta kaç karat nasıl görünür?</p>
                <a href="#" class="card-link">Tıklayın</a>
            </div>
    
            <!-- Kart 2 -->
            <div class="card">
                <img src="img/cards/alt_2.webp" alt="Hızlı gönderi mücevher" class="card-image">
                <p class="card-title">Acelem var. Hangi mücevherleri hızlı gönderebilirsiniz?</p>
                <a href="#" class="card-link">Tıklayın</a>
            </div>
    
            <!-- Kart 3 -->
            <div class="card">
                <img src="img/cards/alt_3.webp" alt="Pırlanta garanti kaydı" class="card-image">
                <p class="card-title">Pırlantamın garanti kaydını nasıl yapabilirim?</p>
                <a href="#" class="card-link">Tıklayın</a>
            </div>
        </section>

        <h2 class="baslik"> <u>Sosyal Medyada Paylaşılanlar</u></h2><br>
        <div class="container" id="sosyalmedya">
            <!-- Sosyal medya ürün kartları burada yer alacak -->
        </div>
    </div>





    <footer class="footer">
        <div class="footer-top">
            <div class="social-media">
                <p class="footer-title">Bizi Takip Edin</p>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-x-twitter"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
            <div class="newsletter">
                <p class="footer-title">E-Bülten</p>
                <input type="text" placeholder="Adınız Soyadınız">
                <input type="email" placeholder="E-Posta Adresiniz">
                <button>KAYDET</button>
            </div>
        </div>
        <hr>
        <br>

        <div class="footer-links">
            <div class="footer-column">
                <p class="footer-title">Vav Pırlanta</p>
                <a href="#">Kurumsal</a>
                <a href="#">Pırlanta Rehberi</a>
                <a href="#">Kampanyalar</a>
                <a href="#">İşlem Rehberi</a>
                <a href="#">Mağazalar</a>
                <a href="#">Çerezleri Yönetin</a>
                <a href="#">İletişim</a>
            </div>
            <div class="footer-column">
                <p class="footer-title">Müşteri Hizmetleri</p>
                <a href="#">Hesap Numaraları</a>
                <a href="#">Kişisel Verilerin Korunması</a>
                <a href="#">Aydınlatma Metni</a>
                <a href="#">Kullanım Şartları</a>
                <a href="#">Sıkça Sorulan Sorular</a>
                <a href="#">Cayma Hakkı</a>
                <a href="#">İade Bilgileri</a>
            </div>
            <div class="footer-column">
                <p class="footer-title">Pırlanta Hakkında</p>
                <a href="#">Pırlantanın Serüveni</a>
                <a href="#">Baget Pırlanta Nedir?</a>
                <a href="#">Tektaş Pırlanta Yüzük</a>
                <a href="#">Charm Bileklik Nedir</a>
                <a href="#">Renklerin Dili</a>
                <a href="#">Elmas - Pırlanta Hakkında</a>
            </div>
            <div class="footer-column">
                <p class="footer-title">Popüler Kategoriler</p>
                <a href="#">Pırlanta Yüzükler</a>
                <a href="#">Tektaş Pırlanta</a>
                <a href="#">Baget Pırlanta</a>
                <a href="#">Pırlanta Küpeler</a>
                <a href="#">Altın Bileklikler</a>
                <a href="#">Pırlanta Kolye</a>
            </div>
            <div class="footer-column">
                <p class="footer-title">Özel Günler</p>
                <a href="#">Anneler Günü</a>
                <a href="#">Babalar Günü</a>
                <a href="#">Sevgililer Günü</a>
                <a href="#">Doğum Günü Hediyesi</a>
                <a href="#">Evlilik Yıldönümü</a>
                <a href="#">Yılbaşı Hediyeleri</a>
            </div>
            <div class="footer-column">
                <p class="footer-title">Bilgilerim</p>
                <a href="#">Hesabım</a>
                <a href="#">Siparişlerim</a>
                <a href="#">Alışveriş Sepetim</a>
                <a href="#">Beğendiklerim</a>
                <p class="footer-title">Misafir İlişkileri</p>
                <p>444 7 911</p>
                <p>info@altincim.com</p>
            </div>
        </div><br><br>
        <img src="img/cards/footer.webp" alt="" width="1093" height="43"><br><br>
        <hr>
        <br><br>
        <div class="footer-container">
            <!-- Sol bölüm: Logo ve telif hakkı -->
            <div class="footer-left">
                <img src="img/logo.webp" alt="Zen Diamond Logo" class="footer-logo">
                <p>
                    Copyright &copy; 2024, <br>
                    Markalar Derneği ve Turquality Destek Programı üyesidir.
                </p>
            </div>
            
            <!-- Sağ bölüm: Menü -->
            <div class="footer-right">
                <ul class="footer-links">
                    <li><a href="#">Kullanım Şartları</a></li>
                    <li><a href="#">Gizlilik İlkeleri</a></li>
                    <li><a href="#">Güvenlik Politikası</a></li>
                    <li><a href="#">Çerez Politikası</a></li>
                </ul>
                <div class="footer-creative">
                    <span>creative</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>

<?php
// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>
