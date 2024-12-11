<?php
// db_connection.php
$servername = "localhost";
$username = "root"; // username default XAMPP
$password = ""; // password default XAMPP
$dbname = "lost_and_found_items"; // nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
