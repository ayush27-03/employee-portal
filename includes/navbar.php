<?php
    session_start();
    $page = basename($_SERVER["PHP_SELF"]);

    if(!isset($_SESSION['firstName']) && in_array($page, ['profile.php', 'dashboard.php'])){
        //@ If session is NOT present and the page trying to be accessed are these then
        //@ redirect the user to the login page and show a message please login first.
        header("Location: index.php?message=" . urlencode("Please Login First."));
        exit();  
    }
    /**
        <li><a href="time-tracking.php" class="<?=$page==='time-tracking.php'?'active':''?>"><i class="fas fa-clock"></i> Time Tracking</a></li>
     * 
     */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/design-system.css">
    <link rel="stylesheet" href="css/components.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-container">
                <a href="index.php" class="navbar-brand">
                    <i class="fas fa-user-tie"></i>
                    Employee Portal
                </a>
                
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['firstName'])){
                    ?>
                    <li><a href="dashboard.php" class="<?=$page==='dashboard.php'?'active':''?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="profile.php" class="<?=$page==='profile.php'?'active':''?>"><i class="fas fa-user-edit"></i> Profile</a></li>
                    <!-- <li><a href="leave-management.php" class="<?=$page==='leave-management.php'?'active':''?>"><i class="fas fa-calendar-alt"></i> Leave</a></li> -->
                    <li><a href="analytics.php" class="<?=$page==='analytics.php'?'active':''?>"><i class="fas fa-chart-line"></i> Analytics</a></li>
                    <li><a href="reports.php" class="<?=$page==='reports.php'?'active':''?>"><i class="fas fa-chart-bar"></i> Reports</a></li>
                        <li>
                            <div style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-2) var(--space-3);  border-radius: var(--radius-md);">
                                <i class="fas fa-user" style="color: var(--primary-600);"></i>
                                <span style="color: var(--primary-700); font-weight: 500; font-size: var(--text-sm);">
                                    <?php echo !empty(ucfirst($_SESSION['firstName']))? ucfirst($_SESSION['firstName']) : 'Guest User';?>
                                </span>
                            </div>
                        </li>
                        <?php } ?>
                        <?php
                            if (isset($_SESSION['firstName'])) {
                        ?>                        
                        <li><a href="logout.php" class="btn btn-sm" style="color: var(--error-600);"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    <?php } else{?>
                        <li><a href="#" class="active"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#features"><i class="fas fa-star"></i> Features</a></li>
                        <li><a href="#contact"><i class="fas fa-envelope"></i> Contact</a></li>
                        <li><a href="login.php" class="btn btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <?php } ?>
                </ul>
                </div>
            </div>
        </div>
    </nav>
</body>
<!-- 
//@ No need of multiple navbar entities for different pages.
//@ Trigger the navbar entities as per session when logged in showcase logout button and similarly other functionalities

-->