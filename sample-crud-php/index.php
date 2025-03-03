<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
</head>
<body>
	<?php 
		include 'koneksi.php'; 
		$query = "SELECT * FROM mahasiswa";
		$result = $conn->query($query);
	?>
	<a href="form.php">Tambah</a>
	<table border="1" cellpadding="2" cellspacing="2">
		<thead>
			<tr>
				<th>NPM</th>
				<th>Nama Lengkap</th>
				<th>Kelamin</th>
				<th>No Hp</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo '<tr>';
					echo '<td>'.$row['npm'].'</td>';
					echo '<td>'.$row['nama_lengkap'].'</td>';
					echo '<td>'.$row['kelamin'].'</td>';
					echo '<td>'.$row['no_hp'].'</td>';
					echo '<td>
							<a href="edit_form.php?id='.$row['id'].'">Edit</a> &nbsp;
							<a href="hapus.php?id='.$row['id'].'">Hapus</a>
						</td>';
					echo '</tr>';
				}
			} else {
				echo '<tr><td colspan="5">Data masih kosong</td></tr>';
			}
			
			$conn->close(); //Close Koneksi
			?>
		</tbody>
	</table>
</body>
</html>