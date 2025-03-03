<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "web_lanjut";//Sesuaikan dengan nama database yang dibuat

    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Kesalahan koneksi: " . $conn->connect_error);
    }
?>
