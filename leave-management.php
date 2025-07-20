<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management - Employee Portal</title>
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
                        <h1 style="margin-bottom: var(--space-2);">Leave Management</h1>
                        <p style="color: var(--gray-600);">
                            Request time off and manage your leave balance.
                        </p>
                    </div>
                    <button class="btn btn-primary" id="request-leave-btn">
                        <i class="fas fa-plus"></i>
                        Request Leave
                    </button>
                </div>
            </div>

            <!-- Leave Balance Overview -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--primary-100); color: var(--primary-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">18</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Annual Leave</p>
                        <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">Available</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--success-100); color: var(--success-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">5</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Sick Leave</p>
                        <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">Available</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--warning-100); color: var(--warning-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">3</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Personal Leave</p>
                        <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">Available</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--error-100); color: var(--error-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">7</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Days Used</p>
                        <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">This Year</p>
                    </div>
                </div>
            </div>

            <!-- Leave Request Form (Hidden by default) -->
            <div class="card mb-8" id="leave-request-form" style="display: none;">
                <div class="card-header">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-calendar-plus"></i>
                            Request New Leave
                        </h3>
                        <button class="btn btn-sm btn-secondary" id="cancel-request-btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="leave-form">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="leave-type" class="form-label">
                                    <i class="fas fa-tag"></i> Leave Type *
                                </label>
                                <select id="leave-type" name="leave_type" class="form-select" required>
                                    <option value="">Select Leave Type</option>
                                    <option value="annual">Annual Leave</option>
                                    <option value="sick">Sick Leave</option>
                                    <option value="personal">Personal Leave</option>
                                    <option value="emergency">Emergency Leave</option>
                                    <option value="maternity">Maternity/Paternity Leave</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="duration" class="form-label">
                                    <i class="fas fa-clock"></i> Duration *
                                </label>
                                <select id="duration" name="duration" class="form-select" required>
                                    <option value="">Select Duration</option>
                                    <option value="full-day">Full Day</option>
                                    <option value="half-day-morning">Half Day (Morning)</option>
                                    <option value="half-day-afternoon">Half Day (Afternoon)</option>
                                    <option value="multiple-days">Multiple Days</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="start-date" class="form-label">
                                    <i class="fas fa-calendar"></i> Start Date *
                                </label>
                                <input type="date" id="start-date" name="start_date" class="form-input" required />
                            </div>

                            <div class="form-group">
                                <label for="end-date" class="form-label">
                                    <i class="fas fa-calendar"></i> End Date *
                                </label>
                                <input type="date" id="end-date" name="end_date" class="form-input" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reason" class="form-label">
                                <i class="fas fa-comment"></i> Reason *
                            </label>
                            <textarea id="reason" name="reason" class="form-input" rows="4" placeholder="Please provide a reason for your leave request..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="emergency-contact" class="form-label">
                                <i class="fas fa-phone"></i> Emergency Contact
                            </label>
                            <input type="text" id="emergency-contact" name="emergency_contact" class="form-input" placeholder="Emergency contact person and phone number" />
                        </div>

                        <div style="display: flex; gap: var(--space-4); margin-top: var(--space-6);">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                Submit Request
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-undo"></i>
                                Reset Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Leave Calendar -->
            <div class="card mb-8">
                <div class="card-header">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-calendar"></i>
                            Leave Calendar
                        </h3>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span style="font-size: var(--text-sm); color: var(--gray-600); padding: var(--space-2) var(--space-3);">
                                January 2025
                            </span>
                            <button class="btn btn-sm btn-secondary">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Calendar Grid -->
                    <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 1px; background: var(--gray-200); border-radius: var(--radius-lg); overflow: hidden;">
                        <!-- Calendar Header -->
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Sun</div>
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Mon</div>
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Tue</div>
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Wed</div>
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Thu</div>
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Fri</div>
                        <div style="background: var(--gray-100); padding: var(--space-3); text-align: center; font-weight: 500; font-size: var(--text-sm);">Sat</div>

                        <!-- Calendar Days (Sample for January 2025) -->
                        <!-- Week 1 -->
                        <div style="background: white; padding: var(--space-3); min-height: 80px; color: var(--gray-400);">29</div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; color: var(--gray-400);">30</div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; color: var(--gray-400);">31</div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; position: relative;">
                            <span style="font-weight: 500;">1</span>
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: var(--success-100); color: var(--success-700); font-size: var(--text-xs); padding: 1px 4px; border-radius: 2px; text-align: center;">Holiday</div>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">2</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">3</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">4</span>
                        </div>

                        <!-- Week 2 -->
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">5</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">6</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">7</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">8</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">9</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">10</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">11</span>
                        </div>

                        <!-- Week 3 -->
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">12</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">13</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">14</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; position: relative;">
                            <span style="font-weight: 500;">15</span>
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: var(--warning-100); color: var(--warning-700); font-size: var(--text-xs); padding: 1px 4px; border-radius: 2px; text-align: center;">Pending</div>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; position: relative;">
                            <span style="font-weight: 500;">16</span>
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: var(--warning-100); color: var(--warning-700); font-size: var(--text-xs); padding: 1px 4px; border-radius: 2px; text-align: center;">Pending</div>
                        </div>
                        <div style="background: var(--primary-50); padding: var(--space-3); min-height: 80px; border: 2px solid var(--primary-500);">
                            <span style="font-weight: 600; color: var(--primary-600);">17</span>
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: var(--primary-500); color: white; font-size: var(--text-xs); padding: 1px 4px; border-radius: 2px; text-align: center;">Today</div>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">18</span>
                        </div>

                        <!-- Continue with more weeks... -->
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">19</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">20</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">21</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">22</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">23</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">24</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">25</span>
                        </div>

                        <!-- Final week -->
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">26</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; position: relative;">
                            <span style="font-weight: 500;">27</span>
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: var(--primary-100); color: var(--primary-700); font-size: var(--text-xs); padding: 1px 4px; border-radius: 2px; text-align: center;">Approved</div>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; position: relative;">
                            <span style="font-weight: 500;">28</span>
                            <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: var(--primary-100); color: var(--primary-700); font-size: var(--text-xs); padding: 1px 4px; border-radius: 2px; text-align: center;">Approved</div>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">29</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">30</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px;">
                            <span style="font-weight: 500;">31</span>
                        </div>
                        <div style="background: white; padding: var(--space-3); min-height: 80px; color: var(--gray-400);">1</div>
                    </div>

                    <!-- Calendar Legend -->
                    <div style="margin-top: var(--space-6); display: flex; gap: var(--space-6); justify-content: center; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                            <div style="width: 16px; height: 16px; background: var(--primary-100); border-radius: 2px;"></div>
                            <span style="font-size: var(--text-sm); color: var(--gray-600);">Approved Leave</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                            <div style="width: 16px; height: 16px; background: var(--warning-100); border-radius: 2px;"></div>
                            <span style="font-size: var(--text-sm); color: var(--gray-600);">Pending Approval</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                            <div style="width: 16px; height: 16px; background: var(--success-100); border-radius: 2px;"></div>
                            <span style="font-size: var(--text-sm); color: var(--gray-600);">Public Holiday</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                            <div style="width: 16px; height: 16px; background: var(--primary-500); border-radius: 2px;"></div>
                            <span style="font-size: var(--text-sm); color: var(--gray-600);">Today</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave History -->
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-history"></i>
                            Leave History
                        </h3>
                        <div style="display: flex; gap: var(--space-3);">
                            <select class="form-select" style="width: auto;">
                                <option>All Types</option>
                                <option>Annual Leave</option>
                                <option>Sick Leave</option>
                                <option>Personal Leave</option>
                            </select>
                            <select class="form-select" style="width: auto;">
                                <option>This Year</option>
                                <option>Last Year</option>
                                <option>All Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Approved By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jan 10, 2025</td>
                                <td>Annual Leave</td>
                                <td>Jan 15, 2025</td>
                                <td>Jan 16, 2025</td>
                                <td>2</td>
                                <td><span style="background: var(--warning-100); color: var(--warning-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Pending</span></td>
                                <td>-</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn edit" title="Edit Request">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Cancel Request">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Dec 20, 2024</td>
                                <td>Annual Leave</td>
                                <td>Jan 27, 2025</td>
                                <td>Jan 28, 2025</td>
                                <td>2</td>
                                <td><span style="background: var(--success-100); color: var(--success-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Approved</span></td>
                                <td>Sarah Johnson</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn" title="View Details" style="background: var(--gray-100); color: var(--gray-600);">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nov 15, 2024</td>
                                <td>Sick Leave</td>
                                <td>Nov 18, 2024</td>
                                <td>Nov 18, 2024</td>
                                <td>1</td>
                                <td><span style="background: var(--success-100); color: var(--success-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Approved</span></td>
                                <td>Sarah Johnson</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn" title="View Details" style="background: var(--gray-100); color: var(--gray-600);">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Oct 05, 2024</td>
                                <td>Personal Leave</td>
                                <td>Oct 12, 2024</td>
                                <td>Oct 12, 2024</td>
                                <td>1</td>
                                <td><span style="background: var(--error-100); color: var(--error-700); padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">Rejected</span></td>
                                <td>Sarah Johnson</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="action-btn" title="View Details" style="background: var(--gray-100); color: var(--gray-600);">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <span>Showing 4 of 12 entries</span>
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

    <script>
        // Show/hide leave request form
        document.getElementById('request-leave-btn').addEventListener('click', function() {
            document.getElementById('leave-request-form').style.display = 'block';
            this.style.display = 'none';
        });

        document.getElementById('cancel-request-btn').addEventListener('click', function() {
            document.getElementById('leave-request-form').style.display = 'none';
            document.getElementById('request-leave-btn').style.display = 'inline-flex';
        });

        // Form submission
        document.getElementById('leave-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Leave request submitted successfully! (This would be handled by backend)');
            document.getElementById('leave-request-form').style.display = 'none';
            document.getElementById('request-leave-btn').style.display = 'inline-flex';
        });

        // Duration change handler
        document.getElementById('duration').addEventListener('change', function() {
            const endDateField = document.getElementById('end-date');
            if (this.value === 'full-day' || this.value.includes('half-day')) {
                endDateField.disabled = true;
                endDateField.value = document.getElementById('start-date').value;
            } else {
                endDateField.disabled = false;
            }
        });

        // Start date change handler
        document.getElementById('start-date').addEventListener('change', function() {
            const duration = document.getElementById('duration').value;
            if (duration === 'full-day' || duration.includes('half-day')) {
                document.getElementById('end-date').value = this.value;
            }
        });

        // Table actions
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.title;
                alert(`${action} functionality would be implemented here`);
            });
        });
    </script>
</body>
</html>
