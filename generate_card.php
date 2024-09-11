<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Ambil data dari file JSON
$file = 'data.json';
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    $latest_data = end($data); // Ambil data terakhir yang disimpan
} else {
    die('Data tidak ditemukan.');
}

$nama = $latest_data['nama'];
$prodi = $latest_data['prodi'];
$social_handle = $latest_data['social_handle'];
$keanggotaan = $latest_data['keanggotaan'];
$target_file = $latest_data['foto'];

// Konversi gambar pengguna ke base64
if (file_exists($target_file)) {
    $type = pathinfo($target_file, PATHINFO_EXTENSION);
    $data = file_get_contents($target_file);
    $base64_foto = 'data:image/' . $type . ';base64,' . base64_encode($data);
} else {
    die('File gambar tidak ditemukan.');
}

// Path to logo image
$logo_path = 'assets/images/logo_kipk.png';

// Periksa apakah file logo ada
if (!file_exists($logo_path)) {
    die('File logo tidak ditemukan.');
}

// Convert logo to base64
$type = pathinfo($logo_path, PATHINFO_EXTENSION);
$data = file_get_contents($logo_path);
$base64_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Path to logo image
$ig_path = 'assets/images/IG.png';

// Periksa apakah file logo ada
if (!file_exists($ig_path)) {
    die('File ig tidak ditemukan.');
}

// Convert ig to base64
$type = pathinfo($ig_path, PATHINFO_EXTENSION);
$data = file_get_contents($ig_path);
$base64_ig = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Path to logo image
$section_path = 'assets/images/Section.png';

// Periksa apakah file logo ada
if (!file_exists($section_path)) {
    die('File section tidak ditemukan.');
}

// Convert section to base64
$type = pathinfo($section_path, PATHINFO_EXTENSION);
$data = file_get_contents($section_path);
$base64_section = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Path to logo image
$bot_path = 'assets/images/backk.png';

// Periksa apakah file logo ada
if (!file_exists($bot_path)) {
    die('File bot tidak ditemukan.');
}

// Convert bot to base64
$type = pathinfo($bot_path, PATHINFO_EXTENSION);
$data = file_get_contents($bot_path);
$base64_bot = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Path to logo image======================================================Background Blur
$back_path = 'assets/images/backgroundbawahh.png';

// Periksa apakah file logo ada
if (!file_exists($back_path)) {
    die('File back tidak ditemukan.');
}

// Convert back to base64
$type = pathinfo($back_path, PATHINFO_EXTENSION);
$data = file_get_contents($back_path);
$base64_back = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Path to logo image====================================================== Blur
$dow_path = 'assets/images/bayyy.png';

// Periksa apakah file logo ada
if (!file_exists($dow_path)) {
    die('File dow tidak ditemukan.');
}

// Convert dow to base64
$type = pathinfo($dow_path, PATHINFO_EXTENSION);
$data = file_get_contents($dow_path);
$base64_dow = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Path to logo image====================================================== Blur
$doww_path = 'assets/images/bayyyy.png';

// Periksa apakah file logo ada
if (!file_exists($doww_path)) {
    die('File dow tidak ditemukan.');
}

// Convert dow to base64
$type = pathinfo($doww_path, PATHINFO_EXTENSION);
$data = file_get_contents($doww_path);
$base64_doww = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Mulai output buffering
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu</title>
    <style>
@font-face {
            font-family: 'Moderniz';
            src: url('vendor/dompdf/dompdf/lib/fonts/Moderniz.ttf') format('truetype');
        }

        @font-face {
            font-family: 'StretchPro';
            src: url('vendor/dompdf/dompdf/lib/fonts/StretchPro.ttf') format('truetype');
        }

html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #100700; /* Warna latar belakang yang diinginkan */
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
}

