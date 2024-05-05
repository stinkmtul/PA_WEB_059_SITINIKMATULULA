<?php include 'koneksi.php' ;
session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} elseif ($_SESSION['level'] != 'user') {
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            height: 300spx; /* Menentukan ketinggian kartu */
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

        .ukm-name {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .ukm-logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
        }

        .ukm-info {
            margin-bottom: 20px;
            font-size: 1rem;
            color: #555;
        }
            
        /* CSS untuk tombol */
        .btn-social-media,
        .btn-detail {
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            margin-right: 10px;
            width: 100%; /* Menentukan lebar tombol */
        }

        .btn-social-media {
            background-color: #E1306C;
        }

        .btn-detail {
            background-color: #4CAF50;
        }

        .btn-social-media:hover {
            background-color: #BF2050;
            color: #fff; /* Warna tulisan menjadi putih saat dihover */
        }

        .btn-detail:hover {
            background-color: #388E3C;
            color: #fff; /* Warna tulisan menjadi putih saat dihover */
        }

    </style>
</head>
<body>
<?php include 'navbaruser.php' ?>
<br><br><br>
<div class="container">
    <h3 class="text-center mb-4">Daftar Komunitas</h3>
    <div class="row">
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM ukm WHERE status = 'aktif'");
        $count = 0;
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img src="file_komunitas/<?php echo $data['logo']; ?>" class="img-fluid" alt="logo">
                        <div class="ukm-info">
                            <h3><strong><?php echo $data['nama_ukm'] ?></strong></h3>
                            <p>Anggota : <?php echo $data['jumlah_anggota'] ?></p>
                        </div>
                        <a href="<?php echo $data['sosialmedia']; ?>" class="btn btn-social-media fab fa-instagram"></a>
                        <a href="lihatdetail.php?id=<?php echo $data['id_ukm']; ?>&nama=<?php echo urlencode($data['nama_ukm']); ?>" class="btn btn-detail"> Gabung</a>
                    </div>
                </div>
            </div>
            <?php
            $count++;
            if ($count % 4 == 0) {
                echo '</div><div class="row">';
            }
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>