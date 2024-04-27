<?php 
include 'koneksi.php';
session_start();

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if (isset($_POST['simpan'])) {
    $id_permintaan = $_POST['id_permintaan'];
    $id_user = $_POST['id_user'];
    $id_ukm = $_POST['id_ukm'];
    $nama_user = $_POST['nama_user'];
    $nim = $_POST['nim'];
    $alasan_bergabung = $_POST['alasan_bergabung'];
    $foto_ektm = $_POST['foto_ektm'];
    $tgl_permintaan = $_POST['tgl_permintaan'];
    $status = $_POST['status'];

    $cekpermintaan = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_ukm = '$id_ukm' && id_user = '$id_user'");
    if (mysqli_num_rows($cekpermintaan) > 0) {
        echo "<script>
            window.location.href = 'inbox.php';
            alert('Anda telah mengirimkan permintaan bergabung di komunitas ini.');
            </script>";
    } else {
        $sqlInsert = mysqli_query($koneksi, "INSERT INTO permintaan (id_permintaan, id_user, id_ukm, nama_user, nim, alasan_bergabung, foto_ektm, tgl_permintaan, status) VALUES ('$id_permintaan', '$id_user', '$id_ukm', '$nama_user', '$nim', '$alasan_bergabung', '$foto_ektm', '$tgl_permintaan', '$status')");

        if ($sqlInsert) {
            echo "<script>
            window.location.href = 'lihatkomunitas.php';
            alert('Berhasil membuat permintaan bergabung');
            </script>";
        } else {
            echo "<script>alert('Gagal membuat permintaan bergabung')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Komunitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 16px;
        }
        h3 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .btn-container button {
            margin-right: 10px;
            background-color: #184D47;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        }
        .btn-container button:hover {
            background-color: #96BB7C;
            transform: translateY(-3px);
        }
        .btn-container a {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        }
        .btn-container a:hover {
            background-color: #ff5252;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <?php include 'navbaruser.php' ?>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label"><b>Nama user</b></label>
                                <input type="text" class="form-control" readonly value="<?php echo $id; ?> - <?php echo $_GET['nama']; ?>">
                            </div>
                            <div class="mb-3">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT MAX(id_permintaan) as kodeTerbesar FROM permintaan");
                                $data = mysqli_fetch_array($query);
                                $kode = $data['kodeTerbesar'];

                                $urutan = (int) substr($kode, 2, 3);
                                $urutan++;

                                $huruf = "PM";
                                $kode = $huruf . sprintf("%03s", $urutan);
                                ?>
                                <input type="text" hidden class="form-control" name="id_permintaan" autocomplete="off" value="<?php echo $kode; ?>" required>
                                <input type="text" hidden readonly class="form-control" name="id_user" autocomplete="off" value="<?php echo $_SESSION['id_user']; ?>" required>
                                <input type="text" hidden readonly class="form-control" name="id_ukm" autocomplete="off" value="<?php echo $id; ?>" required>
                            </div>
                            <?php 
                            $id_userr = $_SESSION['id_user'];
                            $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_userr'");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                            <div class="mb-3">
                                <label class="form-label"><b>Nama user</b></label>
                                <input type="text" readonly class="form-control" name="nama_user" autocomplete="off" placeholder="Masukkan nama user" value="<?php echo $data['nama']; ?>" required>
                            </div>
                            <?php } ?>
                            <div class="mb-3">
                                <label class="form-label"><b>NIM</b></label>
                                <input type="number" class="form-control" name="nim" autocomplete="off" placeholder="Masukkan NIM" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Foto EKTM</b></label>
                                <input type="file" class="form-control" name="foto_ektm" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><b>Alasan bergabung</b></label>
                                <textarea class="form-control" name="alasan_bergabung" id="" cols="10" rows="5" autocomplete="off" placeholder="Masukkan alasan bergabung" required></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="date" hidden class="form-control" name="tgl_permintaan" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" required>
                                <input type="text" hidden class="form-control" name="status" autocomplete="off" value="menunggu" required>
                            </div>
                            <div class="btn-container">
                                <button type="submit" class="btn btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                                <a href="lihatdetail.php?id=<?php echo $id; ?>&nama=<?php echo urlencode($_GET['nama']); ?>" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>