<?php
// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $recipient_email = $_POST['recipient_email'];
    $user_email = $_POST['user_email'];
    $message = $_POST['message'];

    // Subject email
    $subject = "Pertanyaan Baru dari Event Kawan KIPK";

    // Isi email
    $body = "Anda menerima pertanyaan baru:\n\n" . $message;
    if (!empty($user_email)) {
        $body .= "\n\nEmail Pengirim: " . $user_email;
    }

    // Header untuk mengirim email
    $headers = "From: no-reply@yourdomain.com";

    // Kirim email menggunakan fungsi mail() di PHP
    if (mail($recipient_email, $subject, $body, $headers)) {
        echo "Pesan berhasil dikirim!";
    } else {
        echo "Gagal mengirim pesan.";
    }
}
?>
