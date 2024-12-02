<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: log_in.html");
    exit;
}

// Konfigurasi database
$host = 'localhost';
$db = 'lost_and_found_items';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Periksa apakah file diunggah
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
        $userId = $_POST['user_id'];
        $file = $_FILES['profile_picture'];

        // Validasi file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Format file tidak didukung.";
            exit;
        }

        // Tentukan lokasi penyimpanan
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $filePath = $uploadDir . $fileName;

        // Pindahkan file ke server
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Simpan nama file ke database
            $stmt = $pdo->prepare("UPDATE users SET profile_picture = :profile_picture WHERE id = :id");
            $stmt->bindParam(':profile_picture', $fileName);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: profile.php");
            exit;
        } else {
            echo "Gagal mengunggah file.";
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
