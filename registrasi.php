<?php include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username sudah digunakan. Silakan gunakan username lain.')</script>";
    } else {
        $sqlInsert = mysqli_query($koneksi, "INSERT INTO user (id_user, nama, username, password) VALUES ('$id_user', '$nama', '$username', '$password')");

        if ($sqlInsert) {
            echo "<script>
            window.location.href = 'index.php';
            alert('Berhasil membuat akun');
            </script>";
        } else {
            echo "<script>alert('Gagal membuat akun')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .container h2 {
            text-align: center;
            color: #184D47;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control { 
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #184D47;
        }

        .btn-simpan {
            padding: 8px 5px;
            border: none;
            border-radius: 5px;
            background-color: #184D47;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            width: 45%; /* Adjust the width */
        }

        .btn-simpan:hover {
            background-color: #96BB7C;
        }

        .error-message {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    <center><img src="img/comunity.png" alt="Logo Comunity" width="150px"></center>
        <form action="" method="post">
            <div class="form-group">
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
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" autocomplete="off" placeholder="Masukkan Nama" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password" autocomplete="off" placeholder="Masukkan Password" required>
            </div>
            <div class="btn-container">
				<center>
                <button type="submit" class="btn-simpan" name="simpan">Registrasi</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
				</center>
            </div>
        </form>
    </div>
</body>
</html>
