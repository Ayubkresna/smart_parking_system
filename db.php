<?php
$host     = "localhost";     // biasanya 'localhost'
$user     = "root";          // username MySQL kamu
$password = "";              // password MySQL kamu (kosong jika default di XAMPP)
$dbname   = "smart_parking"; // nama database yang kamu buat

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
