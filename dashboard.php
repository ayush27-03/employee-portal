<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Employee Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/design-system.css">
    <link rel="stylesheet" href="css/components.css">
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main Content -->
    <main style="padding: var(--space-8) 0; min-height: calc(100vh - 80px);">
        <div class="container">
            <!-- Welcome Section -->
            <div style="margin-bottom: var(--space-8);">
                <h1 style="margin-bottom: var(--space-2);">
                    Welcome, <?php echo ucfirst($_SESSION['firstName']); ?>!
                </h1>
                <p style="color: var(--gray-600);">
                    Here's what's happening in your workspace today.
                </p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--primary-100); color: var(--primary-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">8.5h</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Hours Today</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--success-100); color: var(--success-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">12</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Tasks Completed</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--warning-100); color: var(--warning-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">95%</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Attendance Rate</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--error-100); color: var(--error-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">3</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Pending Items</p>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="grid grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-user"></i>
                            My Profile
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="text-align: center; margin-bottom: var(--space-6);">
                            <div
                                style="width: 80px; height: 80px; background: var(--primary-100); color: var(--primary-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: var(--text-2xl); margin: 0 auto var(--space-4);">
                                <?php echo strtoupper(substr($_SESSION['firstName'] ?? 'U', 0, 1) . substr($_SESSION['lastName'] ?? 'N', 0, 1)); ?>
                            </div>
                            <h4 style="margin-bottom: var(--space-1);">
                                <?php echo ucwords(($_SESSION['firstName'] ?? '') . ' ' . ($_SESSION['lastName'] ?? '')); ?>
                            </h4>
                            <p style="color: var(--gray-500); margin: 0; font-size: var(--text-sm);">
                                @<?php echo htmlspecialchars($_SESSION['username']); ?>
                            </p>
                        </div>

                        <div style="space-y: var(--space-3);">
                            <div
                                style="display: flex; justify-content: space-between; padding: var(--space-2) 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Department</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm);"><?php echo htmlspecialchars(ucfirst($_SESSION['dname']) ?? 'N/A'); ?></span>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: var(--space-2) 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Role</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm);"><?php echo htmlspecialchars(ucfirst($_SESSION['rname'] ?? 'N/A')); ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: var(--space-2) 0;">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Employee ID</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm); font-family: var(--font-family-mono);">#<?php echo str_pad($_SESSION['eid'] ?? '0', 4, '0', STR_PAD_LEFT); ?></span>
                            </div>
                        </div>
                        <a href="profile.php">
                            <button class="btn btn-outline" style="width: 100%; margin-top: var(--space-4);">
                                <i class="fas fa-edit"></i>
                                Edit Profile
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-history"></i>
                            Recent Activity
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="space-y: var(--space-4);">
                            <div
                                style="display: flex; gap: var(--space-3); padding-bottom: var(--space-3); border-bottom: 1px solid var(--gray-200);">
                                <div
                                    style="width: 32px; height: 32px; background: var(--success-100); color: var(--success-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-check" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Task completed
                                    </p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">2 hours ago
                                    </p>
                                </div>
                            </div>

                            <div
                                style="display: flex; gap: var(--space-3); padding-bottom: var(--space-3); border-bottom: 1px solid var(--gray-200);">
                                <div
                                    style="width: 32px; height: 32px; background: var(--primary-100); color: var(--primary-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-clock" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Clocked in</p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">8 hours ago
                                    </p>
                                </div>
                            </div>

                            <div
                                style="display: flex; gap: var(--space-3); padding-bottom: var(--space-3); border-bottom: 1px solid var(--gray-200);">
                                <div
                                    style="width: 32px; height: 32px; background: var(--warning-100); color: var(--warning-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-edit" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Profile updated
                                    </p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">Yesterday
                                    </p>
                                </div>
                            </div>

                            <div style="display: flex; gap: var(--space-3);">
                                <div
                                    style="width: 32px; height: 32px; background: var(--gray-100); color: var(--gray-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-calendar" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Schedule updated
                                    </p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">2 days ago
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-bolt"></i>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                            <button class="btn btn-primary" style="justify-content: flex-start;">
                                <i class="fas fa-play"></i>
                                Clock In/Out
                            </button>

                            <button class="btn btn-secondary" style="justify-content: flex-start;">
                                <i class="fas fa-calendar-plus"></i>
                                Request Time Off
                            </button>

                            <button class="btn btn-secondary" style="justify-content: flex-start;">
                                <i class="fas fa-file-alt"></i>
                                Submit Report
                            </button>

                            <button class="btn btn-secondary" style="justify-content: flex-start;">
                                <i class="fas fa-envelope"></i>
                                Contact HR
                            </button>

                            <button class="btn btn-outline" style="justify-content: flex-start;">
                                <i class="fas fa-cog"></i>
                                Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Dashboard Sections -->
            <div style="margin-top: var(--space-8);">
                <div class="grid grid-cols-2 gap-8">
                    <!-- Upcoming Events -->
                    <div class="card">
                        <div class="card-header">
                            <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                                <i class="fas fa-calendar"></i>
                                Upcoming Events
                            </h3>
                        </div>
                        <div class="card-body">
                            <div style="text-align: center; padding: var(--space-8) 0;">
                                <i class="fas fa-calendar"
                                    style="font-size: var(--text-3xl); color: var(--gray-300); margin-bottom: var(--space-4);"></i>
                                <p style="color: var(--gray-500); margin: 0;">No upcoming events</p>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Overview -->
                    <div class="card">
                        <div class="card-header">
                            <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                                <i class="fas fa-chart-line"></i>
                                Performance Overview
                            </h3>
                        </div>
                        <div class="card-body">
                            <div style="space-y: var(--space-4);">
                                <div>
                                    <div
                                        style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                                        <span style="font-size: var(--text-sm); color: var(--gray-600);">Task
                                            Completion</span>
                                        <span style="font-size: var(--text-sm); font-weight: 500;">85% </span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 8px; background: var(--gray-200); border-radius: var(--radius-md); overflow: hidden;">
                                        <div style="width: 85%; height: 100%; background: var(--success-500);"></div>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                                        <span
                                            style="font-size: var(--text-sm); color: var(--gray-600);">Attendance</span>
                                        <span style="font-size: var(--text-sm); font-weight: 500;">95%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 8px; background: var(--gray-200); border-radius: var(--radius-md); overflow: hidden;">
                                        <div style="width: 95%; height: 100%; background: var(--primary-500);"></div>
                                    </div>
                                </div>

                                <div>
                                    <div
                                        style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                                        <span style="font-size: var(--text-sm); color: var(--gray-600);">Goal
                                            Progress</span>
                                        <span style="font-size: var(--text-sm); font-weight: 500;">72%</span>
                                    </div>
                                    <div
                                        style="width: 100%; height: 8px; background: var(--gray-200); border-radius: var(--radius-md); overflow: hidden;">
                                        <div style="width: 72%; height: 100%; background: var(--warning-500);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Actions -->
            <div style="margin-top: var(--space-8);">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-cog"></i>
                            Account Actions
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="downloadprofile.php" method="get">
                            <div style="display: flex; gap: var(--space-4); flex-wrap: wrap;">
                                <input type="hidden" name="download_csv" value="1">
                                <button type="submit" class="btn btn-outline">
                                    <i class="fas fa-download"></i>
                                    Download Profile Data
                                </button>
                        </form>

                                <button class="btn btn-secondary" onclick="contactSupport()">
                                    <i class="fas fa-headset"></i>
                                    Contact Support
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>

        // Auto-update time display
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            // Update any time displays if they exist
        }

        setInterval(updateTime, 1000);
    </script>
</body>

</html>