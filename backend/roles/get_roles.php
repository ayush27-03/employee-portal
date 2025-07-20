<?php
header('Content-Type: application/json');
require_once '../../includes/config.php';

if (!isset($_GET['roleId']) || empty($_GET['roleId'])) {
    echo json_encode(['error' => 'Role ID not provided']);
    exit;
}

$roleId = $_GET['roleId'];

try {
    $sql = "SELECT
            r.id,
            r.name AS roleName,
            r.status AS roleStatus,
            r.description AS roleDescription,
            COUNT(e.id) AS employee_count
            FROM roles r
            LEFT JOIN employee e ON r.id = e.role
            WHERE r.id = :roleId
            GROUP BY r.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':roleId', $roleId, PDO::PARAM_INT);
    $stmt->execute();

    $role = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($role) {
        echo json_encode([
            'id' => $role['id'],
            'roleName' => $role['roleName'],
            'roleDescription' => $role['roleDescription'],
            'roleStatus' => $role['roleStatus'],
            'employee_count' => $role['employee_count']
        ]);
    } else {
        echo json_encode(['error' => 'Role not found']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>