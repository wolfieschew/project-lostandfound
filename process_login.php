<?php
session_start();

$host = 'localhost';
$db = 'lost_and_found_items';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query untuk mengambil data user berdasarkan email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validasi user dan password
        if ($user && password_verify($password, $user['password'])) {
            // Simpan data ke dalam sesi setelah $user valid
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['role'] === 'user') {
                header("Location: user_dashboard.html");
            }
            exit;
        } else {
            echo "Email atau password salah!";
        }
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
