<?php 
include 'koneksi.php'; 

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Mengambil data yang akan diubah
    $query = "SELECT * FROM mahasiswa WHERE id='$id'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $edit_ID = $row['id'];
        $edit_npm = $row['npm'];
        $edit_nama = $row['nama_lengkap'];
        $edit_kelamin = $row['kelamin'];
        $edit_no_hp = $row['no_hp'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $npm = $conn->real_escape_string($_POST['txtNPM']);
    $nama = $conn->real_escape_string($_POST['txtNama']);
    $kelamin = $conn->real_escape_string($_POST['txtKelamin']);
    $no_hp = $conn->real_escape_string($_POST['txtNoHP']);
    $id = $conn->real_escape_string($_POST['txtID']);

    // Update data
    $query = "UPDATE mahasiswa SET npm='$npm', nama_lengkap='$nama', kelamin='$kelamin', no_hp='$no_hp' WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php"); // Kembali ke halaman utama setelah update
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form - Ubah Data</title>
</head>
<body>
	<form method="POST" action="edit_form.php">
		<label for="">NPM:</label><br>
		<input type="text" name="txtNPM" value="<?php echo $edit_npm; ?>"><br>
		<label for="">Nama Lengkap:</label> <br>
		<input type="text" name="txtNama" value="<?php echo $edit_nama; ?>"><br>
		<label for="">Kelamin:</label><br>
		<select name="txtKelamin">
			<option value="">Pilih</option>
			<option value="Laki-laki" <?php echo ($edit_kelamin === 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
			<option value="Perempuan" <?php echo ($edit_kelamin === 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
		</select><br>
		<label for="">No HP:</label><br>
		<input type="text" name="txtNoHP" value="<?php echo $edit_no_hp; ?>"><br><br>
		<input type="hidden" name="txtID" value="<?php echo $edit_ID; ?>">
		<input type="submit" value="Submit">
	</form>
</body>
</html>