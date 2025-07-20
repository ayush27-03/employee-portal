<?php
require_once 'C:\xampp\htdocs\portal\includes\config.php';


// $search_query = $_GET['q'] ?? '';
// $per_page = $_GET['per_page'] ?? 10;
// $page = $_GET['page'] ?? 1;

try {
  // Build search query
  $sql = "SELECT employee.*, department.name as deptName, roles.name as roleName FROM employee JOIN department ON employee.department = department.id JOIN roles ON employee.role = roles.id";
  $params = [];
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <link rel="stylesheet" href="css\design-system.css">
  <link rel="stylesheet" href="css\components.css">
  <link rel="stylesheet" href="css\adminpanel.css">
</head>

<body class="admin-page">
  <!-- Include Navbar -->
  <?php include 'backend\navbar.php'; ?>

  <!-- Include Sidebar -->
  <?php include 'backend\sidebar.php'?>


  <!-- Main Content -->
  <main class="admin-main-content">
    <div class="admin-container"></div>
    <!-- User Table -->
    <div class="admin-table-container">
      <div class="table-header">
        <div class="table-title">
          <h2 class="table-title">Employee Directory</h2>
          <!-- <h2>All Users</h2> -->
          <p>Showing 1 to 10 of 142 users</p>
        </div>
        <div class="table-actions">
          <!-- <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search users...">
                        </div>
                        <div class="table-filters">
                            <select class="filter-select">
                                <option>All Roles</option>
                                <option>Admin</option>
                                <option>Manager</option>
                                <option>Employee</option>
                            </select>
                            <select class="filter-select">
                                <option>All Statuses</option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div> -->
          <!-- <div class="table-search">
            <form method="get" style="display: flex; gap: var(--space-3); align-items: center;">
              <div style="position: relative;">
                <i class="fas fa-search"
                  style="position: absolute; left: var(--space-3); top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                <input type="text" name="q" class="search-input" placeholder="Search employees..."
                  value="<?php echo htmlspecialchars($search_query); ?>" style="padding-left: var(--space-10);" />
              </div>
              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i>
                Search
              </button>
              <?php if (!empty($search_query)): ?>
                <a href="admin.php" class="btn btn-secondary btn-sm">
                  <i class="fas fa-times"></i>
                  Clear
                </a>
              <?php endif; ?>
            </form>
          </div> -->
        </div>

        <?php if (count($data) > 0): ?>
          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>Employee</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                <!-- <?php
                if (isset($_POST['val'])) {
                  echo "<pre>";
                  print_r($_POST);
                  // if($_POST['val'] == 1)
                  // $var = 0
                  // Update in database value 0
                }
                ?> -->
                <?php foreach ($data as $employee): ?>
                  <tr>
                    <!-- for employee -->
                    <td>
                      <!-- <div class="user-cell">
                                                        <div class="user-info">
                                                            <span class="user-name">John Doe</span>
                                                            <span class="user-id">#EMP-001</span>
                                                        </div>
                                                    </div> -->

                      <div style="display: flex; align-items: center; gap: var(--space-3);">
                        <div class="user-avatar-small">
                          <img src="https://randomuser.me/api/portraits/men/24.jpg" alt="User Avatar">
                        </div>
                        <!-- <div
                                                            style="width: 32px; height: 32px; background: var(--primary-100); color: var(--primary-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: var(--text-sm);">
                                                            <?php echo strtoupper(substr($employee['first_name'], 0, 1) . substr($employee['last_name'], 0, 1)); ?>
                                                        </div> -->
                        <span
                          style="font-family: var(--font-family-mono); font-size: var(--text-sm); color: var(--gray-500);">
                          #<?php echo str_pad($employee['id'], 4, '0', STR_PAD_LEFT); ?>
                        </span>
                        <div>
                          <div style="font-weight: 500; color: var(--gray-900);">
                            <?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']); ?>
                          </div>
                        </div>
                    </td>

                    <!-- for email -->
                    <td>
                      <?php echo htmlspecialchars($employee['email']) ?>
                    </td>
                    <!-- for department -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; padding: var(--space-1) var(--space-3); background: var(--gray-100); color: var(--gray-700); border-radius: var(--radius-md); font-size: var(--text-xs); font-weight: 500;">
                        <?php echo htmlspecialchars($employee['deptName']); ?>
                      </span>
                    </td>
                    <!-- for role -->
                    <td>
                      <span
                        style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-1) var(--space-3); background: <?php echo $roleClass; ?>; color: <?php echo $roleTextClass; ?>; border-radius: var(--radius-md); font-size: var(--text-xs); font-weight: 500;">
                        <!-- <i class="<?php echo $roleIcon; ?>"></i> -->
                        <?php echo ucfirst($employee['roleName']); ?>
                      </span>
                    </td>
                    <!-- for status -->
                    <td>
                      <div class="action-buttons">
                        <form action="" method="post">
                          <input type="hidden" name="id" value="<?= $employee['id']; ?>">
                          <input type="hidden" name="val" value="<?= $employee['status']; ?>">
                          <?php if ($employee['status'] == 1) { ?>
                            <button class="btn success">Active</button>
                          <?php } else { ?>
                            <button class="btn danger">Inactive</button>
                          <?php } ?>
                        </form>
                      </div>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <button class="action-btn view-user-btn" title="View Employee"
                          onclick="editEmployee(<?php echo $employee['id']; ?>)">
                          <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" title="Edit Employee"
                          onclick="editEmployee(<?php echo $employee['id']; ?>)">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" title="Delete Employee"
                          onclick="deleteEmployee(<?php echo $employee['id']; ?>, '<?php echo htmlspecialchars($employee['username']); ?>')">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>
                    <!-- for actions -->
                  <?php endforeach; ?>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Table Footer 1 -->
          <div class="table-footer">
            <div>
              Showing <?php echo count($data); ?> of <?php echo count($data); ?> employees
              <?php if (!empty($search_query)): ?>
                (filtered by "<?php echo htmlspecialchars($search_query); ?>")
              <?php endif; ?>
            </div>
            <div style="display: flex; align-items: center; gap: var(--space-3);">
              <span style="font-size: var(--text-sm); color: var(--gray-600);">Per page:</span>
              <select
                style="padding: var(--space-1) var(--space-2); border: 1px solid var(--gray-300); border-radius: var(--radius-md); font-size: var(--text-sm);">
                <option value="10" <?php echo $per_page == 10 ? 'selected' : ''; ?>>10</option>
                <option value="25" <?php echo $per_page == 25 ? 'selected' : ''; ?>>25</option>
                <option value="50" <?php echo $per_page == 50 ? 'selected' : ''; ?>>50</option>
              </select>
            </div>
          </div>
        <?php else: ?>
          
        <?php endif; ?>
      </div>

    </div>
    </div>
    </div>

    </div>

  </main>
  </body>
  </html>