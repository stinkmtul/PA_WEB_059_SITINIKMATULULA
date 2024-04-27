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

$id = $_SESSION['id_user'];
$sqlTampil = mysqli_query($koneksi, "SELECT * FROM ukm JOIN user ON ukm.id_user = user.id_user WHERE user.id_user ='$id'");

if(mysqli_num_rows($sqlTampil) > 0) {
    $dataTampil = mysqli_fetch_array($sqlTampil);
    $id_ukm = $dataTampil['id_ukm'];
    $username = $dataTampil['username'];
    $password = $dataTampil['password'];
    $nama_ukm = $dataTampil['nama_ukm'];
    $deskripsi = $dataTampil['deskripsi'];
    $sosialmedia = $dataTampil['sosialmedia'];
    $jumlah_anggota = $dataTampil['jumlah_anggota'];
    $status = $dataTampil['status'];
} else {
    echo "Data tidak ditemukan";
}
if (isset($_POST['ubah'])) {
	$deskripsi = $_POST['deskripsi'];
	$sosialmedia = $_POST['sosialmedia'];
    $statusupdate = $_POST['status'];

	$sqlUpdate = mysqli_query($koneksi, "UPDATE ukm SET deskripsi = '$deskripsi',  sosialmedia = '$sosialmedia', status = '$statusupdate' WHERE id_ukm = '$id_ukm'");

	if($sqlUpdate) {
		echo "<script>
		window.location.href ='profilkomunitas.php';
		alert('Data berhasil disimpan');
		</script>";
	} else {
		echo "<script>alert('Ubah data gagal!')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Komunitas - <?php echo $nama_ukm; ?></title>
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
        input.form-control[readonly], textarea.form-control[readonly] {
            border: none;
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
                <h3 class="card-title"><?php echo $id_ukm; ?> (<?php echo $status; ?>)</h3>
            </div>
            <div class="card-body">
            <form action="" method="post">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Nama Ukm</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" value="<?php echo $nama_ukm; ?>"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Username</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $username; ?>"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Password</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $password; ?>"></div>
                        </div>
                    </li>
                    <!-- Mengubah input deskripsi komunitas menjadi textarea -->
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Deskripsi Komunitas</b></div>
                            <div class="col-md-9"><textarea class="form-control" name="deskripsi" rows="5"><?php echo $deskripsi; ?></textarea></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b> Url Sosial Media</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="sosialmedia" value="<?php echo $sosialmedia; ?>"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Jumlah Anggota</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $jumlah_anggota; ?>"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Status</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $status; ?>"></div>
                        </div>
                    </li>
                    <input hidden type="text" class="form-control" name="status" readonly value="aktif">
                </ul>
                <div id="pesan-sekarang" class="text-right">
                <a href="home.php" class="btn btn-danger">Kembali</a>
                <?php if ($status == "non-aktif") { ?>
                    <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Ingin menyimpan data?')">Aktifkan Komunitas sekarang</button>
                <?php } else { ?>
                    <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Ingin update data?')">Ubah</button>
                <?php } ?>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
