<?php

session_start();
header('Content-Type: application/json');

require_once 'includes/config.php';



// Simulated data logic - Replace with DB interaction
if (!isset($_SESSION['skills'])) {
    $_SESSION['skills'] = [];
}

$action = $_POST['action'] ?? '';
$skill = trim($_POST['skill'] ?? '');

switch ($action) {
    case 'add_skill':
        if ($skill && !in_array($skill, $_SESSION['skills'])) {
            $_SESSION['skills'][] = $skill;
        }
        echo json_encode(['status' => 'success', 'skills' => $_SESSION['skills']]);
        break;

    case 'remove_skill':
        if (($key = array_search($skill, $_SESSION['skills'])) !== false) {
            unset($_SESSION['skills'][$key]);
            $_SESSION['skills'] = array_values($_SESSION['skills']); // reindex
        }
        echo json_encode(['status' => 'success', 'skills' => $_SESSION['skills']]);
        break;

    case 'get_skills':
        echo json_encode(['status' => 'success', 'skills' => $_SESSION['skills']]);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        break;
}
?>