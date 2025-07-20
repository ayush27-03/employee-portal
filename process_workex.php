<?php
session_start();
header('Content-Type: application/json');
require_once 'includes/config.php';

$empId = $_SESSION['eid'] ?? null;
$action = $_POST['action'] ?? '';

if (!$empId) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Not authenticated'
  ]);
  exit;
}

try {
  switch ($action) {
    case 'add':
      // Validate input data
      if (empty($_POST['company']) || !is_array($_POST['company'])) {
        throw new Exception('Invalid work experience data');
      }

      $companies = $_POST['company'];
      $durations = $_POST['duration'] ?? array_fill(0, count($companies), '');
      $remarks = $_POST['remarks'] ?? array_fill(0, count($companies), '');

      $conn->beginTransaction();

      // Prepare statement for insertion
      $stmt = $conn->prepare("
                INSERT INTO workex (empId, company, duration, remarks)
                VALUES (?, ?, ?, ?)
            ");
      $insertedIds = [];
      $validEntries = 0;

      // Process each entry
      foreach ($companies as $index => $company) {
        $company = trim($company);
        $duration = trim($durations[$index]);
        $remark = trim($remarks[$index]);

        // Skip empty company names
        if (empty($company))
          continue;

        $stmt->execute([$empId, $company, $duration, $remark]);
        $insertedIds[] = $conn->lastInsertId();
        $validEntries++;
      }

      // If no valid entries were processed
      if ($validEntries === 0) {
        $conn->rollBack();
        throw new Exception('No valid work experience entries provided');
      }

      $conn->commit();

      echo json_encode([
        'status' => 'success',
        'message' => "$validEntries work experience entries added",
        'inserted_ids' => $insertedIds
      ]);
      break;

    case 'get':
      $stmt = $conn->prepare("
                SELECT id, company, duration, remarks 
                FROM workex 
                WHERE empId = :empId AND is_deleted = '0' 
                ORDER BY id DESC
            ");
      $stmt->execute([':empId' => $empId]);
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode([
        'status' => 'success',
        'data' => $data
      ]);
      break;
      
    case 'delete':
      if (empty($_POST['id'])) {
        throw new Exception('Invalid ID for deletion');
      }
      $id = $_POST['id'];
      $stmt = $conn->prepare("UPDATE workex SET is_deleted = '1' WHERE id = :id AND empId = :empId");
      $stmt->execute([
        ':id' => $id, 
        ':empId' => $empId
      ]);
      echo json_encode([
        'status' => 'success',
        'message' => 'Work experience deleted successfully'
      ]);
      break;
    default:
      echo json_encode([
        'status' => 'error',
        'message' => 'Invalid action'
      ]);
  }
} catch (PDOException $e) {
  if (isset($conn) && $conn->inTransaction()) {
    $conn->rollBack();
  }
  echo json_encode([
    'status' => 'error',
    'message' => 'Database error: ' . $e->getMessage()
  ]);
} catch (Exception $e) {
  echo json_encode([
    'status' => 'error',
    'message' => $e->getMessage()
  ]);
}
?>