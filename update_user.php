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
        $userId = $_POST['user_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $nim = $_POST['nim'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Query untuk memperbarui data pengguna
        $stmt = $pdo->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, nim = :nim, email = :email, phone = :phone WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

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
