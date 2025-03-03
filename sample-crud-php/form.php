<!DOCTYPE html>
<html>
<head>
	<title>Form - Tambah Data</title>
</head>
<body>
	<form method="POST" action="simpan.php">
		<label for="">NPM:</label><br>
		<input type="text" name="txtNPM" required><br>
		<label for="">Nama Lengkap:</label> <br>
		<input type="text" name="txtNama" required><br>
		<label for="">Kelamin:</label><br>
		<select name="txtKelamin" required>
			<option value="">Pilih</option>
			<option value="Laki-laki">Laki-laki</option>
			<option value="Perempuan">Perempuan</option>
		</select><br>
		<label for="">No HP:</label><br>
		<input type="text" name="txtNoHP" required><br><br>
		<input type="submit" value="Submit">

		<!-- atribut required merupakan validasi bahwa field wajib diisi -->
	</form>
</body>
</html>