<?php
session_start();

require_once 'includes/config.php';

header('Content-Type: application/json');

// Validate session
if (!isset($_SESSION['eid'])) {
  echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
  exit;
}

$empId = $_SESSION['eid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload') {
  $degId = intval($_POST['degree']);
  $iid = intval($_POST['institution']);
  $issueDate = date('Y-m-d');
  $issuer = 'System Upload';

  // 1. Insert into `map` table (if not already mapped)
  $stmt = $conn->prepare("SELECT id FROM map WHERE eid = ? AND degId = ? AND iid = ? AND is_deleted = '0'");
  $stmt->bindParam("iii", $empId, $degId, $iid);
  $stmt->execute();

  if ($stmt->fetchAll(PDO::FETCH_ASSOC) === 0) {
    $insertMap = $conn->prepare("INSERT INTO map (eid, degId, iid) VALUES (?, ?, ?)");
    $insertMap->bindParam("iii", $empId, $degId, $iid);
    $insertMap->execute();
  }

  if (isset($_FILES['certification']) && $_FILES['certification']['error'] === 0) {
    $allowedExts = ['pdf', 'jpg', 'jpeg', 'png'];
    $fileTmp = $_FILES['certification']['tmp_name'];
    $fileName = basename($_FILES['certification']['name']);
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExts)) {
      echo json_encode(['status' => 'error', 'message' => 'Invalid file type.']);
      exit;
    }

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    $newFileName = time() . "_" . preg_replace("/[^a-zA-Z0-9_.]/", "_", $fileName);
    $fullPath = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmp, $fullPath)) {
      // Save record in certifications table
      $insertCert = $conn->prepare("
                INSERT INTO certifications (empId, name, issuer, issueDate, fileName, filePath, status)
                VALUES (?, ?, ?, ?, ?, ?, '1')
            ");
      $displayName = "Certificate for Degree ID $degId";
      $insertCert->bindParam("isssss", $empId, $displayName, $issuer, $issueDate, $newFileName, $fullPath);
      $insertCert->execute();

      echo json_encode(['status' => 'success', 'message' => 'Degree and certificate uploaded']);
      exit;
    } else {
      echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
      exit;
    }
  } else {
    echo json_encode(['status' => 'success', 'message' => 'Degree mapped without certificate.']);
    exit;
  }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
