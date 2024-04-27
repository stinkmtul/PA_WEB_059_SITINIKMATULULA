<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
	exit; // Hindari eksekusi kode di bawah jika pengguna tidak terautentikasi
}

// Pastikan id permintaan diterima dari parameter GET
$id_permintaan = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

// Dapatkan id user dari session
$id_user = $_SESSION['id_user'];

// Dapatkan id komunitas dari permintaan
$sqlGetIdUkm = mysqli_query($koneksi, "SELECT id_ukm FROM permintaan WHERE id_permintaan = '$id_permintaan' AND id_user = '$id_user'");
$id_ukm_row = mysqli_fetch_assoc($sqlGetIdUkm);
$id_ukm = $id_ukm_row['id_ukm'];

// Kurangi jumlah anggota di komunitas
$sqlKurangiAnggota = mysqli_query($koneksi, "UPDATE ukm SET jumlah_anggota = jumlah_anggota - 1 WHERE id_ukm = '$id_ukm'");

// Lakukan proses penghapusan anggota dari komunitas di basis data
$sqlHapusAnggota = mysqli_query($koneksi, "DELETE FROM permintaan WHERE id_permintaan = '$id_permintaan' AND id_user = '$id_user'");

if($sqlKurangiAnggota && $sqlHapusAnggota) {
    echo "<script>
    alert('Anda telah berhasil keluar dari komunitas.');
    window.location.href = 'index.php'; // Ganti dengan halaman utama setelah keluar
    </script>";
} else {
    echo "<script>
    alert('Gagal keluar dari komunitas.');
    window.location.href = 'index.php'; // Ganti dengan halaman utama jika gagal
    </script>";
}
?>
