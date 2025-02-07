<?php
include 'koneksi.php'; 

session_start();
if ($_SESSION['level'] == "") {
    header("location:index.php");
} elseif ($_SESSION['level'] != 'user') {
    echo "<script>
    window.location.href = 'index.php';
    alert('Anda tidak memiliki akses untuk masuk kehalaman ini');
    </script>";
}

$id_user = $_SESSION['id_user'];

$sqlTampil = mysqli_query($koneksi, "SELECT p.*, u.nama_ukm, u.logo FROM permintaan p INNER JOIN ukm u ON p.id_ukm = u.id_ukm WHERE p.id_user = '$id_user' and p.status = 'di terima'");

if(mysqli_num_rows($sqlTampil) > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitasku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #f8f9fa;
            max-width: 270px;
            height: 370px; /* Menetapkan tinggi tetap untuk kartu */
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Menempatkan konten di tengah vertikal */
            height: 100%; /* Mengisi seluruh tinggi kartu */
        }

        .ukm-logo {
            width: auto; /* Biarkan lebar gambar menyesuaikan */
            max-height: 100%; /* Menetapkan tinggi maksimum gambar */
            margin: 0 auto 20px;
            display: block;
        }

        .ukm-name {
            font-size: 2rem;
            font-weight: bold;
            color: #555;
            letter-spacing: 1px;
        }

        .btn {
            border-radius: 30px !important;/* Mengatur bentuk tombol menjadi oval */
            font-size: 16px; /* Meningkatkan ukuran font */
            padding: 10px 20px; /* Menambahkan padding pada tombol */
            margin-left: 5px; /* Menambahkan jarak antara tombol */
        }
    </style>
</head>
<body>
<?php include 'navbaruser.php' ?>
<br><br><br>
<div class="container">
    <h3 class="text-center mb-4">Komunitasku</h3>
    <div class="row">
        <?php while ($dataTampil = mysqli_fetch_array($sqlTampil)) { ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <img src="file_komunitas/<?php echo $dataTampil['logo']; ?>" class="img-fluid" alt="logo">
                        <h3 class="ukm-name"><?php echo $dataTampil['nama_ukm']; ?></h3>
                        <a href="keluarkomunitas.php?id=<?php echo $dataTampil['id_permintaan']; ?>" class="btn btn-danger bi bi-box-arrow-right"> Keluar</a>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
} else {
?>

<?php include 'navbaruser.php'; ?>
<br><br><br>`
<div class="container mt-5">
        <div class="row">
        <center><img src="img/comunity.png" alt="Logo Comunity" width="150px"></center>
            <div class="col-md-11" style="margin: 0 auto;">
                <h3 class="text-center my-4">Komunitasku</h3>
                <div class="no-request">
                    <center><p>Belum tergabung di komunitas manapun.</p></center>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
