<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Navbar Styles */
    .navbar {
        background-image: linear-gradient(to right, #184D47, #96BB7C); /* Ubah warna latar belakang */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: bold;
        color: #fff; /* Warna teks brand */
    }

    .navbar-nav .nav-link {
        color: #fff; /* Warna teks link */
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-item .nav-link:hover {
        color: #f8f9fa; /* Warna teks link saat hover */
        transition: color 0.3s ease;
    }

    .navbar-toggler {
        border-color: #fff; /* Warna garis toggler */
    }

    .navbar-toggler-icon {
        background-color: #fff; /* Warna ikon toggler */
    }

    /* Button Styles */
    .navbar .btn {
        background-color: #fff; /* Warna tombol */
        color: #184D47; /* Warna teks tombol */
        border: 2px solid #184D47; /* Ubah border */
        border-radius: 20px;
        padding: 8px 20px;
        transition: background-color 0.3s ease, transform 0.2s ease-in-out;
    }

    .navbar .btn:hover {
        background-color: #96BB7C; /* Warna tombol saat hover */
        color: #fff; /* Warna teks tombol saat hover */
        transform: translateY(-2px);
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-sm d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">Komunitas</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link bi bi-house-fill" href="home.php"> Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bi bi-person-fill-gear" href="datakomunitas.php"> Kelola Data Komunitas</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a href="logout.php" class="nav-link" onclick="return confirm('Yakin ingin logout?');">Logout</a>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>
