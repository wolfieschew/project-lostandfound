<?php
session_start();
session_destroy(); // Hapus semua session
header("Location: log_in.html"); // Redirect ke halaman login
exit;
?>
