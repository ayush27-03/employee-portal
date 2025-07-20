<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: dashboard.php');
  exit;
}

// Collect and sanitize input data
$firstName = trim($_POST['first_name']);
$lastName = trim($_POST['last_name']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$department = $_POST['department'];
$role = $_POST['role'];
$status = $_POST['status'];
$phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
$gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
$maritalStatus = !empty($_POST['marital_status']) ? trim($_POST['marital_status']) : null;

try {
  function generateUniqueUsername($name, $conn)
  {
    $base = strtolower(preg_replace('/\s+/', '', $name));
    do {
      $username = $base . rand(1000, 9999);
      $stmt = $conn->prepare("SELECT id FROM employee WHERE username = ?");
      $stmt->execute([$username]);
    } while ($stmt->rowCount() > 0);
    return $username;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate username if empty
    $stmt = $conn->prepare("SELECT id FROM employee WHERE username = :username");
    if (empty($_POST['username'])) {
      $fullName = $_POST['first_name'] . $_POST['last_name'];
      $_POST['username'] = generateUniqueUsername($fullName, $conn);
    }

    $sql = "INSERT INTO employee (
        first_name, last_name, password, email, 
        department, role, status, phone, gender, marital_status
    ) VALUES (
        :first_name, :last_name, :username, :password, :email,
        :department, :role, :status, :phone, :gender, :marital_status
    )";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':first_name' => $firstName,
      ':last_name' => $lastName,
      ':password' => $password,
      ':email' => $email,
      ':department' => $department,
      ':role' => $role,
      ':phone' => $phone,
      ':gender' => $gender,
      ':marital_status' => $maritalStatus
    ]);

    $_SESSION['success'] = 'Employee added successfully';
    header('Location: employees.php');
    exit;
  }
  // Check if username already exists
  $stmt->execute([':username' => $username]);

  if ($stmt->rowCount() > 0) {
    $_SESSION['error_message'] = 'Username already exists';
    header('Location: dashboard.php');
    exit;
  }
} catch (PDOException $e) {
  $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
  header('Location: dashboard.php');
  exit;
}