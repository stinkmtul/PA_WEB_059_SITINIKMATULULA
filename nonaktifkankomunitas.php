<?php
include 'koneksi.php';
$id_ukm = $_GET['id_ukm'];

// Update status komunitas menjadi non-aktif
$query = "UPDATE ukm SET status='non-aktif' WHERE id_ukm='$id_ukm'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Jika berhasil menonaktifkan, arahkan kembali ke halaman sebelumnya
    echo "<script>
            alert('Komunitas telah dinonaktifkan.');
            window.location.href = 'datakomunitas.php';
          </script>";
} else {
    // Jika gagal menonaktifkan, tampilkan pesan error
    echo "<script>
            alert('Gagal menonaktifkan komunitas.');
            window.location.href = 'datakomunitas.php';
          </script>";
}
?>
