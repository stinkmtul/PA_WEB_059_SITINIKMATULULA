<?php
include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} 
elseif ($_SESSION['level'] != 'superadmin'){
	echo "<script>
	window.location.href = 'index.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

if(isset($_GET['id_ukm']) && isset($_GET['id_user'])) {
    $id_ukm = $_GET['id_ukm'];
    $id_user = $_GET['id_user'];

    $hapus_ukm = mysqli_query($koneksi, "DELETE FROM ukm WHERE id_ukm='$id_ukm'");

    $hapus_user = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

    if($hapus_ukm && $hapus_user) {
        echo '<script>
        window.location.href = "datakomunitas.php"; 
        alert("Data berhasil dihapus");</script>';
    } else {
        echo '<script>
        window.location.href = "datakomunitas.php"; 
        alert("Gagal menghapus data.");</script>';
    }
}
?>
