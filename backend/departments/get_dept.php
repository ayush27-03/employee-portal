<?php
header('Content-Type: application/json');
require_once '../../includes/config.php';

if (!isset($_GET['deptId']) || empty($_GET['deptId'])) {
  echo json_encode(['error' => 'Department Id not provided']);
  exit;
}

$deptId = $_GET['deptId'];

try {
  $sql = "SELECT
    d.name AS deptName,
    d.status AS deptStatus,
    COUNT(e.id) AS employee_count
    FROM department d
    LEFT JOIN employee e ON d.id = e.department
    WHERE d.id = :deptId
    GROUP BY d.id
    ";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':deptId', $deptId, PDO::PARAM_INT);
  $stmt->execute();

  $department = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($department) {
    echo json_encode($department);
  } else {
    echo json_encode(['error' => 'Department not found.']);
  }

} catch (PDOException $e) {

  echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}

?>