<?php
/**
 * Updates employee data
 * Processes form submission and returns JSON response
 */

header('Content-Type: application/json');
require_once '../../includes/config.php';

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Validate required fields
$requiredFields = ['employee_id', 'first_name', 'last_name', 'department', 'role'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Missing required fields: ' . implode(', ', $missingFields)
    ]);
    exit;
}

$employeeId = (int)$_POST['employee_id'];
$firstName = trim($_POST['first_name']);
$lastName = trim($_POST['last_name']);
$email = trim($_POST['email'] ?? '');
$department = (int)$_POST['department'];
$role = (int)$_POST['role'];


// Validate employee ID
if ($employeeId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid employee ID']);
    exit;
}

if (strlen($firstName) < 2 || strlen($lastName) < 2) {
    echo json_encode(['success' => false, 'message' => 'First name and last name must be at least 2 characters long']);
    exit;
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

if (!in_array($status, [0, 1])) {
    echo json_encode(['success' => false, 'message' => 'Invalid status value']);
    exit;
}

try {
    // Check if employee exists
    $checkStmt = $conn->prepare("SELECT id FROM employee WHERE id = :id");
    $checkStmt->bindParam(':id', $employeeId, PDO::PARAM_INT);
    $checkStmt->execute();
    
    if (!$checkStmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Employee not found']);
        exit;
    }

    $deptStmt = $conn->prepare("SELECT id FROM department WHERE id = :id AND status = '1'");
    $deptStmt->bindParam(':id', $department, PDO::PARAM_INT);
    $deptStmt->execute();
    
    if (!$deptStmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Invalid department selected']);
        exit;
    }

    $roleStmt = $conn->prepare("SELECT id FROM roles WHERE id = :id AND status = '1'");
    $roleStmt->bindParam(':id', $role, PDO::PARAM_INT);
    $roleStmt->execute();
    
    if (!$roleStmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Invalid role selected']);
        exit;
    }
    
    $updateFields = [
        'first_name = :first_name',
        'last_name = :last_name',
        'email = :email',
        'department = :department',
        'role = :role',
        'status = :status'
    ];
    
    $params = [
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':email' => $email,
        ':department' => $department,
        ':role' => $role,
        ':status' => $status,
        ':id' => $employeeId
    ];
    
    $sql = "UPDATE employee SET " . implode(', ', $updateFields) . " WHERE id = :id";
    $updateStmt = $conn->prepare($sql);
    
    foreach ($params as $param => $value) {
        $updateStmt->bindValue($param, $value);
    }
    
    $updateStmt->execute();
    
    if ($updateStmt->rowCount() > 0) {
        echo json_encode([
            'success' => true, 
            'message' => 'Employee updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'No changes were made or employee not found'
        ]);
    }
    
} catch (PDOException $e) {
    error_log("Database error in update_employee.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Database error occurred. Please try again.'
    ]);
}
?>
