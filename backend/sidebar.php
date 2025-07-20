<body>
  
<aside class="admin-sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
        <i class="fas fa-user-shield sidebar-brand-icon"></i>
        <span class="sidebar-brand-text">Admin Panel</span>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <!-- Core Section -->
        <div class="sidebar-section-header">Core</div>
        <ul class="sidebar-menu">
            <li><a href="<?php echo BASE_PATH ?>backend\dashboard\dashboard.php" class="sidebar-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="<?php echo BASE_PATH ?>backend\employee\listing.php" class="sidebar-link"><i class="fas fa-users-cog"></i> Manage Users</a></li>
            <li><a href="<?php echo BASE_PATH ?>backend\departments\listingDept.php" class="sidebar-link"><i class="fas fa-sitemap"></i> Departments</a></li>
            <li><a href="..\roles\listingRoles.php" class="sidebar-link"><i class="fas fa-user-tag"></i> Roles & Permissions</a></li>
        </ul>



        <!-- Reports Section -->
        <!-- <div class="sidebar-section-header">Reports & Audit</div>
        <ul class="sidebar-menu">
            <li><a href="reports.php" class="sidebar-link"><i class="fas fa-chart-bar"></i> Reports & Analytics</a></li>
            <li><a href="activity-log.php" class="sidebar-link"><i class="fas fa-history"></i> Activity Log</a></li>
            <li><a href="date-reports.php" class="sidebar-link"><i class="fas fa-calendar-alt"></i> Date Reports</a></li>
        </ul> -->

        <!-- System Section -->
        <!-- <div class="sidebar-section-header">System</div>
        <ul class="sidebar-menu">
            <li><a href="settings.php" class="sidebar-link"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="support.php" class="sidebar-link"><i class="fas fa-life-ring"></i> Support</a></li>
            <li><a href="notifications.php" class="sidebar-link"><i class="fas fa-bell"></i> Notifications</a></li>
        </ul>  -->

        <!-- Account Section -->
        <div class="sidebar-section-header">Account</div>
        <ul class="sidebar-menu">
            <li><a href="profile.php" class="sidebar-link"><i class="fas fa-user-circle"></i> Profile</a></li>
            <li><a href="..\logout.php" class="sidebar-link sidebar-link-logout"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
    </nav>
</aside>

</body>
</html>