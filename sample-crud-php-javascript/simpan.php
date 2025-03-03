<?php
include 'koneksi.php';
// Mendapatkan konten JSON dari POST request
$data = file_get_contents("php://input");

// Mengonversi JSON menjadi array PHP
$formData = json_decode($data, true);
if ( empty($formData['primary'])) 
{
    // Akses data dan lakukan pemrosesan, misalnya simpan ke database
    $nama = $conn->real_escape_string($formData['nama']);
    $kategori = $conn->real_escape_string($formData['kategori']);
    $stok = $conn->real_escape_string($formData['stok']);
    $harga = $conn->real_escape_string($formData['harga']);
    
    $query = "INSERT INTO barang (nama_barang, id_kategori, stok, harga) VALUES ('$nama', '$kategori', '$stok', '$harga')";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();
}
else
{
    // Akses data dan lakukan pemrosesan, misalnya simpan ke database
    $nama = $conn->real_escape_string($formData['nama']);
    $kategori = $conn->real_escape_string($formData['kategori']);
    $stok = $conn->real_escape_string($formData['stok']);
    $harga = $conn->real_escape_string($formData['harga']);
    $id = $conn->real_escape_string($formData['primary']);
    $query = "UPDATE barang SET nama_barang='$nama', id_kategori='$kategori', stok='$stok', harga='$harga' WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Successfully Update']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $conn->close();    
}
?>