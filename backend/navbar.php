<?php
ob_start();
session_start();

//@ logic to not allow access to any critical page until and unless it is admin
$page = basename($_SERVER["PHP_SELF"]);
if (!isset($_SESSION['firstName']) && in_array($page, ['roles.php', 'departments.php', 'sidebar.php', 'dashboard.php'])) {
    header("Location: login.php?message=" . urlencode("Please Login First."));
    exit();
}
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
// echo $_SERVER['DOCUMENT_ROOT'];
$script = $_SERVER['SCRIPT_NAME']; 
// $path = rtrim(dirname($script), '/\\');
$baseUrl = $protocol . $host . '/';

define('BASE_PATH', $baseUrl . 'portal/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/design-system.css">
    <link rel="stylesheet" href="../../css/components.css">
    <link rel="stylesheet" href="../../css/adminpanel.css">
</head>

<body>
    <header class="admin-navbar">
        <div class="admin-navbar-container">
            <!-- Brand + Sidebar Toggle -->
            <div class="admin-navbar-left">
                <a href="dashboard.php" class="navbar-brand" style="display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-gear"></i>
                    <span style="font-weight: 600;">Administrator</span>
                </a>
                <button class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Right Profile, Search, Logout -->
            <div class="admin-navbar-right">
                <!-- Profile Info -->
                <ul class="navbar-nav">
                    <li>
                        <div
                            style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-2) var(--space-3);  border-radius: var(--radius-md);">
                            <i class="fas fa-user" style="color: var(--primary-600);"></i>
                            <span style="color: var(--primary-700); font-weight: 500; font-size: var(--text-sm);">
                                <?php echo !empty(ucfirst($_SESSION['firstName'])) ? ucfirst($_SESSION['firstName']) : 'Guest User'; ?>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</body>