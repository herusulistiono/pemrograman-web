<?php
// Mendapatkan konten JSON dari POST request
$data = file_get_contents("php://input");

// Mengonversi JSON menjadi array PHP
$formData = json_decode($data, true);

if ($formData) {
    // Akses data dan lakukan pemrosesan, misalnya simpan ke database
    $name = $formData['name'];
    $email = $formData['email'];
    $message = $formData['message'];

    // Menampilkan pesan sukses
    echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid form data']);
}
?>
