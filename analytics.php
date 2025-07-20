<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Employee Portal</title>
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
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-4);">
                    <div>
                        <h1 style="margin-bottom: var(--space-2);">Analytics Dashboard</h1>
                        <p style="color: var(--gray-600);">
                            Track your performance metrics and productivity insights.
                        </p>
                    </div>
                    <div style="display: flex; gap: var(--space-3);">
                        <select class="form-select" style="width: auto;">
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                        </select>
                        <button class="btn btn-primary">
                            <i class="fas fa-download"></i>
                            Export Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--primary-100); color: var(--primary-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">168.5h</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Total Hours</p>
                        <div style="display: flex; align-items: center; justify-content: center; gap: var(--space-1); margin-top: var(--space-2);">
                            <i class="fas fa-arrow-up" style="color: var(--success-600); font-size: var(--text-xs);"></i>
                            <span style="color: var(--success-600); font-size: var(--text-xs); font-weight: 500;">+12%</span>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--success-100); color: var(--success-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">47</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Tasks Completed</p>
                        <div style="display: flex; align-items: center; justify-content: center; gap: var(--space-1); margin-top: var(--space-2);">
                            <i class="fas fa-arrow-up" style="color: var(--success-600); font-size: var(--text-xs);"></i>
                            <span style="color: var(--success-600); font-size: var(--text-xs); font-weight: 500;">+8%</span>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--warning-100); color: var(--warning-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">94%</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Productivity Score</p>
                        <div style="display: flex; align-items: center; justify-content: center; gap: var(--space-1); margin-top: var(--space-2);">
                            <i class="fas fa-arrow-up" style="color: var(--success-600); font-size: var(--text-xs);"></i>
                            <span style="color: var(--success-600); font-size: var(--text-xs); font-weight: 500;">+3%</span>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--error-100); color: var(--error-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">22</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Working Days</p>
                        <div style="display: flex; align-items: center; justify-content: center; gap: var(--space-1); margin-top: var(--space-2);">
                            <i class="fas fa-minus" style="color: var(--gray-400); font-size: var(--text-xs);"></i>
                            <span style="color: var(--gray-500); font-size: var(--text-xs); font-weight: 500;">0%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <!-- Hours Worked Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-chart-area"></i>
                            Hours Worked Trend
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px; background: var(--gray-50); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; position: relative;">
                            <!-- Simulated Chart -->
                            <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; height: 200px;">
                                <div style="display: flex; align-items: end; height: 100%; gap: 8px;">
                                    <div style="background: var(--primary-500); width: 20px; height: 60%; border-radius: 2px 2px 0 0;"></div>
                                    <div style="background: var(--primary-500); width: 20px; height: 80%; border-radius: 2px 2px 0 0;"></div>
                                    <div style="background: var(--primary-500); width: 20px; height: 45%; border-radius: 2px 2px 0 0;"></div>
                                    <div style="background: var(--primary-500); width: 20px; height: 90%; border-radius: 2px 2px 0 0;"></div>
                                    <div style="background: var(--primary-500); width: 20px; height: 70%; border-radius: 2px 2px 0 0;"></div>
                                    <div style="background: var(--primary-500); width: 20px; height: 85%; border-radius: 2px 2px 0 0;"></div>
                                    <div style="background: var(--primary-500); width: 20px; height: 95%; border-radius: 2px 2px 0 0;"></div>
                                </div>
                            </div>
                            <div style="color: var(--gray-500); font-size: var(--text-sm);">
                                <i class="fas fa-chart-line" style="font-size: var(--text-2xl); margin-bottom: var(--space-2);"></i>
                                <p>Interactive chart would be rendered here</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task Completion Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-chart-pie"></i>
                            Task Distribution
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px; background: var(--gray-50); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; position: relative;">
                            <!-- Simulated Pie Chart -->
                            <div style="width: 150px; height: 150px; border-radius: 50%; background: conic-gradient(var(--success-500) 0deg 180deg, var(--warning-500) 180deg 270deg, var(--error-500) 270deg 300deg, var(--gray-300) 300deg 360deg);"></div>
                            <div style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                                <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                                    <div style="display: flex; align-items: center; gap: var(--space-2);">
                                        <div style="width: 12px; height: 12px; background: var(--success-500); border-radius: 2px;"></div>
                                        <span style="font-size: var(--text-sm);">Completed (50%)</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: var(--space-2);">
                                        <div style="width: 12px; height: 12px; background: var(--warning-500); border-radius: 2px;"></div>
                                        <span style="font-size: var(--text-sm);">In Progress (25%)</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: var(--space-2);">
                                        <div style="width: 12px; height: 12px; background: var(--error-500); border-radius: 2px;"></div>
                                        <span style="font-size: var(--text-sm);">Overdue (8%)</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: var(--space-2);">
                                        <div style="width: 12px; height: 12px; background: var(--gray-300); border-radius: 2px;"></div>
                                        <span style="font-size: var(--text-sm);">Pending (17%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="grid grid-cols-3 gap-8 mb-8">
                <!-- Attendance Overview -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-calendar-check"></i>
                            Attendance Overview
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="--space-y: var(--space-4);">
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                                    <span style="font-size: var(--text-sm); color: var(--gray-600);">Present Days</span>
                                    <span style="font-size: var(--text-sm); font-weight: 500;">22/22</span>
                                </div>
                                <div style="width: 100%; height: 8px; background: var(--gray-200); border-radius: var(--radius-md); overflow: hidden;">
                                    <div style="width: 100%; height: 100%; background: var(--success-500);"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                                    <span style="font-size: var(--text-sm); color: var(--gray-600);">On Time Arrival</span>
                                    <span style="font-size: var(--text-sm); font-weight: 500;">20/22</span>
                                </div>
                                <div style="width: 100%; height: 8px; background: var(--gray-200); border-radius: var(--radius-md); overflow: hidden;">
                                    <div style="width: 91%; height: 100%; background: var(--primary-500);"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                                    <span style="font-size: var(--text-sm); color: var(--gray-600);">Late Arrivals</span>
                                    <span style="font-size: var(--text-sm); font-weight: 500;">2</span>
                                </div>
                                <div style="width: 100%; height: 8px; background: var(--gray-200); border-radius: var(--radius-md); overflow: hidden;">
                                    <div style="width: 9%; height: 100%; background: var(--warning-500);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Goal Progress -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-target"></i>
                            Goal Progress
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="text-align: center; margin-bottom: var(--space-6);">
                            <div style="position: relative; width: 120px; height: 120px; margin: 0 auto;">
                                <div style="width: 120px; height: 120px; border-radius: 50%; background: conic-gradient(var(--primary-500) 0deg 259deg, var(--gray-200) 259deg 360deg); display: flex; align-items: center; justify-content: center;">
                                    <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                        <span style="font-size: var(--text-xl); font-weight: 600; color: var(--primary-600);">72%</span>
                                        <span style="font-size: var(--text-xs); color: var(--gray-500);">Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <p style="margin: 0; font-size: var(--text-sm); color: var(--gray-600);">Monthly Target</p>
                            <p style="margin: 0; font-weight: 500;">36/50 Tasks</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Achievements -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-trophy"></i>
                            Recent Achievements
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="--space-y: var(--space-4);">
                            <div style="display: flex; gap: var(--space-3); padding-bottom: var(--space-3); border-bottom: 1px solid var(--gray-200);">
                                <div style="width: 32px; height: 32px; background: var(--warning-100); color: var(--warning-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-medal" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Perfect Attendance</p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">This month</p>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: var(--space-3); padding-bottom: var(--space-3); border-bottom: 1px solid var(--gray-200);">
                                <div style="width: 32px; height: 32px; background: var(--success-100); color: var(--success-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-star" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Top Performer</p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">Last week</p>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: var(--space-3);">
                                <div style="width: 32px; height: 32px; background: var(--primary-100); color: var(--primary-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-rocket" style="font-size: var(--text-xs);"></i>
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 500; font-size: var(--text-sm);">Early Adopter</p>
                                    <p style="margin: 0; color: var(--gray-500); font-size: var(--text-xs);">2 weeks ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Reports Table -->
            <div class="card">
                <div class="card-header">
                    <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                        <i class="fas fa-table"></i>
                        Detailed Activity Report
                    </h3>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Hours Worked</th>
                                <th>Tasks Completed</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jan 15, 2025</td>
                                <td>09:00 AM</td>
                                <td>06:00 PM</td>
                                <td>8.0h</td>
                                <td>3</td>
                                <td><span style="background: var(--success-100); color: var(--success-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Excellent</span></td>
                            </tr>
                            <tr>
                                <td>Jan 14, 2025</td>
                                <td>09:15 AM</td>
                                <td>06:15 PM</td>
                                <td>8.0h</td>
                                <td>2</td>
                                <td><span style="background: var(--primary-100); color: var(--primary-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Good</span></td>
                            </tr>
                            <tr>
                                <td>Jan 13, 2025</td>
                                <td>09:00 AM</td>
                                <td>05:45 PM</td>
                                <td>7.75h</td>
                                <td>4</td>
                                <td><span style="background: var(--success-100); color: var(--success-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Excellent</span></td>
                            </tr>
                            <tr>
                                <td>Jan 12, 2025</td>
                                <td>09:30 AM</td>
                                <td>06:30 PM</td>
                                <td>8.0h</td>
                                <td>1</td>
                                <td><span style="background: var(--warning-100); color: var(--warning-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Average</span></td>
                            </tr>
                            <tr>
                                <td>Jan 11, 2025</td>
                                <td>09:00 AM</td>
                                <td>06:00 PM</td>
                                <td>8.0h</td>
                                <td>3</td>
                                <td><span style="background: var(--success-100); color: var(--success-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Excellent</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <span>Showing 5 of 22 entries</span>
                    <div style="display: flex; gap: var(--space-2);">
                        <button class="btn btn-sm btn-secondary">Previous</button>
                        <button class="btn btn-sm btn-secondary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Chart interactions and animations would go here
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate real-time updates
            console.log('Analytics dashboard loaded');
        });
    </script>
</body>
</html>
