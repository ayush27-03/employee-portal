<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Registration - Employee Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/design-system.css">
  <link rel="stylesheet" href="css/components.css">
</head>

<body>
  <div class="auth-container">
    <div class="auth-card">
      <?php
      session_start();
      require_once 'includes/config.php';
      try {
        $stmt = $conn->prepare("SELECT id, name FROM roles where status = 1 and id != 1");
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt1 = $conn->prepare("SELECT id, name FROM department where status = 1 and id != 3");
        $stmt1->execute();
        $dept = $stmt1->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }

      $error_message = '';
      $success_message = '';
      // $generated_username = '';
      
      //@ For new username generation
      function generateUniqueUsername($name, $conn1)
      {
        do {
          $username = strtolower($name) . rand(1000, 9999);
          $stmt = $conn1->prepare("SELECT id FROM employee WHERE username = ?");
          $stmt->execute([$username]);
        } while ($stmt->rowCount() > 0);
        return $username;
      }

      //@ Registration
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $password = $_POST['password'] ?? '';
        $dept_id_from_form = trim($_POST['dept_id'] ?? '');
        $role_id_from_form = trim($_POST['role_id'] ?? '');
        $status = 1; //@ Enum
      
        // Validation
        if (empty($first_name) || empty($last_name) || empty($password) || empty($dept_id_from_form) || empty($role_id_from_form)) {
          $error_message = 'Please fill in all required fields.';
        } else {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          try {
            $dbuser = generateUniqueUsername(strtolower($first_name . $last_name), $conn);

            //@ For checking whether username exists or not
            $check_sql = "SELECT COUNT(*) FROM employee WHERE username = :username";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->execute([':username' => $dbuser]);

            if ($check_stmt->fetchColumn() > 0) {
              $error_message = 'An employee with this name combination already exists. Please contact administrator.';
            } else {
              //@ For inserting data of a new user
              $sql = "INSERT INTO employee (first_name, last_name, username, password, department, role, status) VALUES(:first_name, :last_name, :username, :password, :department, :role, :status)";
              $stmt = $conn->prepare($sql);
              $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':username' => $dbuser,
                ':password' => $hashed_password,
                ':department' => $dept_id_from_form,
                ':role' => $role_id_from_form,
                ':status' => $status
              ]);
              $success_message = 'Employee registered successfully!';

              //@ Fetching Registered Department name
              // $deptStmt = $conn->prepare("SELECT name FROM department WHERE id = :id LIMIT 1");
              // $deptStmt->execute([':id' => $dept_id_from_form]);
              // $deptName = $deptStmt->fetchColumn();

              // //@ Fetching Registered Role name
              // $roleStmt = $conn->prepare("SELECT name FROM roles WHERE id = :id LIMIT 1");
              // $roleStmt->execute([':id' => $role_id_from_form]);
              // $roleName = $roleStmt->fetchColumn();

              // $_SESSION['dname'] = $deptName ?? 'Unknown';
              // $_SESSION['rname'] = $roleName ?? 'Unknown';

            }
          } catch (PDOException $e) {
            $error_message = 'Registration failed. Please try again later.';
          }
        }
      }
      ?>
      <?php if (!$success_message): ?>
        <div class="auth-header">
          <i class="fas fa-user-plus" style="font-size: var(--text-3xl); margin-bottom: var(--space-4);"></i>
          <h2>Employee Registration</h2>
          <p>Create a new employee account</p>
        </div>

        <div class="auth-body">
          <?php if ($error_message): ?>
            <div class="alert alert-error">
              <i class="fas fa-exclamation-circle"></i>
              <?php echo htmlspecialchars($error_message); ?>
            </div>
          <?php endif; ?>

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="grid grid-cols-2 gap-4">
              <div class="form-group">
                <label for="first_name" class="form-label">
                  <i class="fas fa-user"></i> First Name *
                </label>
                <input type="text" id="first_name" name="first_name" class="form-input" placeholder="Enter first name"
                  value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" required
                  autocomplete="given-name" />
              </div>

              <div class="form-group">
                <label for="last_name" class="form-label">
                  <i class="fas fa-user"></i> Last Name *
                </label>
                <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Enter last name"
                  value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>" required
                  autocomplete="family-name" />
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="form-label">
                <i class="fas fa-lock"></i> Password *
              </label>
              <input type="password" id="password" name="password" class="form-input" placeholder="Enter secure password"
                required autocomplete="new-password" minlength="6" />
              <small
                style="color: var(--gray-500); font-size: var(--text-xs); margin-top: var(--space-1); display: block;">
                Password should be at least 6 characters long
              </small>
            </div>

            <div class="form-group">
              <label for="department" class="form-label">
                <i class="fas fa-building"></i> Department *
              </label>
              <select id="dept_id" name="dept_id" class="form-select" required>
                <option value="">Select Department</option>
                <?php foreach ($dept as $y): ?>
                  <option value="<?= htmlspecialchars($y['id']) ?>">
                    <?= htmlspecialchars($y['name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="role" class="form-label">
                <i class="fas fa-user-tag"></i> Role *
              </label>
              <select id="role_id" name="role_id" class="form-select" required>
                <option value="">Select Role</option>
                <?php foreach ($roles as $x): ?>
                  <option value="<?= htmlspecialchars($x['id']) ?>">
                    <?= htmlspecialchars($x['name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
              <i class="fas fa-user-plus"></i>
              Register Employee
            </button>
          </form>
        </div>
      <?php else: ?>
        <!-- Success State -->
        <div class="registration-success">
          <div class="success-message-container">
            <div class="success-icon-wrapper">
              <span class="success-check-icon">✓</span>
            </div>
            <div class="success-message">
              <?php echo htmlspecialchars($success_message); ?>
            </div>
          </div>

          <div class="success-actions">
            <a href="login.php" class="btn btn-primary btn-success-primary">
              <i class="fas fa-sign-in-alt"></i>
              Login Now
            </a>
            <a href="register.php" class="btn btn-secondary btn-success-secondary">
              <i class="fas fa-plus"></i>
              Register Another Employee
            </a>
          </div>

          <div class="success-footer">
            <a href="index.php" class="back-to-home-link">
              <i class="fas fa-arrow-left"></i>
              Back to Home
            </a>
          </div>
        </div>
      </div>
      <?php endif;?>

      <?php if (!$success_message): ?>
      <div class="auth-footer">
        <p style="margin-bottom: var(--space-4); color: var(--gray-600);">
          Already have an account?
        </p>
        <a href="login.php" class="btn btn-outline" style="width: 100%;">
          <i class="fas fa-sign-in-alt"></i>
          Sign In Instead
        </a>
        <div style="margin-top: var(--space-6); padding-top: var(--space-4); border-top: 1px solid var(--gray-200);">
          <a href="index.php" style="color: var(--gray-500); font-size: var(--text-sm);">
            <i class="fas fa-arrow-left"></i> Back to Home
          </a>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <script>
    // Auto-hide alerts after 10 seconds
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        if (!alert.classList.contains('alert-success')) {
          alert.style.opacity = '0';
          alert.style.transition = 'opacity 0.5s ease';
          setTimeout(() => alert.remove(), 500);
        }
      });
    }, 10000);
  </script>
</body>

</html>