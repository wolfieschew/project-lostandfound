<?php
// Pastikan ID item ada di query string
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Koneksi ke database
    require_once('db_connection.php');

    // Query untuk menghapus item berdasarkan ID
    $sql = "DELETE FROM items WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $item_id);
        if ($stmt->execute()) {
            // Penghapusan berhasil, bisa menambahkan pesan sukses atau redirect ke halaman lain
            header('Location: activity.php'); // Redirect ke halaman activity setelah penghapusan
        } else {
            // Jika gagal
            echo "Terjadi kesalahan saat menghapus item.";
        }
    } else {
        echo "Terjadi kesalahan pada query.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID item tidak ditemukan.";
}
