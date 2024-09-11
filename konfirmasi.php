<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi</title>
    <link rel="stylesheet" href="assets/styles/styleakun.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/images/logo_kipk.png" alt="Kawan KIPK Logo">
            <div class="namalogo">
                <h1 class="h1logo">KAWAN KIPK</h1>
                <h2 class="h2logo">Nasionalis, Visioner, Berdikari</h2>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Beranda</a></li>
                <li><a href="kepengurusan.html">Kepengurusan</a></li>
                <li><a href="acara.html">Acara</a></li>
                <li><a href="cetak_kartu.php">Cetak Kartu</a></li>
            </ul>
        </nav>
        <div class="searchBox">
            <input class="searchInput" type="text" name="" placeholder="Search">
            <button class="searchButton" href="#">
                <!-- SVG Icon -->
            </button>
        </div>
        <button class="logout">Keluar</button>
    </header>
    <h2>Data Berhasil Disimpan</h2>
    <p>Data Anda telah berhasil disimpan. Silahkan klik cetak kartu untuk mencetak.</p>
    
    <?php
    // Baca data terbaru dari file JSON
    $file = 'data.json';
    $current_data = json_decode(file_get_contents($file), true);
    $latest_data = end($current_data);
    ?>
</body>
</html>
