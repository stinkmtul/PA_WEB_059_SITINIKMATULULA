<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
	exit; // Hindari eksekusi kode di bawah jika pengguna tidak terautentikasi
} elseif ($_SESSION['level'] != 'user') {
	echo "<script>
	window.location.href = 'index.php';
	alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
	</script>";
}

$id_user = $_SESSION['id_user'];

// Mengambil data permintaan bergabung yang statusnya "menunggu" atau "ditolak"
$sqlTampil = mysqli_query($koneksi, "SELECT p.*, u.nama_ukm 
                                    FROM permintaan p 
                                    INNER JOIN ukm u ON p.id_ukm = u.id_ukm 
                                    WHERE p.id_user = '$id_user'");

if(mysqli_num_rows($sqlTampil) > 0) {
    // Menampilkan data permintaan bergabung
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Bergabung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .container-top {
            width: 80%;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
            font-size: 14px;
        }

        .table-bordered thead th {
            background-color: #184D47;
            color: #fff;
        }

        .table-bordered tbody tr:hover {
            background-color: #f8f9fa;
        }
        .bi {
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
</head>
<body>
<?php include 'navbaruser.php' ?>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-11" style="margin: 0 auto;">
            <h3 class="text-center my-4">Kotak Masuk</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama UKM</th>
                        <th>Nama</th>
                        <th>Nim</th>
                        <th>Tanggal Permintaan</th>
                        <th>Status</th>
                        <th>keterangan</th>
                        <th>Aksi</th> <!-- Tambah kolom aksi untuk tombol "Batalkan" -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    while ($dataTampil = mysqli_fetch_array($sqlTampil)) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $dataTampil['nama_ukm'] ?></td>
                            <td><?php echo $dataTampil['nama_user'] ?></td>
                            <td><?php echo $dataTampil['nim'] ?></td>
                            <td><?php echo date('d-m-Y', strtotime($dataTampil['tgl_permintaan'])) ?></td>
                            <td><?php echo $dataTampil['status'] ?></td>
                            <td><?php echo $dataTampil['keterangan'] ?></td></td>
                            <td>
                                <?php if ($dataTampil['status'] == 'di tolak'): ?> <!-- Tampilkan tombol hanya jika statusnya ditolak -->
                                    <a href="batalkanpermintaan.php?id=<?php echo $dataTampil['id_permintaan']; ?>" class="btn btn-danger bi bi-x-circle"> Batalkan</a>
                                <?php elseif ($dataTampil['status'] == 'menunggu'): ?>
                                    -
                                <?php elseif ($dataTampil['status'] == 'di terima'): ?>
                                    <a href="komunitasku.php?id=<?php echo $dataTampil['id_permintaan']; ?>" class="btn btn-success bi bi-arrow-right-circle"> Lebih lanjut</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
} else {
    ?>

    <?php include 'navbaruser.php'; ?>
    <br><br><br>
    <div class="container mt-5">
        <div class="row">
        <center><img src="img/comunity.png" alt="Logo Comunity" width="150px"></center>
            <div class="col-md-11" style="margin: 0 auto;">
                <h3 class="text-center my-4">Inbox</h3>
                <div class="no-request">
                    <center><p>Tidak Ada Pesan Masuk</p></center>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
