<?php
// Mulai sesi untuk mendapatkan informasi user
session_start();

var_dump($_POST); // Mencetak semua data yang diterima dari form

// Pastikan pengguna sudah login dan memiliki user_id dalam sesi
if (!isset($_SESSION['user_id'])) {
    die("User ID is not set. Please log in.");
}
$user_id = $_SESSION['user_id']; // Mendapatkan user_id dari session

// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'lost_and_found_items';
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$type = $_POST['type'];  // 'lost' atau 'found'
$item_name = $_POST['item_name'];
$category = $_POST['category'];
$date_of_event = $_POST['date_of_loss'];
$description = $_POST['description'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$location = $_POST['location'];

// Proses upload gambar
$photo_path = '';
if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $photo_path = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Pastikan data sudah diterima
echo "Data Type: " . $type . "<br>"; // Debugging untuk melihat apakah 'type' sudah diterima dengan benar

// Query untuk menyimpan data
$sql = "INSERT INTO items (type, item_name, category, date_of_event, description, email, phone_number, location, photo_path, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssi", $type, $item_name, $category, $date_of_event, $description, $email, $phone_number, $location, $photo_path, $user_id);

if ($stmt->execute()) {
    // Berhasil, alihkan ke halaman dashboard
    header("Location: user_dashboard.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
