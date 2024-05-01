<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} elseif ($_SESSION['level'] != 'adminukm') {
	echo "<script>
	window.location.href = 'index.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

$sqlTampil = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_permintaan= '$id'");

if(mysqli_num_rows($sqlTampil) > 0) {
    $dataTampil = mysqli_fetch_array($sqlTampil);
    $id_permintaan = $dataTampil['id_permintaan'];
    $nama_user = $dataTampil['nama_user'];
    $nim = $dataTampil['nim'];
    $alasan_bergabung = $dataTampil['alasan_bergabung'];
    $foto_ektm = $dataTampil['foto_ektm'];
    $tgl_permintaan = date('d-m-Y', strtotime($dataTampil['tgl_permintaan']));
}

if (isset($_POST['ubah'])) {
	$status = $_POST['status'];
	$keterangan = $_POST['keterangan'];
    $tgl_validasi = $_POST['tgl_validasi'];

    if ($status == 'di terima') {
        $id_ukm = $dataTampil['id_ukm'];
        $sqlTambahAnggota = mysqli_query($koneksi, "UPDATE ukm SET jumlah_anggota = jumlah_anggota + 1 WHERE id_ukm = '$id_ukm'");
        
        if (!$sqlTambahAnggota) {
            echo "<script>alert('Gagal menambah jumlah anggota!')</script>";
        }
    }

	$sqlUpdate = mysqli_query($koneksi, "UPDATE permintaan SET status = '$status', keterangan = '$keterangan', tgl_validasi = '$tgl_validasi' WHERE id_permintaan = '$id'");

	if($sqlUpdate) {
		echo "<script>
		window.location.href ='permintaanmasuk.php';
		alert('Validasi berhasil dilakukan');
		</script>";
	} else {
		echo "<script>alert('Validasi data gagal!')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include 'navbarukm.php' ?>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #184D47;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            background-color: #fff;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .card-title {
            text-align: center;
        }
        .list-group-item {
            border: none;
        }
        #pesan-sekarang {
            text-align: center;
            margin-top: 20px;
        }
        #pesan-sekarang .btn {
            border-radius: 30px; 
            font-size: 16px; 
            padding: 10px 20px;
            margin-left: 5px;
        }
    </style>
    <br>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $id_permintaan; ?></h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>Nama</b></div>
                                <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $nama_user; ?>"></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>NIM</b></div>
                                <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $nim; ?>"></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>Alasan Bergabung</b></div>
                                <div class="col-md-9"><input type="textarea" class="form-control" readonly value="<?php echo $alasan_bergabung; ?>"></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>Foto EKTM</b></div>
                                <div class="col-md-9"><img src="file/<?php echo $foto_ektm; ?>" class="img-fluid" alt="Foto EKTM"></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>Tanggal Permintaan</b></div>
                                <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $tgl_permintaan; ?>"></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>Status</b></div>
                                <div class="col-md-9">
                                    <select class="form-control" name="status">
                                        <option value="di terima" <?php if($dataTampil['status'] == 'di terima') echo 'selected'; ?>>di terima</option>
                                        <option value="di tolak" <?php if($dataTampil['status'] == 'di tolak') echo 'selected'; ?>>di tolak</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3"><b>Keterangan</b></div>
                                <div class="col-md-9"><textarea class="form-control" name="keterangan" rows="3"></textarea></div>
                            </div>
                        </li>
                        <input hidden type="text" class="form-control" name="tgl_validasi" readonly value="<?php echo date('Y-m-d'); ?>">
                    </ul>
                    <div id="pesan-sekarang" class="text-right">
                        <a href="home.php" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan ini?')">Validasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
