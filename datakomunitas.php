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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .btn-custom {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 30px; /* Membuat tombol berbentuk pill */
            font-size: 16px; /* Meningkatkan ukuran font */
            padding: 10px 20px; /* Menambah padding pada tombol */
            margin-left: 5px; /* Menambahkan jarak antara tombol */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #45a049; /* Mengubah warna latar belakang saat tombol dihover */
            color: white; /* Mengubah warna teks menjadi putih saat tombol dihover */
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
<?php include 'navbarsuper.php' ?>
<br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <h3 class="text-center my-4">Data Komunitas</h3>
            <div class="dropdown mb-3">
                <a class="btn-custom bi bi-plus-circle" href="tambahdatakomunitas.php"></a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID UKM</th>
                        <th>Nama UKM</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT ukm.id_ukm, ukm.nama_ukm, user.id_user, user.username, user.password, ukm.status FROM ukm JOIN user ON ukm.id_user = user.id_user");
                        while ($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $data['id_ukm'] ?></td>
                                <td><?php echo $data['nama_ukm'] ?></td>
                                <td><?php echo $data['username'] ?></td>
                                <td><?php echo $data['password'] ?></td>
                                <td><?php echo $data['status'] ?></td>
                                <td>
                                    <a href="hapusdatakomunitas.php?id_ukm=<?php echo $data['id_ukm'] ?>&id_user=<?php echo $data['id_user'] ?>" class="btn btn-danger" onclick="return confirm('Anda tidak akan bisa melihat data ini lagi. Yakin ingin menghapus?');"><i class="fas fa-trash"></i></a>
                                    <?php 
                                        if ($data['status'] == 'aktif') { 
                                            ?>
                                            <a href="nonaktifkankomunitas.php?id_ukm=<?php echo $data['id_ukm'] ?>" class="btn btn-secondary" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan komunitas ini?');"><i class="fas fa-ban"></i></a>
                                            <?php 
                                        } 
                                        ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
