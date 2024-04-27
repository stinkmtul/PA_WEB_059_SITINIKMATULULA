<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
	exit; // Hindari eksekusi kode di bawah jika pengguna tidak terautentikasi
}

// Pastikan id permintaan diterima dari parameter GET
$id_permintaan = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

// Lakukan proses penghapusan permintaan bergabung dari basis data
$sqlHapusPermintaan = mysqli_query($koneksi, "DELETE FROM permintaan WHERE id_permintaan = '$id_permintaan'");

if($sqlHapusPermintaan) {
    echo "<script>
    alert('Anda telah berhasil membatalkan permintaan bergabung.');
    window.location.href = 'index.php'; // Redirect ke halaman utama setelah berhasil membatalkan
    </script>";
} else {
    echo "<script>
    alert('Gagal membatalkan permintaan bergabung.');
    window.location.href = 'index.php'; // Redirect ke halaman utama jika gagal
    </script>";
}
?>
