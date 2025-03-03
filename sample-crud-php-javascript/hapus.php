<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM barang WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Data deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }

    $conn->close();
}
?>