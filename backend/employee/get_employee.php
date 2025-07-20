<?php

header('Content-Type: application/json');
require_once '../../includes/config.php';

$employeeId = (int)$_GET['id'];

try {
    // Fetch employee data
    $stmt = $conn->prepare("
        SELECT e.*, d.name as department_name, r.name as role_name 
        FROM employee e 
        LEFT JOIN department d ON e.department = d.id 
        LEFT JOIN roles r ON e.role = r.id 
        WHERE e.id = :id
    ");
    $stmt->bindParam(':id', $employeeId, PDO::PARAM_INT);
    $stmt->execute();
    
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$employee) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Employee not found']);
        exit;
    }

    // Fetch all departments
    $deptStmt = $conn->prepare("SELECT id, name FROM department WHERE status = '1' ORDER BY name");
    $deptStmt->execute();
    $departments = $deptStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch all roles
    $roleStmt = $conn->prepare("SELECT id, name FROM roles WHERE status = '1' ORDER BY name");
    $roleStmt->execute();
    $roles = $roleStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return success response
    echo json_encode([
        'success' => true,
        'employee' => $employee,
        'departments' => $departments,
        'roles' => $roles
    ]);
    
} catch (PDOException $e) {
    error_log("Database error in get_employee.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Database error occurred. Please try again.'
    ]);
}
?>
