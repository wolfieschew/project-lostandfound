<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: log_in.html");
    exit;
}

$host = 'localhost';
$db = 'lost_and_found_items';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Periksa apakah data form sudah diterima
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $address = $_POST['address'];
        $user_id = $_SESSION['user_id']; // Ambil user_id dari session

        // Query untuk memperbarui data pengguna
        $stmt = $pdo->prepare("UPDATE users SET address = :address WHERE id = :id");
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT); // Bind :id ke $user_id

        // Eksekusi query
        if ($stmt->execute()) {
            header("Location: profile.php");
            exit;
        } else {
            echo "Gagal memperbarui data.";
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
