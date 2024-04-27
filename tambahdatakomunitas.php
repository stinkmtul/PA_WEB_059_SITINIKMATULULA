<?php include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_ukm = $_POST['id_ukm'];
    $id_user = $_POST['id_user'];
    $nama_ukm = $_POST['nama_ukm'];
    $nama = $_POST['nama_ukm'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $cek_username = mysqli_query($koneksi, "SELECT * FROM ukm WHERE nama_ukm = '$nama_ukm'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Akun UKM ini telah tersedia.')</script>";
    } else {
        $sqlInsertUkm = mysqli_query($koneksi, "INSERT INTO ukm (id_ukm, nama_ukm, id_user) VALUES ('$id_ukm', '$nama_ukm', '$id_user');");
        $sqlInsertUser = mysqli_query($koneksi, "INSERT INTO user (id_user, nama, username, password, level) VALUES ('$id_user', '$nama_ukm', '$username', '$password', '$level');");

        if ($sqlInsertUkm && $sqlInsertUser) {
            echo "<script>
            window.location.href = 'datakomunitas.php';
            alert('Berhasil membuat akun');
            </script>";
        } else {
            echo "<script>alert('Gagal membuat akun')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data UKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {    
            margin-top: 50px;
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
    <?php include 'navbarsuper.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <br><br><br>
                <form action="" method="post">
                <h3>Data UKM</h3>
                    <div class="mb-3">
                        <?php 
                        $query = mysqli_query($koneksi, "SELECT max(id_ukm) as kodeTerbesar FROM ukm");
                        $data = mysqli_fetch_array($query);
                        $kode = $data['kodeTerbesar'];
                        $urutan = (int) substr($kode, 3, 3);
                        $urutan++;
                        $huruf = "UK";
                        $kode = $huruf . sprintf("%03s", $urutan);
                        ?>
                        <label class="form-label"><b>ID UKM</b></label>
                        <input type="text" readonly class="form-control" name="id_ukm" autocomplete="off" placeholder="ID UKM" value="<?php echo $kode; ?>" required>
                        <?php 
                        $query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM user");
                        $data = mysqli_fetch_array($query);
                        $kode = $data['kodeTerbesar'];
                        $urutan = (int) substr($kode, 3, 3);
                        $urutan++;
                        $huruf = "US";
                        $kode = $huruf . sprintf("%03s", $urutan);
                        ?>
                        <input type="text" hidden readonly class="form-control" name="id_user" autocomplete="off" placeholder="ID User" value="<?php echo $kode; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Nama UKM</b></label>
                        <input type="text" class="form-control" name="nama_ukm" autocomplete="off" placeholder="Masukkan Nama UKM" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><b>Username</b></label>
                            <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Masukkan Username untuk Akun Admin" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><b>Password</b></label>
                            <input type="text" class="form-control" name="password" autocomplete="off" placeholder="Masukkan Password untuk Akun Admin" required>
                        </div>
                    </div>
                    <input hidden type="text" value="adminukm" class="form-control" name="level" autocomplete="off" required>
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                        <a href="datakomunitas.php" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
