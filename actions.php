<?php
require 'lost_and_found_items'; // Hubungkan dengan database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $reportId = $_POST['id'];

    if ($action === 'update_status') {
        $newStatus = $_POST['status'];
        $stmt = $pdo->prepare("UPDATE laporan_barang SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $reportId]);
        echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM laporan_barang WHERE id = ?");
        $stmt->execute([$reportId]);
        echo json_encode(['success' => true, 'message' => 'Report deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
    exit;
}
?>

