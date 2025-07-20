<?php
session_start();
require_once 'includes/config.php';
// Check if session has eid
if (!isset($_SESSION['eid'])) {
    die("Employee not logged in.");
}

// If download button clicked
if (isset($_GET['download_csv'])) {
    $eid = $_SESSION['eid'];
    $stmt = $conn->prepare("SELECT * FROM employee WHERE id = :id");
    $stmt->execute([':id' => $eid]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee) {
        // CSV file name
        $csvFileName = "employee_" . $eid . "_data.csv";

        // Send headers to force download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $csvFileName . '"');

        $output = fopen('php://output', 'w');

        // Write headers (column names)
        fputcsv($output, array_keys($employee));

        // Write data row
        fputcsv($output, $employee);

        // Closing the file
        fclose($output);
        exit;
    } else {
        die("No record found for this employee.");
    }
}
?>