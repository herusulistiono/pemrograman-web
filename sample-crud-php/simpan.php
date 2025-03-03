<?php 
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$npm  = $conn->real_escape_string($_POST['txtNPM']);
	$nama = $conn->real_escape_string($_POST['txtNama']);
	$jk   = $conn->real_escape_string($_POST['txtKelamin']);
	$nohp = $conn->real_escape_string($_POST['txtNoHP']);

	$query = "INSERT INTO mahasiswa (npm, nama_lengkap, kelamin, no_hp) VALUES ('$npm', '$nama', '$jk', '$nohp')";

    if ($conn->query($query) === TRUE) {
        echo '<h3>Berhasil menambahkan data</h3><a href="index.php">Kembali</a>';
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
}

?>