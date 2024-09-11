<?php
session_start();
require 'koneksi.php'; // Sesuaikan dengan koneksi database Anda
require('fpdf.php');

// Ambil informasi user dari database
$sql = "SELECT * FROM users WHERE id_user=" . $_SESSION['user_id'];
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('uploads/logo.png',10,6,30); // Ganti dengan logo Anda
        $this->SetFont('Arial','B',12);
        $this->Cell(80);
        $this->Cell(30,10,'KARTU ANGGOTA',0,0,'C');
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// Atur posisi dan style untuk teks di kartu
$pdf->Cell(0,10,'KAWAN KIPK 2024-2025',0,1,'C');
$pdf->Ln(10);
$pdf->Image('uploads/'.$user['foto'], 10, 30, 50, 0, '', ''); // Tambah foto user

// Nama
$pdf->Ln(10);
$pdf->Cell(0,10,'Nama: '.$user['nama'],0,1,'L');
// Prodi
$pdf->Cell(0,10,'Prodi: '.$user['prodi'],0,1,'L');
// Tambahkan informasi lainnya sesuai kebutuhan

$pdf->Output('D', 'Kartu_Anggota.pdf');
?>
