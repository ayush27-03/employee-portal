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
      require_once 'includes/config.php';

      $error_message = '';
      $success_message = '';

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $first_name = trim($_POST['first_name'] ?? '');
          $last_name = trim($_POST['last_name'] ?? '');
          $password = $_POST['password'] ?? '';
          $department = trim($_POST['department'] ?? '');
          $role = trim($_POST['role'] ?? '');

          // Validation
          if (empty($first_name) || empty($last_name) || empty($password) || empty($department) || empty($role)) {
              $error_message = 'Please fill in all required fields.';
          } else {
              // Generate username
              $username = strtolower($first_name . '.' . $last_name);

              // Hash the password
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);

              try {
                  // Check if username already exists
                  $check_sql = "SELECT COUNT(*) FROM employee WHERE username = :username";
                  $check_stmt = $conn->prepare($check_sql);
                  $check_stmt->execute([':username' => $username]);
                  
                  if ($check_stmt->fetchColumn() > 0) {
                      $error_message = 'An employee with this name combination already exists. Please contact administrator.';
                  } else {
                      $sql = "INSERT INTO employee (first_name, last_name, username, password, department, role) VALUES(:first_name, :last_name, :username, :password, :department, :role)";
                      $stmt = $conn->prepare($sql);

                      $stmt->execute([
                          ':first_name' => $first_name,
                          ':last_name' => $last_name,
                          ':username' => $username,
                          ':password' => $hashed_password,
                          ':department' => $department,
                          ':role' => $role
                      ]);

                      $success_message = 'Employee registered successfully!';
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
                <input 
                  type="text" 
                  id="first_name" 
                  name="first_name" 
                  class="form-input"
                  placeholder="Enter first name" 
                  value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>"
                  required
                  autocomplete="given-name"
                />
              </div>
              
              <div class="form-group">
                <label for="last_name" class="form-label">
                  <i class="fas fa-user"></i> Last Name *
                </label>
                <input 
                  type="text" 
                  id="last_name" 
                  name="last_name" 
                  class="form-input"
                  placeholder="Enter last name" 
                  value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>"
                  required
                  autocomplete="family-name"
                />
              </div>
            </div>
            
            <div class="form-group">
              <label for="password" class="form-label">
                <i class="fas fa-lock"></i> Password *
              </label>
              <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-input"
                placeholder="Enter secure password" 
                required
                autocomplete="new-password"
              />
            </div>
            
            <div class="form-group">
              <label for="department" class="form-label">
                <i class="fas fa-building"></i> Department *
              </label>
              <select id="department" name="department" class="form-select" required>
                <option value="">Select Department</option>
                <option value="Human Resources" <?php echo (($_POST['department'] ?? '') === 'Human Resources') ? 'selected' : ''; ?>>Human Resources</option>
                <option value="Information Technology" <?php echo (($_POST['department'] ?? '') === 'Information Technology') ? 'selected' : ''; ?>>Information Technology</option>
                <option value="Finance" <?php echo (($_POST['department'] ?? '') === 'Finance') ? 'selected' : ''; ?>>Finance</option>
                <option value="Marketing" <?php echo (($_POST['department'] ?? '') === 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                <option value="Operations" <?php echo (($_POST['department'] ?? '') === 'Operations') ? 'selected' : ''; ?>>Operations</option>
                <option value="Sales" <?php echo (($_POST['department'] ?? '') === 'Sales') ? 'selected' : ''; ?>>Sales</option>
              </select>
            </div>

            <div class="form-group">
              <label for="role" class="form-label">
                <i class="fas fa-user-tag"></i> Role *
              </label>
              <select id="role" name="role" class="form-select" required>
                <option value="">Select Role</option>
                <option value="Employee" <?php echo (($_POST['role'] ?? '') === 'Employee') ? 'selected' : ''; ?>>Employee</option>
                <option value="Admin" <?php echo (($_POST['role'] ?? '') === 'Admin') ? 'selected' : ''; ?>>Administrator</option>
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
      <?php endif; ?>
      
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

  <script>
    // Form validation (removed password length requirement)
    document.querySelector('form')?.addEventListener('submit', function(e) {
      const requiredFields = ['first_name', 'last_name', 'password', 'department', 'role'];
      let hasError = false;
      
      requiredFields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (!field.value.trim()) {
          hasError = true;
        }
      });
      
      if (hasError) {
        e.preventDefault();
        alert('Please fill in all required fields.');
        return false;
      }
    });

    // Auto-hide error alerts after 10 seconds
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert-error');
      alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => alert.remove(), 500);
      });
    }, 10000);
  </script>
</body>
</html>
