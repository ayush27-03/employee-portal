<?php
ob_start();
require_once '..\..\includes\config.php';

$limit = isset($_GET['rows']) ? (int) $_GET['rows'] : 5;
$allowedLimits = [5, 10, 25, 50, 100];
if (!in_array($limit, $allowedLimits)) {
  $limit = 5;
}
$myPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($myPage < 1)
  $myPage = 1;
$offset = ($myPage - 1) * $limit;

// Data retrieval
try {
  $sql = "SELECT employee.*, department.name as deptName, roles.name as roleName FROM employee JOIN department ON employee.department = department.id JOIN roles ON employee.role = roles.id LIMIT :limit OFFSET :offset";
  // $params = [];
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $error_message = "Database error: " . $e->getMessage();
  $data = [];
}

// Count retrieval
$stmt2 = $conn->query("SELECT COUNT(*) as count FROM employee");
$count = $stmt2->fetch(PDO::FETCH_ASSOC);
$allRows = $count['count'];
$allPages = ceil($allRows / $limit);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
  /* Modal Styles */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
  }

  .modal-overlay.show {
    display: flex;
  }

  .modal {
    background-color: white;
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-xl);
    width: 100%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideIn 0.3s ease;
    margin: 1rem;
  }

  .modal-header {
    padding: 1.5rem 2rem 1rem;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .modal-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-900);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--gray-500);
    cursor: pointer;
    padding: 0.25rem;
    line-height: 1;
    border-radius: var(--radius-md);
    transition: all 0.2s ease;
  }

  .modal-close:hover {
    color: var(--gray-700);
    background-color: var(--gray-100);
  }

  .modal-body {
    padding: 2rem;
  }

  .modal-footer {
    padding: 1rem 2rem 2rem;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    border-top: 1px solid var(--gray-200);
  }

  /* Form Styles */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-group.full-width {
    grid-column: 1 / -1;
  }

  .form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
  }

  .form-input,
  .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--gray-300);
    border-radius: var(--radius-lg);
    font-size: 1rem;
    transition: all 0.2s ease;
    background-color: white;
  }

  .form-input:focus,
  .form-select:focus {
    outline: none;
    border-color: var(--primary-500);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .form-input:read-only {
    background-color: var(--gray-50);
    color: var(--gray-600);
  }

  .form-hint {
    font-size: 0.75rem;
    color: var(--gray-500);
    margin-top: 0.25rem;
  }

  /* Radio Button Styles */
  .radio-group {
    display: flex;
    gap: 1.5rem;
    margin-top: 0.5rem;
  }

  .radio-option {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
  }

  .radio-option input[type="radio"] {
    width: 1rem;
    height: 1rem;
    margin: 0;
  }

  /* Loading State */
  .loading-spinner {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    color: var(--primary-600);
  }

  .loading-spinner i {
    font-size: 2rem;
    animation: spin 1s linear infinite;
  }

  /* Alert Styles */
  .alert {
    padding: 1rem;
    border-radius: var(--radius-lg);
    margin-bottom: 1rem;
    border: 1px solid;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .alert-success {
    background-color: var(--success-50);
    border-color: var(--success-200);
    color: var(--success-800);
  }

  .alert-error {
    background-color: var(--error-50);
    border-color: var(--error-200);
    color: var(--error-800);
  }

  /* Animations */
  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @keyframes slideIn {
    from {
      transform: translateY(-20px);
      opacity: 0;
    }

    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }

    .modal {
      margin: 0.5rem;
      max-width: calc(100% - 1rem);
    }

    .modal-header,
    .modal-body,
    .modal-footer {
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }
</style>

<script>
  // Global variables
  let currentEmployeeId = null;

  /**
   * Opens the edit modal and loads employee data
   * @param {number} employeeId - The ID of the employee to edit
   */
  function openEditModal(employeeId) {
    currentEmployeeId = employeeId;
    const modal = document.getElementById('editEmployeeModal');
    const modalBody = document.getElementById('modalBody');

    // Show modal
    modal.classList.add('show');

    // Fetch employee data
    fetch(`get_employee.php?id=${employeeId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          populateEditForm(data.employee, data.departments, data.roles);
        } else {
          showError(data.message || 'Failed to load employee data');
        }
      })
      .catch(error => {
        console.error('Error fetching employee data:', error);
        showError('Failed to load employee data. Please try again.');
      });
  }

  /**
   * Populating the edit form with employee data
   * @param {object} employee - Employee data
   * @param {array} departments - Available departments
   * @param {array} roles - Available roles
   */
  function populateEditForm(employee, departments, roles) {
    const modalBody = document.getElementById('modalBody');

    // Build department options
    let departmentOptions = '';
    departments.forEach(dept => {
      const selected = dept.id == employee.department ? 'selected' : '';
      departmentOptions += `<option value="${dept.id}" ${selected}>${dept.name}</option>`;
    });

    // Build role options
    let roleOptions = '';
    roles.forEach(role => {
      const selected = role.id == employee.role ? 'selected' : '';
      roleOptions += `<option value="${role.id}" ${selected}>${role.name}</option>`;
    });

    // Create form HTML
    modalBody.innerHTML = `
        <div id="alertContainer"></div>
        
        <form id="editEmployeeForm">
          <div class="form-grid">
            <!-- Personal Information -->
            <div class="form-group">
              <label for="firstName" class="form-label">First Name *</label>
              <input type="text" id="firstName" name="first_name" class="form-input" 
                     value="${employee.first_name}" required>
            </div>
            
            <div class="form-group">
              <label for="lastName" class="form-label">Last Name *</label>
              <input type="text" id="lastName" name="last_name" class="form-input" 
                     value="${employee.last_name}" required>
            </div>
            
            <!-- Account Information -->
            <div class="form-group">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" name="username" class="form-input" 
                     value="${employee.username}" readonly>
              <div class="form-hint">Username cannot be changed</div>
            </div>
            
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-input" 
                     value="${employee.email || ''}" placeholder="Enter email address">
            </div>
                      
            <!-- Department and Role -->
            <div class="form-group">
              <label for="department" class="form-label">Department *</label>
              <select id="department" name="department" class="form-select" required>
                ${departmentOptions}
              </select>
            </div>
            
            <div class="form-group">
              <label for="role" class="form-label">Role *</label>
              <select id="role" name="role" class="form-select" required>
                ${roleOptions}
              </select>
            </div>
          </div>
        </form>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeEditModal()">
            Cancel
          </button>
          <button type="button" class="btn btn-primary" onclick="submitEditForm()">
            <i class="fas fa-save"></i>
            Update Employee
          </button>
        </div>
      `;
  }

  /**
   * Submits the edit form via AJAX
   */
  function submitEditForm() {
    const form = document.getElementById('editEmployeeForm');
    const formData = new FormData(form);
    formData.append('employee_id', currentEmployeeId);

    // Show loading state
    const submitBtn = document.querySelector('.modal-footer .btn-primary');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
    submitBtn.disabled = true;

    // Submit form
    fetch('update_employee.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showAlert('Employee updated successfully!', 'success');
          setTimeout(() => {
            closeEditModal();
            location.reload(); 
          }, 1500);
        } else {
          showAlert(data.message || 'Failed to update employee', 'error');
        }
      })
      .catch(error => {
        console.error('Error updating employee:', error);
        showAlert('Failed to update employee. Please try again.', 'error');
      })
      .finally(() => {
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      });
  }

  /**
   * Closes the edit modal
   */
  function closeEditModal() {
    const modal = document.getElementById('editEmployeeModal');
    modal.classList.remove('show');
    currentEmployeeId = null;
  }

  /**
   * Shows an alert message in the modal
   * @param {string} message - The message to display
   * @param {string} type - The type of alert ('success' or 'error')
   */
  function showAlert(message, type) {
    const alertContainer = document.getElementById('alertContainer');
    const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
    const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

    alertContainer.innerHTML = `
        <div class="alert ${alertClass}">
          <i class="fas ${iconClass}"></i>
          ${message}
        </div>
      `;

    if (type === 'success') {
      setTimeout(() => {
        alertContainer.innerHTML = '';
      }, 3000);
    }
  }

  /**
   * Shows an error message when data loading fails
   * @param {string} message - The error message to display
   */
  function showError(message) {
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = `
        <div class="alert alert-error">
          <i class="fas fa-exclamation-circle"></i>
          ${message}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeEditModal()">
            Close
          </button>
          <button type="button" class="btn btn-primary" onclick="openEditModal(${currentEmployeeId})">
            <i class="fas fa-redo"></i>
            Try Again
          </button>
        </div>
      `;
  }

  // Event listeners
  document.addEventListener('DOMContentLoaded', function () {
    // Close modal when clicking outside
    document.getElementById('editEmployeeModal').addEventListener('click', function (e) {
      if (e.target === this) {
        closeEditModal();
      }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && document.getElementById('editEmployeeModal').classList.contains('show')) {
        closeEditModal();
      }
    });
  });
</script>

<body class="admin-page">
  <!-- Include Navbar -->
  <?php include '..\navbar.php'; ?>

  <!-- Include Sidebar -->
  <?php include '..\sidebar.php' ?>

  <!-- Main Content -->
  <main class="admin-main-content">
    <div class="admin-container">
      <!-- User Table -->
      <div class="admin-table-container">
        <div class="table-header">
          <div class="table-title">
            <h2 class="table-title">Employee Directory</h2>
            <p>Enlisted data of <?php echo $count['count']; ?> users</p>
          </div>
        </div>

        <?php if (count($data) > 0): ?>
          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Employee</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Email</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Department</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Role</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Country</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Joining Date</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Status</th>
                  <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Actions</th>
                  <!-- <th style="font-weight: 900; color: var(--primary-900);">Certifications</th> -->
                  <!-- <th style="font-weight: 900; color: var(--primary-900);">Work Experience</th> -->
                </tr>
              </thead>

              <?php
              // For status check
              if (isset($_POST['currentStatus'])) {
                if ($_POST['currentStatus'] == 1) {
                  $newStatus = '0';
                } else {
                  $newStatus = '1';
                }
                $stmt = $conn->prepare("UPDATE employee SET status = :newStatus WHERE id = :id");
                $stmt->bindParam(":id", $_POST['id']);
                $stmt->bindParam(":newStatus", $newStatus);
                $stmt->execute();
                if (isset($_GET['page'])) {
                  $currentPage = $_GET['page'];
                } else {
                  $currentPage = 1;
                }
                if ($stmt->rowCount() > 0) {
                  header('Location: ' . $_SERVER['PHP_SELF'] . "?page=" . $currentPage);
                }
              }

              //For triggerring soft delete functionality
            

              //For Date Formatting
              function formatDateWithOrdinalSimple($dateString)
              {
                $date = strtotime($dateString);
                $day = date('j', $date); // Day without leading zeros 
                $suffix = 'th';
                if ($day % 100 < 11 || $day % 100 > 13) {
                  switch ($day % 10) {
                    case 1:
                      $suffix = 'st';
                      break;
                    case 2:
                      $suffix = 'nd';
                      break;
                    case 3:
                      $suffix = 'rd';
                      break;
                  }
                }
                return $day . $suffix . ' ' . date("M Y", $date);
              }
              ?>

              <tbody>
                <?php foreach ($data as $employee): ?>
                  <tr>
                    <!-- Employee Info -->
                    <td>
                      <div style="display: flex; align-items: center; gap: var(--space-3);">
                        <div class="user-avatar-small">
                          <img src="https://randomuser.me/api/portraits/men/24.jpg" alt="User Avatar">
                        </div>
                        <span
                          style="font-family: var(--font-family-mono); font-size: var(--text-sm); color: var(--gray-500);">
                          #<?php echo str_pad($employee['id'], 4, '0', STR_PAD_LEFT); ?>
                        </span>
                        <div>
                          <div style="font-weight: 900; color: var(--gray-900);">
                            <?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']); ?>
                          </div>
                        </div>
                      </div>
                    </td>

                    <!-- Email -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; padding: var(--space-1) var(--space-3); background: var(--gray-100); color: var(--gray-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                        <?php echo htmlspecialchars($employee['email']) ?>
                      </span>
                    </td>

                    <!-- Department -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; padding: var(--space-1) var(--space-3); background: var(--gray-100); color: var(--gray-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                        <?php echo htmlspecialchars($employee['deptName']); ?>
                      </span>
                    </td>

                    <!-- Role -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-1) var(--space-3); background: var(--primary-100); color: var(--primary-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                        <?php echo ucfirst($employee['roleName']); ?>
                      </span>
                    </td>
                    <!-- <td>--</td> -->
                    <!-- <td>--</td> -->

                    <!-- Employee Country -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-1) var(--space-3); background: var(--primary-100); color: var(--primary-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                        <?php echo $employee['country']; ?>
                      </span>
                    </td>

                    <!-- Employee Joining Date -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-1) var(--space-3); background: var(--primary-100); color: var(--primary-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                        <!--  #echo (date("d-M-Y", strtotime($employee['created_at'])))-->

                        <?php echo formatDateWithOrdinalSimple($employee['created_at']); ?>

                      </span>
                    </td>

                    <!-- Status -->
                    <td>
                      <div class="action-buttons">
                        <form action="" method="POST">
                          <input type="hidden" name="id" value="<?= $employee['id']; ?>">
                          <input type="hidden" name="currentStatus" value="<?= $employee['status']; ?>">
                          <?php if ($employee['status'] == 1) { ?>
                            <button class="btn btn-sm success"
                              style="background-color: green; font-weight: 900; color: var(--success-50); font-size: var(--text-xs);">Active</button>
                          <?php } else { ?>
                            <button class="btn btn-sm danger"
                              style="background-color: red; font-weight: 900; color: var(--success-50); font-size: var(--text-xs);">Inactive</button>
                          <?php } ?>
                        </form>
                      </div>
                    </td>

                    <!-- Actions -->
                    <td>
                      <div class="action-buttons">
                        <button class="action-btn view-user-btn" title="View Employee">
                          <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" title="Edit Employee"
                          onclick="openEditModal(<?php echo $employee['id']; ?>)">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" title="Delete Employee"
                          onclick="softDeleteEmployee(<?php echo $employee['id']; ?>, this)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>

                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Table Footer -->
        <div class="table-footer">
          <div class="table-pagination">
            <?php if ($myPage > 1): ?>
              <a href="?page=<?= $myPage - 1 ?>&rows=<?= $limit ?>" class="pagination-btn"><i
                  class="fas fa-chevron-left"></i></a>
            <?php else: ?>
              <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $allPages; $i++): ?>
              <?php if ($i == $myPage): ?>
                <button class="pagination-btn active"><?= $i ?></button>
              <?php else: ?>
                <a href="?page=<?= $i ?>&rows=<?= $limit ?>" class="pagination-btn"><?= $i ?></a>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($myPage < $allPages): ?>
              <a href="?page=<?= $myPage + 1 ?>&rows=<?= $limit ?>" class="pagination-btn"><i
                  class="fas fa-chevron-right"></i></a>
            <?php else: ?>
              <button class="pagination-btn" disabled><i class="fas fa-chevron-right"></i></button>
            <?php endif; ?>
          </div>
          <div class="table-page-size">
            <span>Rows per page:</span>
            <select id="rowsPerPage" onchange="changeRowsPerPage(this.value)">
              <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
              <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
              <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
              <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
              <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
            </select>
          </div>
        </div>
      </div>

    <?php else: ?>
      <div style="padding: var(--space-16); text-align: center;">
        <div
          style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--gray-100); color: var(--gray-400); border-radius: 50%; margin-bottom: var(--space-4);">
          <i class="fas fa-users" style="font-size: var(--text-2xl);"></i>
        </div>
        <h3 style="margin-bottom: var(--space-2); color: var(--gray-700);">No employees found</h3>
        <p style="color: var(--gray-500); margin-bottom: var(--space-6);">
          There are no employees in the system yet.
        </p>
      </div>
    <?php endif; ?>
    </div>
    </div>
  </main>

  <!-- Edit Employee Modal -->
  <div class="modal-overlay" id="editEmployeeModal">
    <div class="modal">
      <div class="modal-header">
        <h3>
          <i class="fas fa-user-edit"></i>
          Edit Employee
        </h3>
        <button class="modal-close" onclick="closeEditModal()">&times;</button>
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Content will be loaded here -->
      </div>
    </div>
  </div>

  <?php include '../footer.php'; ?>
  <style>
    tr {
      transition: opacity 0.3s ease;
    }

    .action-btn.delete {
      color: var(--error-500);
    }

    .action-btn.delete:hover {
      color: var(--error-700);
      background-color: var(--error-100);
    }
  </style>
  <script>
    function changeRowsPerPage(rows) {
      const url = new URL(window.location.href);
      url.searchParams.set('rows', rows);
      url.searchParams.set('page', 1);
      window.location.href = url.toString();
    }
    function softDeleteEmployee(employeeId, buttonElement) {
      if (confirm('Are you sure you want to delete this employee?')) {
        // Show loading state
        const originalHTML = buttonElement.innerHTML;
        buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        buttonElement.disabled = true;

        // Perform AJAX request
        fetch('soft_delete_employee.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `id=${employeeId}`
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Remove the row from the table
              const row = buttonElement.closest('tr');
              row.style.opacity = '0.5';
              setTimeout(() => {
                row.remove();
                // Check if table is empty now
                if (document.querySelectorAll('tbody tr').length === 0) {
                  location.reload(); // Reload to show empty state
                }
              }, 500);
            } else {
              alert('Error: ' + (data.message || 'Failed to delete employee'));
              buttonElement.innerHTML = originalHTML;
              buttonElement.disabled = false;
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete employee');
            buttonElement.innerHTML = originalHTML;
            buttonElement.disabled = false;
          });
      }
    }
  </script>

</body>

</html>