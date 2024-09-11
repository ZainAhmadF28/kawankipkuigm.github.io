<?php
// Ambil data dari formulir
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';
$social_handle = isset($_POST['social_handle']) ? $_POST['social_handle'] : '';
$keanggotaan = isset($_POST['keanggotaan']) ? $_POST['keanggotaan'] : '';

// Upload foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);

    // Check if uploads folder exists and is writable
    if (!is_dir($target_dir) || !is_writable($target_dir)) {
        die("Error: Upload directory does not exist or is not writable.");
    }

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Upload successful
    } else {
        die("Error: There was an error uploading your file.");
    }
} else {
    $target_file = 'uploads/default.jpg'; // Atur default jika tidak ada foto yang diunggah
}

// Simpan data ke dalam file atau database
// Contoh menyimpan ke dalam file JSON
$data = [
    'nama' => $nama,
    'prodi' => $prodi,
    'social_handle' => $social_handle,
    'keanggotaan' => $keanggotaan,
    'foto' => $target_file,
];

$file = 'data.json';
if (file_exists($file)) {
    $current_data = json_decode(file_get_contents($file), true);
    $current_data[] = $data;
    file_put_contents($file, json_encode($current_data));
} else {
    file_put_contents($file, json_encode([$data]));
}

// Redirect ke halaman konfirmasi
header('Location: konfirmasi.php');
exit();
