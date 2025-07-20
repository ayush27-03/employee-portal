<?php
session_start();
header('Content-Type: application/json');
require_once '..\..\includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $deptId = intval($_POST['id']);

    $stmt = $conn->prepare("UPDATE department SET is_deleted = '1' WHERE id = :id");
    $stmt->bindParam("id", $deptId);
    $stmt->execute();

    if ($stmt->fetchAll(PDO::FETCH_ASSOC) > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No department found or already deleted.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request.']);
