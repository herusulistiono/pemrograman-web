<?php 
include 'koneksi.php'; 

$result_kategori = $conn->query("SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD - PHP Javascript</title>
	<style type="text/css">
		.error { color: red; }
		table {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			/*width: 100%;*/
		}
		table, th, td {
			border: 1px solid;
		}
		th, td {
			padding: 8px;
			text-align: left;
		}
		tr:hover {background-color: green;}
	</style>
</head>
<body>
	<h2>Tambah Barang</h2>
	<p id="msg_info"></p>
    <form method="POST" id="form-entri" autocomplete="off">
        <label for="nama">Nama Barang:</label><br>
        <input type="text" id="nama" name="txtNama" placeholder="Nama Barang">
        <span class="error" id="namaError"></span><br>

        <label for="kategori">Kategori:</label><br>
        <select id="kategori" name="txtKategori">
        	<option value="">Pilih</option>
            <?php while ($row = $result_kategori->fetch_assoc()): ?>
            	<?php echo '<option value="'.$row['id'].'">'.$row['nama_kategori'].'</option>'; ?>
            <?php endwhile; ?>
        </select>
        <span class="error" id="kategoriError"></span><br>

        <label for="stok">Stok:</label><br>
        <input type="number" id="stok" name="txtStok" placeholder="Stok">
        <span class="error" id="stokError"></span><br>

        <label for="harga">Harga:</label><br>
        <input type="number" step="1" id="harga" name="txtHarga" placeholder="Harga">
        <span class="error" id="hargaError"></span><br><br><br>
        <input type="hidden" name="primary" id="primary">

        <button id="btn-insert" type="submit">Simpan</button><br><br>
    </form>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Item</th>
				<th>Kategori</th>
				<th>Stok</th>
				<th>Harga</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody id="dataBarang"></tbody>
	</table>

	<script type="text/javascript">
		readBarang();

		/*Menampilkan Data Barang*/
		function readBarang() {
			fetch('tampil.php')
			.then(response => response.json())
			.then(data => {
				let table = document.getElementById('dataBarang');
				table.innerHTML = '';  //Kosongkan table
				let no = 1;
				data.forEach((barang) => {
					let row = table.insertRow();
					// Format harga dengan koma menggunakan toLocaleString
					let formattedHarga = parseFloat(barang.harga).toLocaleString('id-ID', { minimumFractionDigits: 0});
					row.innerHTML = `
						<td>${no++}</td>
						<td>${barang.nama_barang}</td>
						<td>${barang.nama_kategori}</td>
						<td style="text-align:center;">${barang.stok}</td>
						<td style="text-align:right;">${formattedHarga}</td>
						<td style="text-align:center;">
							<button class="delete-btn" data-id="${barang.id}"">Delete</button>
							<button class="edit-btn" 
								data-id="${barang.id}"
								data-nama_barang="${barang.nama_barang}"
								data-id_kategori="${barang.id_kategori}"
								data-stok="${barang.stok}" 
								data-harga="${barang.harga}">
								Edit
		                    </button>
						</td>
					`;
				});
			});
		}

		/**
		 * Proses POST untuk mengisi data baru 
		 **/
		document.getElementById('form-entri').addEventListener('submit', function(event) {
			event.preventDefault();  // Prevent default form submission
			let isValid = true;
			document.getElementById("namaError").innerHTML = "";
			document.getElementById("kategoriError").innerHTML = "";
			document.getElementById("stokError").innerHTML = "";
			document.getElementById("hargaError").innerHTML = "";

			const validate_nama = document.getElementById('nama').value;
			const validate_kategori = document.getElementById('kategori').value;
			const validate_stok = document.getElementById('stok').value;
			const validate_harga = document.getElementById('harga').value;
			if (validate_nama === "") {
				document.getElementById("namaError").innerHTML = "Nama Barang harus diisi.";
				isValid = false;
			}else if (validate_kategori === "") {
				document.getElementById("kategoriError").innerHTML = "Pilih Kategori.";
				isValid = false;
			}else if (validate_stok === "") {
				document.getElementById("stokError").innerHTML = "Stok harus diisi.";
				isValid = false;
			}else if (validate_harga === "") {
				document.getElementById("hargaError").innerHTML = "Harga harus diisi.";
				isValid = false;
			}else
			{
				// Create an object to hold the form data
				const formData = {
					nama: document.getElementById('nama').value,
					kategori: document.getElementById('kategori').value,
					stok: document.getElementById('stok').value,
					harga: document.getElementById('harga').value,
					primary: document.getElementById('primary').value
				};

				// Convert the form data object to JSON
				const jsonData = JSON.stringify(formData);
				// Send data using the Fetch API with POST method
		        fetch('simpan.php', {
		            method: 'POST',
		            headers: {
		                'Content-Type': 'application/json'
		            },
		            body: jsonData
		        })
		        .then(response => response.json())
		        .then(data => {
		        	const infoMsg = document.getElementById('msg_info');
		            infoMsg.innerHTML = `${'Success:', data}`;
		            console.log('Success:', data);
		            document.getElementById("form-entri").reset();
		            setTimeout(function () {
		            	location.reload();
		            },800);
		        })
		        .catch(error => {
		            console.error('Error:', error);
		            alert('There was an error submitting the form.');
		        });

			}
			return isValid;
		});

		/**
		 * Update & Menghapus Data per item
		 **/
		document.getElementById('dataBarang').addEventListener('click', function(event) {
			
			if (event.target && event.target.matches('button.edit-btn')) {
				const id = event.target.getAttribute('data-id');
				const nama = event.target.getAttribute('data-nama_barang');
				const kategori = event.target.getAttribute('data-id_kategori');
				const stok = event.target.getAttribute('data-stok');
				const harga = event.target.getAttribute('data-harga');
				document.getElementById('primary').value = id;
				document.getElementById('nama').value = nama;
				document.getElementById('kategori').value = kategori;
				document.getElementById('stok').value = stok;
				document.getElementById('harga').value = harga;
			}

			if (event.target && event.target.matches('button.delete-btn')) {
				const id = event.target.getAttribute('data-id');
				if (confirm('Anda yakin ingin menghapus barang ini?')) {
					const formData = new FormData();
					formData.append('id', id);

					fetch('hapus.php', {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						alert(data.message);
						readBarang(); // Memuat ulang daftar barang
					});
				}
			}
		});

	</script>
</body>
</html>