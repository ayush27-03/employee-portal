<?php
require_once '../../includes/config.php';
// echo "<pre>";

try {
    // Get only count values for multiple cards
    // Build search query
    $sql = "SELECT employee.*, department.name as deptName, roles.name as roleName FROM employee JOIN department ON employee.department = department.id JOIN roles ON employee.role = roles.id";
    $params = [];

    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>"; print_r($data);die;
    
    // Department Counts
    $dept_query = "SELECT COUNT(id) as count FROM department where status = '1'";
    $deptCount = $conn->query($dept_query)->fetchColumn();

    // Roles Counts
    $role_query = "SELECT COUNT(id) as count FROM roles where status = '1'";
    $roleCount = $conn->query($role_query)->fetchColumn();

    // Employee Status
    $status_query = "SELECT COUNT(*) as total, SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) as active FROM employee";
    $status_counts = $conn->query($status_query)->fetch(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
    $data = [];
}

?>

<body class="admin-page">
    <!-- Include Navbar -->
    <?php include '../navbar.php'; ?>

    <!-- Include Sidebar -->
    <?php include '../sidebar.php'; ?>

    <!-- Main Content -->
    <main class="admin-main-content">
        <div class="admin-container">

            <div class="welcome-header">
                <div class="welcome-content">
                    <h1>Welcome back, Admin!</h1>
                    <span>Here's what's happening in your organization today</span>
                </div>
            </div>

            <div class="metrics-grid">
                <!-- Total Users Card -->
                <div class="metric-card primary">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <?php
                            $newUsers = count(array_filter($data, fn($emp) => strtotime($emp['created_at']) > strtotime('-30 days')));
                            echo '+' . round(($newUsers / count($data)) * 100, 1) . '%';
                            ?>
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number"><?= count($data) ?></div>
                        <div class="metric-label">Total Employees</div>
                        <div class="metric-sublabel">+<?= $newUsers ?> this month</div>
                    </div>
                </div>

                <!-- Active Users Card -->
                <div class="metric-card success">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div
                            class="metric-trend <?= ($status_counts['active'] / $status_counts['total'] > 0.9) ? 'positive' : 'negative' ?>">
                            <i
                                class="fas fa-arrow-<?= ($status_counts['active'] / $status_counts['total'] > 0.9) ? 'up' : 'down' ?>"></i>
                            <?= round(($status_counts['active'] / $status_counts['total']) * 100, 1) . '%' ?>
                        </div>
                    </div>
                    <div class="metric-content">

                        <div class="metric-number"><?= $status_counts['active'] ?></div>
                        <div class="metric-label">Active Employees</div>
                        <div class="metric-sublabel">
                            <?= round(($status_counts['active'] / $status_counts['total']) * 100) ?>% of workforce
                        </div>
                    </div>
                </div>

                <!-- Administrators Card -->
                <div class="metric-card warning">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="metric-trend neutral">
                            <i class="fas fa-equals"></i>
                            <?= count(array_filter($data, fn($emp) => $emp['role'] === 1)) ?>
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number"><?= count(array_filter($data, fn($emp) => $emp['role'] === 1)) ?>
                        </div>
                        <div class="metric-label">Administrators</div>
                        <div class="metric-sublabel">
                            <?= round((count(array_filter($data, fn($emp) => $emp['role'] === 1)) / count($data)) * 100) ?>%
                            of users
                        </div>
                    </div>
                </div>

                <!-- Departments Card -->
                <div class="metric-card secondary">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <?= $deptCount ?> total
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number"><?= $deptCount ?></div>
                        <div class="metric-label">Departments</div>
                    </div>
                </div>

                <!-- Roles Card -->
                <div class="metric-card info">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <?= $roleCount ?> total
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number"><?= $roleCount ?></div>
                        <div class="metric-label">Roles</div>
                    </div>
                </div>

                <!-- Inactive Users Card -->
                <div class="metric-card info">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <?= count(array_filter($data, fn($emp) => $emp['status'] === '0')); ?> total
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number"><?= count(array_filter($data, fn($emp) => $emp['status'] === '0')); ?>
                        </div>
                        <div class="metric-label">Inactive Users</div>
                    </div>
                </div>

                <!-- //@ To be dynamic cards -->
                <!-- New Employees Card -->
                <div class="metric-card info">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            4
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number">3</div>
                        <div class="metric-label">New Employees (7 days)</div>
                    </div>
                    <div class="metric-sublabel">
                        3
                    </div>
                </div>

                <!-- Degree Programs Card -->
                <?php $totalDegree = $conn->query("select count(*) from degree")->fetchColumn(); ?>
                <div class="metric-card info">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <!-- 4 total -->
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number">
                            <?php echo htmlspecialchars($totalDegree)?>
                        </div>
                        <div class="metric-label">Degree Programs</div>
                    </div>
                </div>

                <!-- Certifications Card -->
                <?php $totalCertifications = $conn->query("select count(*) from certifications")->fetchColumn(); ?>
                <div class="metric-card info">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <!-- 3 -->
                        </div>
                    </div>
                    <div class="metric-content">
                        <div class="metric-number">
                            <?php echo htmlspecialchars($totalCertifications)?>
                        </div>
                        <div class="metric-label">Certifications</div>
                    </div>
                    <!-- <div class="metric-details"> -->
                    <div class="metric-sublabel">
                        <div class="detail-item">
                            <!-- <span>2 Active</span> -->
                        </div>
                        <div class="detail-item">
                            <!-- <span>4 Expiring Soon</span> -->
                        </div>
                    </div>
                </div>


            </div>




            <!-- Set 2 -->
            <div class="admin-stats-grid">

            </div>


            <?php if (isset($error_message)): ?>
                <div class="alert alert-error mb-6">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?php include '../footer.php'; ?>


    <script>

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

        
        // Random Username Generation
        function generateUsername(firstName, lastName) {
            const base = (firstName + lastName).toLowerCase().replace(/\s+/g, '');
            return base + Math.floor(1000 + Math.random() * 9000);
        }

        function refreshUsername() {
            const firstName = document.getElementById('firstName').value || 'user';
            const lastName = document.getElementById('lastName').value || '';
            document.getElementById('username').value = generateUsername(firstName, lastName);
        }

        // Called when modal opens to generate initial username
        document.getElementById('addEmployeeModal').addEventListener('shown', function () {
            refreshUsername();
        });

        // Generating client-side preview
        function generateUsernamePreview(firstName, lastName) {
            const name = (firstName + lastName).toLowerCase().replace(/\s+/g, '');
            return name + Math.floor(1000 + Math.random() * 9000);
        }

        // Refresh button handler
        document.querySelector('.refresh-username').addEventListener('click', function () {
            const firstName = document.getElementById('firstName').value || '';
            const lastName = document.getElementById('lastName').value || '';
            document.getElementById('username').value = generateUsernamePreview(firstName, lastName);
        });

        // Auto-generate when names change
        document.getElementById('firstName').addEventListener('input', refreshUsername);
        document.getElementById('lastName').addEventListener('input', refreshUsername);

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }

    </script>
    <style>
        .welcome-header {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: white;
            padding: var(--space-8);
            border-radius: var(--radius-xl);
            margin-bottom: var(--space-8);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-content h1 {
            font-size: var(--text-3xl);
            margin-bottom: var(--space-2);
            color: white;
        }

        .welcome-content p {
            font-size: var(--text-lg);
            opacity: 0.9;
            margin-bottom: var(--space-6);
        }

        .quick-stats {
            display: flex;
            gap: var(--space-6);
            flex-wrap: wrap;
        }

        .quick-stat {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-sm);
            opacity: 0.9;
        }

        .quick-stat i {
            font-size: var(--text-base);
        }

        .welcome-actions {
            display: flex;
            gap: var(--space-3);
            flex-shrink: 0;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        .metric-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            border-left: 4px solid;
            box-shadow: var(--shadow-sm);
        }

        .metric-card.primary {
            border-left-color: var(--primary-500);
        }

        .metric-card.success {
            border-left-color: var(--success-500);
        }

        .metric-card.warning {
            border-left-color: var(--warning-500);
        }

        .metric-card.info {
            border-left-color: var(--gray-500);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-xl);
        }

        .metric-card.primary .metric-icon {
            background: var(--primary-100);
            color: var(--primary-600);
        }

        .metric-card.success .metric-icon {
            background: var(--success-100);
            color: var(--success-600);
        }

        .metric-card.warning .metric-icon {
            background: var(--warning-100);
            color: var(--warning-600);
        }

        .metric-card.info .metric-icon {
            background: var(--gray-100);
            color: var(--gray-600);
        }

        .metric-trend {
            display: flex;
            align-items: center;
            gap: var(--space-1);
            font-size: var(--text-sm);
            font-weight: 500;
        }

        .metric-trend.positive {
            color: var(--success-600);
        }

        .metric-trend.negative {
            color: var(--error-600);
        }

        .metric-number {
            font-size: var(--text-3xl);
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1;
        }

        .metric-label {
            font-size: var(--text-base);
            color: var(--gray-700);
            margin: var(--space-1) 0;
        }

        .metric-sublabel {
            font-size: var(--text-sm);
            color: var(--gray-500);
        }

        .stats-subtext {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            margin-top: 0.5rem;
            font-size: var(--text-xs);
            color: var(--gray-500);
        }

        .progress-bar {
            height: 4px;
            background: var(--gray-200);
            border-radius: 2px;
            margin-top: 0.5rem;
        }

        .progress-bar div {
            height: 100%;
            background: var(--primary-500);
            border-radius: 2px;
        }

        .role-distribution,
        .degree-stats,
        .recent-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }

        .role-item,
        .degree-item,
        .recent-item {
            display: flex;
            justify-content: space-between;
            font-size: var(--text-xs);
        }

        .cert-details {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.5rem;
            font-size: var(--text-xs);
        }

        .stats-icon.bg-teal {
            background-color: #CCFBF1;
            color: #0D9488;
        }

        .stats-icon.bg-purple {
            background-color: #EDE9FE;
            color: #8B5CF6;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: var(--space-8);
            margin-bottom: var(--space-8);
        }

        .dashboard-left,
        .dashboard-right {
            display: flex;
            flex-direction: column;
            gap: var(--space-6);
        }

        .attendance-summary {
            display: flex;
            align-items: center;
            gap: var(--space-6);
        }

        .attendance-chart {
            width: 200px;
            height: 200px;
            position: relative;
        }

        .attendance-stats {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .attendance-stat {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        /* Modal Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-6);
            margin-bottom: var(--space-6);
        }

        .form-section {
            margin-bottom: var(--space-6);
        }

        .section-title {
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: var(--space-4);
            padding-bottom: var(--space-2);
            border-bottom: 1px solid var(--gray-200);
        }

        .password-input {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: var(--space-3);
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-500);
            cursor: pointer;
            padding: var(--space-1);
        }

        .password-toggle:hover {
            color: var(--gray-700);
        }

        .radio-group {
            display: flex;
            gap: var(--space-6);
            margin-top: var(--space-2);
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            cursor: pointer;
        }

        .radio-checkmark {
            width: 16px;
            height: 16px;
            border: 2px solid var(--gray-400);
            border-radius: 50%;
            position: relative;
        }

        .radio-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .radio-option input:checked~.radio-checkmark {
            border-color: var(--primary-500);
        }

        .radio-option input:checked~.radio-checkmark:after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: var(--primary-500);
            border-radius: 50%;
            top: 2px;
            left: 2px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .input-with-action {
            position: relative;
        }

        .input-action {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary-500);
            cursor: pointer;
            padding: 5px;
        }

        .input-action:hover {
            color: var(--primary-700);
        }

        /* For readonly fields that still need to show the button */
        input[readonly] {
            background-color: var(--gray-50);
            cursor: not-allowed;
        }

        .stat-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .stat-dot.present {
            background: var(--success-500);
        }

        .stat-dot.absent {
            background: var(--error-500);
        }

        .stat-dot.leave {
            background: var(--warning-500);
        }

        .stat-info .stat-number {
            font-size: var(--text-xl);
            font-weight: 600;
            color: var(--gray-900);
        }

        .stat-info .stat-label {
            font-size: var(--text-sm);
            color: var(--gray-600);
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .activity-item {
            display: flex;
            gap: var(--space-3);
            padding: var(--space-3);
            border-radius: var(--radius-lg);
            transition: background var(--transition-fast);
        }

        .activity-item:hover {
            background: var(--gray-50);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-icon.new-employee {
            background: var(--success-100);
            color: var(--success-600);
        }

        .activity-icon.leave-request {
            background: var(--warning-100);
            color: var(--warning-600);
        }

        .activity-icon.payroll {
            background: var(--primary-100);
            color: var(--primary-600);
        }

        .activity-icon.performance {
            background: var(--gray-100);
            color: var(--gray-600);
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            color: var(--gray-900);
            margin-bottom: var(--space-1);
        }

        .activity-desc {
            font-size: var(--text-sm);
            color: var(--gray-600);
            margin-bottom: var(--space-1);
        }

        .activity-time {
            font-size: var(--text-xs);
            color: var(--gray-500);
        }

        .department-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .department-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3);
            border-radius: var(--radius-lg);
            transition: background var(--transition-fast);
        }

        .department-item:hover {
            background: var(--gray-50);
        }

        .department-name {
            font-weight: 500;
            color: var(--gray-900);
        }

        .department-count {
            font-size: var(--text-sm);
            color: var(--gray-600);
        }

        .department-stats {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .stat-bar {
            width: 80px;
            height: 6px;
            background: var(--gray-200);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .stat-fill {
            height: 100%;
            background: var(--primary-500);
            transition: width var(--transition-normal);
        }

        .stat-percentage {
            font-size: var(--text-sm);
            font-weight: 500;
            color: var(--gray-700);
            min-width: 35px;
        }

        .pending-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .pending-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            transition: all var(--transition-fast);
        }

        .pending-item:hover {
            border-color: var(--primary-300);
            background: var(--primary-50);
        }

        .pending-item.urgent {
            border-color: var(--error-300);
            background: var(--error-50);
        }

        .pending-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-100);
            color: var(--primary-600);
            flex-shrink: 0;
        }

        .pending-item.urgent .pending-icon {
            background: var(--error-100);
            color: var(--error-600);
        }

        .pending-content {
            flex: 1;
        }

        .pending-title {
            font-weight: 500;
            color: var(--gray-900);
            margin-bottom: var(--space-1);
        }

        .pending-count {
            font-size: var(--text-sm);
            color: var(--gray-600);
        }

        .pending-action {
            flex-shrink: 0;
        }

        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-md);
            font-size: var(--text-xs);
            font-weight: 500;
        }

        .badge.badge-error {
            background: var(--error-100);
            color: var(--error-700);
        }

        .bottom-section {
            margin-bottom: var(--space-8);
        }

        .chart-legend {
            display: flex;
            gap: var(--space-4);
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-sm);
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .welcome-header {
                flex-direction: column;
                align-items: stretch;
                gap: var(--space-6);
            }

            .quick-stats {
                justify-content: center;
            }

            .welcome-actions {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .attendance-summary {
                flex-direction: column;
                text-align: center;
            }

            .chart-legend {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>

</body>

</html>