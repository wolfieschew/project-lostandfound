<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: log_in.html");
    exit;
}

// Cek apakah ada data user_id yang dikirimkan melalui POST
if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    
    // Database connection
    $host = 'localhost';
    $db = 'lost_and_found_items';
    $user = 'root';
    $pass = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Ambil data user berdasarkan user_id
        $stmt = $pdo->prepare("SELECT profile_picture FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Cek apakah gambar profil ada
        if ($user && $user['profile_picture']) {
            $profilePicturePath = 'uploads/' . $user['profile_picture'];
            
            // Hapus gambar dari server
            if (file_exists($profilePicturePath)) {
                unlink($profilePicturePath);
            }
            
            // Update kolom profile_picture di database menjadi NULL
            $updateStmt = $pdo->prepare("UPDATE users SET profile_picture = NULL WHERE id = :id");
            $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $updateStmt->execute();
            
            // Redirect kembali ke halaman profil setelah menghapus gambar
            header("Location: profile.php");
            exit;
        } else {
            echo "Gambar profil tidak ditemukan!";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "ID pengguna tidak ditemukan!";
}
?>
