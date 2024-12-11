<?php
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

// Ambil ID dari query string
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id > 0) {
    // Query untuk mengambil data item berdasarkan ID
    $sql = "SELECT * FROM items WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        // Kirim data dalam format JSON
        echo json_encode($item);
    } else {
        echo json_encode(['error' => 'Item not found']);
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid item ID']);
}
