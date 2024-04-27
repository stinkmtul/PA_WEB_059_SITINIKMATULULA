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

$sqlTampil = mysqli_query($koneksi, "SELECT p.*, u.nama_ukm FROM permintaan p INNER JOIN ukm u ON p.id_ukm = u.id_ukm WHERE p.id_user = '$id_user' and p.status = 'di terima'");

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
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #f8f9fa;
            max-width: 300px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #526D82;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 10px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .ukm-logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
        }

        .ukm-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .btn-danger {
            background-color: #DC3545;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #C82333;
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
                        <img src="img/comunity.png" alt="Logo Komunitas" class="ukm-logo">
                        <h5 class="ukm-name"><?php echo $dataTampil['nama_ukm']; ?></h5>
                        <p class="card-text">Nama : <?php echo $dataTampil['nama_user']; ?></p>
                        <a href="keluarkomunitas.php?id=<?php echo $dataTampil['id_permintaan']; ?>" class="btn btn-danger bi bi-box-arrow-right"> Keluar Komunitas</a>
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
<br><br><br>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <img src="img/comunity.png" alt="Logo Comunity" width="150px">
                    <h3 class="mt-3">Komunitasku</h3>
                    <p class="mt-3">Belum tergabung di komunitas manapun.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
