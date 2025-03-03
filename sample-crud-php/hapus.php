<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    $id = $conn->real_escape_string($_GET['id']);

    $query = "DELETE FROM mahasiswa WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        echo '<h3>Data Berhasil dihapus</h3><a href="index.php">Kembali</a>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
