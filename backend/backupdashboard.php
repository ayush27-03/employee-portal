<?php
require_once '../includes/config.php';


$search_query = $_GET['q'] ?? '';
$per_page = $_GET['per_page'] ?? 10;
$page = $_GET['page'] ?? 1;

try {
    // Get only count values for multiple cards
  // Build search query
  $sql = "SELECT employee.*, department.name as deptName, roles.name as roleName FROM employee JOIN department ON employee.department = department.id JOIN roles ON employee.role = roles.id";
  $params = [];

  // if (!empty($search_query)) {
  //     $sql .= " WHERE username LIKE :search OR first_name LIKE :search OR last_name LIKE :search OR department LIKE :search";
  //     $params[':search'] = '%' . $search_query . '%';
  // }

  // $sql .= " ORDER BY id";

  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // session_destroy();
  // echo "<pre>";print_r($data);die;


} catch (PDOException $e) {
  $error_message = "Database error: " . $e->getMessage();
  $data = [];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/design-system.css">
    <!-- <link rel="stylesheet" href="../css/components.css"> -->
    <link rel="stylesheet" href="../css/adminpanel.css">
</head>

<body class="admin-page">
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Include Sidebar -->
    <?php include 'sidebar.php'; ?>


    <!-- Main Content -->
    <main class="admin-main-content">
        <div class="admin-container">
            <!-- Page Header -->
            <div class="admin-page-header">
                <div class="header-title">
                    <h1>User Management</h1>
                    <p>Manage all user accounts in the system</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Add User
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="admin-stats-grid">
                <div class="stats-card">
                    <div class="stats-icon bg-blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-info">
                        <h3 style="margin-bottom: var(--space-2);"><?php echo count($data); ?></h3>
                        <!-- <h3>142</h3> -->
                        <p>Total Users</p>
                    </div>
                </div>
                <div class="stats-card">
                    <div class="stats-icon bg-green">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stats-info">
                        <h3 style="margin-bottom: var(--space-2);">
                            <?php echo count(array_filter($data, fn($emp) => strtolower($emp['role']) != 'admin')); ?>
                        </h3>
                        <!-- <h3>128</h3> -->
                        <p>Active Users</p>
                    </div>
                </div>
                <div class="stats-card">
                    <div class="stats-icon bg-orange">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stats-info">
                        <h3 style="margin-bottom: var(--space-2);">
                            <?php echo count(array_filter($data, fn($emp) => strtolower($emp['role']) === 'admin')); ?>
                        </h3>
                        <!-- <h3>8</h3> -->
                        <p>Administrators</p>
                    </div>
                </div>
                <div class="stats-card">
                    <div class="stats-icon bg-red">
                        <i class="fas fa-user-slash"></i>
                    </div>
                    <div class="stats-info">
                        <h3>14</h3>
                        <p>Inactive Users</p>
                    </div>
                </div>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-error mb-6">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>



        <!-- Quick Actions -->
        <!-- <div style="margin-top: var(--space-8);">
                <div class="grid grid-cols-3 gap-6">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-user-plus"
                                style="font-size: var(--text-2xl); color: var(--primary-600); margin-bottom: var(--space-4);"></i>
                            <h4 style="margin-bottom: var(--space-2);">Add Employee</h4>
                            <p
                                style="color: var(--gray-600); margin-bottom: var(--space-4); font-size: var(--text-sm);">
                                Register a new employee account</p>
                            <a href="../register.php" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                                Add New
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-download"
                                style="font-size: var(--text-2xl); color: var(--success-600); margin-bottom: var(--space-4);"></i>
                            <h4 style="margin-bottom: var(--space-2);">Export Data</h4>
                            <p
                                style="color: var(--gray-600); margin-bottom: var(--space-4); font-size: var(--text-sm);">
                                Download employee records</p>
                            <button class="btn btn-secondary btn-sm" onclick="exportData()">
                                <i class="fas fa-file-csv"></i>
                                Export CSV
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-chart-bar"
                                style="font-size: var(--text-2xl); color: var(--warning-600); margin-bottom: var(--space-4);"></i>
                            <h4 style="margin-bottom: var(--space-2);">View Reports</h4>
                            <p
                                style="color: var(--gray-600); margin-bottom: var(--space-4); font-size: var(--text-sm);">
                                Generate detailed reports</p>
                            <button class="btn btn-outline btn-sm" onclick="viewReports()">
                                <i class="fas fa-chart-line"></i>
                                View Reports
                            </button>
                        </div>
                    </div>
                </div>
            </div>-->
            </div> 

    </main>

    <!-- Footer -->
    <?php //include '../includes/footer.php'?>
    <!-- <footer class="admin-footer">
        <div class="footer-content">
            <p>© 2025 Employee Management System. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Help Center</a>
            </div>
        </div>
    </footer> -->
    <script>
        // Edit employee function
        // function editEmployee(id) {
        //     // For now, show alert - in real implementation, this would open a modal or redirect
        //     alert(`Edit employee functionality would be implemented here for ID: ${id}`);
        // }

        // Delete employee function
        function deleteEmployee(id, username) {
            if (confirm(`Are you sure you want to delete employee "${username}"? This action cannot be undone.`)) {
                // For now, show alert - in real implementation, this would make an AJAX call
                alert(`Delete functionality would be implemented here for ID: ${id}`);
            }
        }

        // Export data function
        // function exportData() {
        //     alert('Export functionality would be implemented here');
        // }

        // View reports function
        // function viewReports() {
        //     alert('Reports functionality would be implemented here');
        // }

        // Auto-refresh search on input
        let searchTimeout;
        document.querySelector('input[name="q"]')?.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 2 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500);
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.querySelector('input[name="q"]')?.focus();
            }
        });
    </script>

</body>

</html>