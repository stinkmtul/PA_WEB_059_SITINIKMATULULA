<?php

$servername = 'localhost';
$username = 'root';
$password ='';
$database = 'dbukm';

//buat koneksi
$koneksi = mysqli_connect($servername, $username, $password, $database);

//cek koneksi
if ($koneksi == null) {
    die('Koneksi gagal: '.mysqli_connect_error());
} else {
    // echo 'Koneksi berhasil';
}