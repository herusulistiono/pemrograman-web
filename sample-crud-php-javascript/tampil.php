<?php
include 'koneksi.php';

$query  = "SELECT  
            b.id, 
            b.nama_barang, 
            b.id_kategori, 
            k.nama_kategori, 
            b.stok, 
            b.harga 
        FROM barang b
        JOIN kategori k ON b.id_kategori = k.id";
        
$result = $conn->query($query);

$barang = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $barang[] = $row;
    }
}
echo json_encode($barang);

$conn->close();
?>
