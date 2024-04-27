<?php include 'koneksi.php';
session_start();
if ($_SESSION['level'] == "") {
	header("location:index.php");
} 
elseif ($_SESSION['level'] != 'user' && $_SESSION['level'] != 'adminukm' && $_SESSION['level'] != 'superadmin'){
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Komunitas</title>
    <?php 
      if ($_SESSION['level'] == 'superadmin') {
        include 'navbarsuper.php';
      } elseif ($_SESSION['level'] == 'adminukm') {
        include 'navbarukm.php';
      } else {
        include 'navbaruser.php';
      }
    ?>
    <style>
        body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .btn-custom {
        background-color: #184D47;
        color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        transition: background-color 0.3s ease, transform 0.2s ease-in-out;
    }

    .btn-custom:hover {
        background-color: #96BB7C;
        color: #fff;
        transform: translateY(-3px);
    }

    .hero {
        padding: 100px 0;
        text-align: center;
    }

    .hero-content {
        color: #343a40;
    }

    .jumbotron {
        background-color: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .user-info {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 15px 20px;
        border-radius: 15px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: opacity 0.3s ease;
    }

    .user-info p {
        margin: 5px 0;
        font-size: 16px;
        color: #343a40;
    }

    .user-info:hover {
        opacity: 0.8;
    }

    .jumbotron h1 {
        color: #184D47;
        margin-bottom: 20px;
    }

    .jumbotron p {
        color: #6c757d;
        margin-bottom: 20px;
    }

    .jumbotron hr {
        background-color: #007bff;
        height: 2px;
        margin: 20px auto;
        width: 50px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .img-logo {
        transition: transform 0.2s ease-in-out;
    }

    .img-logo:hover {
        transform: scale(1.1);
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }
    </style>
</head>
<body>
<section class="hero" id="hero">
    <div class="hero-content">
        <div class="container">
            <div class="jumbotron">
                <div class="user-info">
                <?php
                    if(isset($_SESSION['nama'])) {
                        echo "<p><span class='fas fa-id-card'></span> : " . $_SESSION['id_user'] . "</p>";
                        echo "<p><span class='fas fa-user'></span> : " . $_SESSION['nama'] . "</p>";
                        
                    }
                    ?>
                </div>
                <div>
                <center><img src="img/comunity.png" alt="Logo Comunity" width="150px"></center>
                    <h1 class="display-4">Selamat Datang di Komunitas Website</h1>
                    <hr class="my-4" style="color: #184D47;">
                    <p>Tentukan dan jelajahi minat Anda dengan bergabung dalam komunitas.</p>
                    <?php 
                        if ($_SESSION['level'] == 'user') {
                            echo '<a class="btn btn-custom" href="lihatkomunitas.php" role="button">Daftar Sekarang</a>';
                            echo '&nbsp;&nbsp;';
                            echo '<a class="btn btn-custom" href="komunitasku.php" role="button">Lihat Komunitasku</a>';
                        } elseif ($_SESSION['level'] == 'adminukm') {
                            echo '<a class="btn btn-custom" href="profilkomunitas.php" role="button">Kelola Profil Komunitas</a>';
                        } else {
                            echo '<a class="btn btn-custom" href="datakomunitas.php" role="button">Kelola Data Komunitas</a>';
                        }
                    ?>
                    <br><br>
                </div>

            </div>
        </div>
    </div>
</section>
</body>
</html>