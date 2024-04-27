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

// Ambil data UKM yang sesuai dengan id pengguna saat ini
$sqlTampil = mysqli_query($koneksi, "SELECT * FROM ukm WHERE id_user = '$id'");
if(mysqli_num_rows($sqlTampil) > 0) {
    $dataTampil = mysqli_fetch_array($sqlTampil);
    $id_ukm = $dataTampil['id_ukm'];
    // Sekarang kita akan menampilkan permintaan bergabung dengan status "tunggu" untuk UKM ini
    $sqlPermintaan = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_ukm = '$id_ukm' AND status = 'menunggu'");
    if(mysqli_num_rows($sqlPermintaan) > 0) {
        // Jika ada permintaan bergabung yang sedang menunggu
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
        <?php include 'navbarukm.php' ?>
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-11" style="margin: 0 auto;">
                    <h3 class="text-center my-4">Permintaan Bergabung</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Alasan Bergabung</th>
                                <th>Tanggal Permintaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            while ($dataPermintaan = mysqli_fetch_array($sqlPermintaan)) {
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $dataPermintaan['nama_user'] ?></td>
                                    <td><?php echo $dataPermintaan['nim'] ?></td>
                                    <td><?php echo $dataPermintaan['alasan_bergabung'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($dataPermintaan['tgl_permintaan'])) ?></td>
                                    <td><?php echo $dataPermintaan['status'] ?></td>
                                    <td>
                                        <a href="validasi.php?id=<?php echo $dataPermintaan['id_permintaan']; ?>" class="btn btn-success bi bi-envelope-check"> Validasi</a>
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

        <?php include 'navbarukm.php' ?>
        <br><br><br>
        <div class="container mt-5">
            <div class="row">
            <center><img src="img/comunity.png" alt="Logo Comunity" width="150px"></center>
                <div class="col-md-11" style="margin: 0 auto;">
                    <h3 class="text-center my-4">Permintaan Bergabung</h3>
                    <div class="no-request">
                        <center><p>Tidak ada permintaan bergabung yang sedang menunggu.</p></center>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
} else {
    echo "Data tidak ditemukan";
}
?>
