<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "lost_and_found_items");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $status = $_POST['status'];

    $sql = "UPDATE activities SET title = ?, details = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $details, $status, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Activity updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating activity"]);
    }

    $stmt->close();
}

$conn->close();
?>
