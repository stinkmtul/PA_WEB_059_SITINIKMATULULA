<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
    header("location:index.php");
} elseif ($_SESSION['level'] != 'user') {
    echo "<script>
    window.location.href = 'index.php';
    alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
    </script>";
}

// Pastikan id permintaan diterima dari parameter GET
$id_permintaan = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

// Lakukan proses penghapusan permintaan bergabung dari basis data
$sqlHapusPermintaan = mysqli_query($koneksi, "DELETE FROM permintaan WHERE id_permintaan = '$id_permintaan'");

if($sqlHapusPermintaan) {
    echo "<script>
    alert('Anda telah berhasil membatalkan permintaan bergabung.');
    window.location.href = 'inbox.php'; // Redirect ke halaman utama setelah berhasil membatalkan
    </script>";
} else {
    echo "<script>
    alert('Gagal membatalkan permintaan bergabung.');
    window.location.href = 'index.php'; // Redirect ke halaman utama jika gagal
    </script>";
}
?>
