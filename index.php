<?php
session_start();
include 'koneksi.php';

if(isset($_SESSION['level'])) {
    header("Location: home.php");
    exit;
}
    
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if($password == $row['password']) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['nama'] = $row['nama'];
            echo "<script>
            window.location.href = 'home.php';
            alert('Berhasil login');
            </script>";
            exit;
        } else {
            echo "<script>
            alert('Username atau password salah');
            </script>";
        }
    } else {
        echo "<script>
        alert('Username atau password salah');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 20%; /* Mengurangi lebar kontainer */
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control { 
            width: calc(100% - 20px); /* Menyesuaikan lebar input field */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #184D47;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #184D47;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #96BB7C;
        }
        .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #184D47;
            text-decoration: none;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><img src="img/comunity.png" alt="Logo Comunity" width="150px"></center>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
            <a href="registrasi.php" class="btn-link">Belum punya akun?</a>
        </form>
    </div>
</body>
</html>
