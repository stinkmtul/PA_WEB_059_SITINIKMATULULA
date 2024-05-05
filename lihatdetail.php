<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} 
elseif ($_SESSION['level'] != 'user'){
	echo "<script>
	window.location.href = 'index.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

$sqlTampil = mysqli_query($koneksi, "SELECT * FROM ukm WHERE id_ukm = '$id'");

if(mysqli_num_rows($sqlTampil) > 0) {
    $dataTampil = mysqli_fetch_array($sqlTampil);
    $id_ukm = $dataTampil['id_ukm'];
    $deskripsi = $dataTampil['deskripsi'];
    $status = $dataTampil['status'];
    $jumlah_anggota = $dataTampil['jumlah_anggota'];

} else {
    echo "Data tidak ditemukan";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Komunitas - <?php echo $id_kapal; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include 'navbaruser.php' ?>
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
        input.form-control[readonly] {
            border: none;
        }
        #pesan-sekarang .btn {
            border-radius: 30px; /* Make the buttons pill-shaped */
            font-size: 16px; /* Increase font size */
            padding: 10px 20px; /* Add padding to the buttons */
            margin-left: 5px; /* Add some space between buttons */
        }
    </style>
    <br>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Komunitas - <?php echo $_GET['nama']; ?></h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Nama UKM</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $_GET['nama'] ?>"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Deskripsi</b></div>
                            <div class="col-md-9"><textarea name="" class="form-control" cols="20" rows="5" readonly><?php echo $deskripsi; ?></textarea></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Status</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $status; ?>"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3"><b>Jumlah Anggota</b></div>
                            <div class="col-md-9"><input type="text" class="form-control" readonly value="<?php echo $jumlah_anggota; ?>"></div>
                        </div>
                    </li>
                </ul>
                <div id="pesan-sekarang" class="text-right">
                    <a href="lihatkomunitas.php" class="btn btn-danger">Kembali</a>
                    <a href="formgabung.php?id=<?php echo $id_ukm; ?>&nama=<?php echo urlencode($_GET['nama']); ?>" class="btn btn-success">Bergabung ke komunitas</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
