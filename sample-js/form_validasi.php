<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contoh Validasi Formulir</title>
	<style type="text/css">
		.error { color: red; }
	</style>
</head>
<body>
	<h2>Formulir Registrasi</h2>
	<form id="registrationForm"> <!-- onsubmit="return validateForm()" -->
		<label for="username">Username:</label><br>
		<input type="text" id="username" name="username" placeholder="Username">
		<span class="error" id="usernameError"></span><br><br>

		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email" placeholder="Email">
		<span class="error" id="emailError"></span><br><br>

		<label for="password">Password:</label><br>
		<input type="password" id="password" name="password" placeholder="Password">
		<span class="error" id="passwordError"></span><br><br>
		<button type="button" id="btn-submit">Submit</button>
	</form>

	<script type="text/javascript">
		document.getElementById('btn-submit').onclick = function() {
			let isValid = true;
			document.getElementById("usernameError").innerHTML = ""; //Atribut ID usernameError
			document.getElementById("emailError").innerHTML = ""; //Atribut ID emailError
			document.getElementById("passwordError").innerHTML = ""; //Atribut ID passwordError

			// Validate Username
			const username = document.getElementById("username").value;
			if (username === "") {
				document.getElementById("usernameError").innerHTML = "Username is required.";
				isValid = false;
			}

			// Validate Email
			const email = document.getElementById("email").value;
			const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Notasi Javascript untuk Format Email
			if (email === "") {
				document.getElementById("emailError").innerHTML = "Email is required.";
				isValid = false;
			} else if (!emailPattern.test(email)) {
				document.getElementById("emailError").innerHTML = "Invalid email format.";
				isValid = false;
			}

			// Validate Password
			const password = document.getElementById("password").value;
			if (password === "") {
				document.getElementById("passwordError").innerHTML = "Password is required.";
				isValid = false;
			} else if (password.length < 6) {
				document.getElementById("passwordError").innerHTML = "Password must be at least 6 characters long.";
				isValid = false;
			}

			return isValid;
		};
		
	</script>
</body>
</html>