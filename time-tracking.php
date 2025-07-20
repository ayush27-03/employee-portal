<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracking - Employee Portal</title>
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
            <!-- Page Header -->
            <div style="margin-bottom: var(--space-8);">
                <h1 style="margin-bottom: var(--space-2);">Time Tracking</h1>
                <p style="color: var(--gray-600);">
                    Track your work hours and manage your timesheet efficiently.
                </p>
            </div>

            <!-- Clock In/Out Section -->
            <div class="grid grid-cols-3 gap-8 mb-8">
                <!-- Current Status -->
                <div class="card" style="grid-column: span 2;">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-stopwatch"></i>
                            Current Session
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="text-align: center; padding: var(--space-8) 0;">
                            <!-- Live Clock -->
                            <div style="margin-bottom: var(--space-6);">
                                <div id="current-time" style="font-size: 3rem; font-weight: 600; color: var(--primary-600); margin-bottom: var(--space-2);">
                                    09:45:32 AM
                                </div>
                                <p style="color: var(--gray-600); margin: 0;">Current Time</p>
                            </div>

                            <!-- Status Display -->
                            <div style="margin-bottom: var(--space-8);">
                                <div style="display: inline-flex; align-items: center; gap: var(--space-2); background: var(--success-100); color: var(--success-700); padding: var(--space-3) var(--space-6); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                                    <div style="width: 8px; height: 8px; background: var(--success-500); border-radius: 50%; animation: pulse 2s infinite;"></div>
                                    <span style="font-weight: 500;">Currently Clocked In</span>
                                </div>
                                <div>
                                    <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Started at: 09:00 AM</p>
                                    <p style="color: var(--gray-900); margin: 0; font-weight: 500; font-size: var(--text-lg);">Duration: 0h 45m</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div style="display: flex; gap: var(--space-4); justify-content: center;">
                                <button class="btn btn-primary btn-lg" id="clock-out-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Clock Out
                                </button>
                                <button class="btn btn-secondary btn-lg">
                                    <i class="fas fa-pause"></i>
                                    Take Break
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Summary -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-calendar-day"></i>
                            Today's Summary
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="--space-y: var(--space-4);">
                            <div style="text-align: center; padding: var(--space-4) 0; border-bottom: 1px solid var(--gray-200);">
                                <div style="font-size: var(--text-2xl); font-weight: 600; color: var(--primary-600); margin-bottom: var(--space-1);">
                                    0h 45m
                                </div>
                                <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Hours Worked</p>
                            </div>
                            
                            <div style="--space-y: var(--space-3);">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: var(--gray-600); font-size: var(--text-sm);">Clock In</span>
                                    <span style="font-weight: 500; font-size: var(--text-sm);">09:00 AM</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: var(--gray-600); font-size: var(--text-sm);">Expected Out</span>
                                    <span style="font-weight: 500; font-size: var(--text-sm);">06:00 PM</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: var(--gray-600); font-size: var(--text-sm);">Break Time</span>
                                    <span style="font-weight: 500; font-size: var(--text-sm);">0m</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: var(--gray-600); font-size: var(--text-sm);">Overtime</span>
                                    <span style="font-weight: 500; font-size: var(--text-sm); color: var(--success-600);">+0h</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Overview -->
            <div class="card mb-8">
                <div class="card-header">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-chart-bar"></i>
                            This Week's Overview
                        </h3>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span style="font-size: var(--text-sm); color: var(--gray-600); padding: var(--space-2) var(--space-3);">
                                Jan 13 - Jan 17, 2025
                            </span>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-7 gap-4">
                        <!-- Monday -->
                        <div style="text-align: center; padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-lg);">
                            <div style="font-size: var(--text-sm); color: var(--gray-600); margin-bottom: var(--space-2);">MON</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2);">13</div>
                            <div style="height: 60px; background: var(--success-500); border-radius: var(--radius-sm); margin-bottom: var(--space-2); position: relative;">
                                <div style="position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%); font-size: var(--text-xs); color: white; font-weight: 500;">8h</div>
                            </div>
                            <div style="font-size: var(--text-xs); color: var(--gray-600);">Complete</div>
                        </div>

                        <!-- Tuesday -->
                        <div style="text-align: center; padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-lg);">
                            <div style="font-size: var(--text-sm); color: var(--gray-600); margin-bottom: var(--space-2);">TUE</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2);">14</div>
                            <div style="height: 60px; background: var(--success-500); border-radius: var(--radius-sm); margin-bottom: var(--space-2); position: relative;">
                                <div style="position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%); font-size: var(--text-xs); color: white; font-weight: 500;">8h</div>
                            </div>
                            <div style="font-size: var(--text-xs); color: var(--gray-600);">Complete</div>
                        </div>

                        <!-- Wednesday -->
                        <div style="text-align: center; padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-lg);">
                            <div style="font-size: var(--text-sm); color: var(--gray-600); margin-bottom: var(--space-2);">WED</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2);">15</div>
                            <div style="height: 60px; background: var(--warning-500); border-radius: var(--radius-sm); margin-bottom: var(--space-2); position: relative;">
                                <div style="position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%); font-size: var(--text-xs); color: white; font-weight: 500;">7.5h</div>
                            </div>
                            <div style="font-size: var(--text-xs); color: var(--gray-600);">Partial</div>
                        </div>

                        <!-- Thursday -->
                        <div style="text-align: center; padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-lg);">
                            <div style="font-size: var(--text-sm); color: var(--gray-600); margin-bottom: var(--space-2);">THU</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2);">16</div>
                            <div style="height: 60px; background: var(--success-500); border-radius: var(--radius-sm); margin-bottom: var(--space-2); position: relative;">
                                <div style="position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%); font-size: var(--text-xs); color: white; font-weight: 500;">8h</div>
                            </div>
                            <div style="font-size: var(--text-xs); color: var(--gray-600);">Complete</div>
                        </div>

                        <!-- Friday (Today) -->
                        <div style="text-align: center; padding: var(--space-4); border: 2px solid var(--primary-500); border-radius: var(--radius-lg); background: var(--primary-50);">
                            <div style="font-size: var(--text-sm); color: var(--primary-600); margin-bottom: var(--space-2); font-weight: 500;">FRI</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2); color: var(--primary-600);">17</div>
                            <div style="height: 60px; background: var(--primary-300); border-radius: var(--radius-sm); margin-bottom: var(--space-2); position: relative;">
                                <div style="position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%); font-size: var(--text-xs); color: white; font-weight: 500;">0.75h</div>
                            </div>
                            <div style="font-size: var(--text-xs); color: var(--primary-600); font-weight: 500;">In Progress</div>
                        </div>

                        <!-- Saturday -->
                        <div style="text-align: center; padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); opacity: 0.5;">
                            <div style="font-size: var(--text-sm); color: var(--gray-600); margin-bottom: var(--space-2);">SAT</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2);">18</div>
                            <div style="height: 60px; background: var(--gray-200); border-radius: var(--radius-sm); margin-bottom: var(--space-2);"></div>
                            <div style="font-size: var(--text-xs); color: var(--gray-600);">Weekend</div>
                        </div>

                        <!-- Sunday -->
                        <div style="text-align: center; padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); opacity: 0.5;">
                            <div style="font-size: var(--text-sm); color: var(--gray-600); margin-bottom: var(--space-2);">SUN</div>
                            <div style="font-size: var(--text-lg); font-weight: 600; margin-bottom: var(--space-2);">19</div>
                            <div style="height: 60px; background: var(--gray-200); border-radius: var(--radius-sm); margin-bottom: var(--space-2);"></div>
                            <div style="font-size: var(--text-xs); color: var(--gray-600);">Weekend</div>
                        </div>
                    </div>

                    <!-- Week Summary -->
                    <div style="margin-top: var(--space-6); padding-top: var(--space-6); border-top: 1px solid var(--gray-200);">
                        <div class="grid grid-cols-4 gap-6">
                            <div style="text-align: center;">
                                <div style="font-size: var(--text-xl); font-weight: 600; color: var(--primary-600); margin-bottom: var(--space-1);">31.25h</div>
                                <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Total Hours</p>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: var(--text-xl); font-weight: 600; color: var(--success-600); margin-bottom: var(--space-1);">4</div>
                                <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Days Worked</p>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: var(--text-xl); font-weight: 600; color: var(--warning-600); margin-bottom: var(--space-1);">7.8h</div>
                                <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Daily Average</p>
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: var(--text-xl); font-weight: 600; color: var(--error-600); margin-bottom: var(--space-1);">8.75h</div>
                                <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Remaining</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Time Entries -->
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-history"></i>
                            Recent Time Entries
                        </h3>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add Manual Entry
                        </button>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Break Duration</th>
                                <th>Total Hours</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jan 17, 2025</td>
                                <td>09:00 AM</td>
                                <td><span style="color: var(--primary-600); font-weight: 500;">In Progress</span></td>
                                <td>0m</td>
                                <td>0h 45m</td>
                                <td><span style="background: var(--primary-100); color: var(--primary-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Active</span></td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn edit" title="Edit Entry">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Jan 16, 2025</td>
                                <td>09:00 AM</td>
                                <td>06:00 PM</td>
                                <td>60m</td>
                                <td>8h 0m</td>
                                <td><span style="background: var(--success-100); color: var(--success-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Complete</span></td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn edit" title="Edit Entry">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Delete Entry">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Jan 15, 2025</td>
                                <td>09:15 AM</td>
                                <td>05:45 PM</td>
                                <td>30m</td>
                                <td>7h 30m</td>
                                <td><span style="background: var(--warning-100); color: var(--warning-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Partial</span></td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn edit" title="Edit Entry">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Delete Entry">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <span>Showing 3 of 15 entries</span>
                    <div style="display: flex; gap: var(--space-2);">
                        <button class="btn btn-sm btn-secondary">Previous</button>
                        <button class="btn btn-sm btn-secondary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>

    <script>
        // Live clock update
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Initial call

        // Clock in/out functionality
        document.getElementById('clock-out-btn').addEventListener('click', function() {
            if (confirm('Are you sure you want to clock out?')) {
                alert('Clock out functionality would be implemented here');
            }
        });

        // Table actions
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.classList.contains('edit') ? 'Edit' : 'Delete';
                alert(`${action} functionality would be implemented here`);
            });
        });
    </script>
</body>
</html>
