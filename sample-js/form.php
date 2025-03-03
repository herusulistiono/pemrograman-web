<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form POST with JSON</title>
</head>
<body>
<h2>Submit Your Information</h2>
<form id="form_user">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" required></textarea><br><br>
    <button type="submit">Submit</button>
</form>
<hr>
<div id="hasil"></div>
<script>
    // Handle form submission
    document.getElementById('form_user').addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent default form submission

        // Create an object to hold the form data
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            message: document.getElementById('message').value
        };

        // Convert the form data object to JSON
        const jsonData = JSON.stringify(formData);

        // Send data using the Fetch API with POST method
        fetch('hasil.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: jsonData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            alert('Form submitted successfully!');
            const displayDiv = document.getElementById('hasil');
            // Menampilkan form data pada div#hasil
            displayDiv.innerHTML = `
                <p><strong>Name:</strong> ${formData.name}</p>
                <p><strong>Email:</strong> ${formData.email}</p>
                <p><strong>Message:</strong> ${formData.message}</p>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error submitting the form.');
        });
    });
</script>
</body>
</html>