.id-card {
    position: relative;
    top: 100px;
    color: #ffffff;
    width: 300px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.logo {
    width: 60px;
    height: auto;
    position: relative;
    top: -60px;
    left: 110px;
}

.header-text {
    margin-left: 10px;
    
}

.header-text h1 {
    color: #ff9600;
    position: relative;
    top: -140px;
    left: 250px;
}

.header-text h2 {
    font-size: 13px;
    color: #d51f1c;
    position: relative;
    top: -160px;
    left: 262px;
}

.section {
    position: relative; /* Membuat div sebagai referensi untuk posisi gambar-gambar di dalamnya */
    width: 270px;
    height: auto;
}

.section img {
    position: absolute; /* Memungkinkan gambar untuk bertumpuk dalam div */
}

.section img:nth-child(1) {
    z-index: 1002; /* Lapisan kedua terendah */
    width: 390px;
    height: auto;
    top: -130px;
    left: 190px;
}

.section img:nth-child(2) {
    z-index: 1003; /* Lapisan kedua tertinggi */
    width: 360px;
    height: auto;
    top: -63.5px;
    left: 210px;
}

.section img:nth-child(3) {
    z-index: 1004; /* Lapisan tertinggi */
    width: 390px; /* Sesuaikan ukuran jika diperlukan */
    height: auto;
    top: 340px;
    left: 190px;
}

.section img:nth-child(4) {
    z-index: 1001; /* Lapisan terendah */
    width: 2300px; /* Sesuaikan ukuran jika diperlukan */
    height: auto;
    top: 160px; /* Sesuaikan posisi jika diperlukan */
    left: -880px; /* Sesuaikan posisi jika diperlukan */
}

.section img:nth-child(5) {
    z-index: 1000; /* Lapisan terendah */
    width: 400px; /* Sesuaikan ukuran jika diperlukan */
    height: auto;
    top: 0px; /* Sesuaikan posisi jika diperlukan */
    left: 470px; /* Sesuaikan posisi jika diperlukan */
}

.section img:nth-child(6) {
    z-index: 1001; /* Lapisan terendah */
    width: 400px; /* Sesuaikan ukuran jika diperlukan */
    height: auto;
    top: -590px; /* Sesuaikan posisi jika diperlukan */
    left: -150px; /* Sesuaikan posisi jika diperlukan */
}


.text-content {
    position: relative; /* Pastikan elemen ini memiliki positioning */
    z-index: 1002; /* Tetapkan z-index lebih tinggi daripada elemen lain */
    width: 1000px;
}

.text-content h1 {
    position: relative;
    margin: 10px 0;
    padding-top: 340px;
    font-size: 30px;
    left: -114px;
    width: 1000px;
    z-index: 1002; /* Tetapkan z-index lebih tinggi daripada elemen lain */
}

.text-content h2 {
    position: relative;
    margin: 10px 0;
    top:-15px;
    font-size: 25px;
    left: -115px;
    width: 1000px;
    z-index: 1002; /* Tetapkan z-index lebih tinggi daripada elemen lain */
}

.text-content p {
    margin: 10px 0;
    position: relative;
    top: -100px;
    z-index: 1002; /* Tetapkan z-index lebih tinggi daripada elemen lain */
}


.name {
    position: relative;
    font-size: 50px;
    font-weight: bold;
    left:-120px;
    width:1000px;
    padding-top:165px;
}

.department {
    position: relative;
    font-size: 40px;
    font-weight: bold;
    left: -120px;
    width: 1000px;
    top: 80px;
    color: #e54d04; /* Warna isi teks */
    text-shadow: 
        -2px -2px 0 #ffffff,  
         2px -2px 0 #ffffff,  
        -2px  2px 0 #ffffff,  
         2px  2px 0 #ffffff,  
        -2px  0px 0 #ffffff,  
         2px  0px 0 #ffffff,
         0px  2px 0 #ffffff,  
         0px -2px 0 #ffffff;
}

.social-handle {
    font-size: 20px;
    font-weight: bold;
    left:-335px;
    padding-top:60px;
}

.ig{
    width: 40px;
    height: auto;
    position: relative;
    padding-top: -10px;
    left: -460px;
}

    </style>
</head>
<body>
    <div class="id-card">
        <div class="header">
            <img id="logo" src="<?php echo $base64_logo; ?>" alt="Logo" class="logo">
            <div class="header-text">
                <h1>KAWAN KIPK</h1>
                <h2>NASIONALIS, VISIONER, BERDIKARI</h2>
            </div>
        </div>
        <div class="section">
            <img src="<?php echo $base64_section; ?>" alt="section">
            <img src="<?php echo $base64_foto; ?>" alt="Foto Pengguna">
            <img src="<?php echo $base64_back; ?>" alt="background">
            <img src="<?php echo $base64_bot; ?>" alt="bot">
            <img src="<?php echo $base64_dow; ?>" alt="shadow">
            <img src="<?php echo $base64_doww; ?>" alt="shadoww">
        </div>
        <div class="text-content">
            <h1><?php echo $keanggotaan; ?></h1>
            <h2>KAWAN KIPK 2024-2025</h2>
            <p class="name"><?php echo $nama; ?></p>
            <p class="department"><?php echo $prodi; ?></p>
            <img id="ig" src="<?php echo $base64_ig; ?>" alt="ig" class="ig">
            <p class="social-handle"><?php echo $social_handle; ?></p>
        </div>  
    </div> 
</body>
</html>

<?php
// Tangkap output buffering ke dalam variabel
$html = ob_get_clean();

// Setup Dompdf
$options = new Options();
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait'); // Bisa diubah sesuai kebutuhan
$dompdf->render();
$dompdf->stream("Kartu keanggotaan $nama.pdf", ["Attachment" => false]);
?>
