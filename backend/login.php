<?php
session_start();
// require_once 'C:\xampp\htdocs\portal\includes\config.php';
require_once '..\includes\config.php';

$error_message = '';
$success_message = '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login - Employee Management</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/design-system.css">
  <link rel="stylesheet" href="../css/components.css">
  <!-- <link rel="stylesheet" href="../css/adminpanel.css"> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>

<body>
  <div class="auth-container">
    <div class="auth-card">
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adminUserName = $_POST['username'];
        $adminPassword = $_POST['password'];
        try {
          $stmt = $conn->prepare("SELECT first_name, password FROM employee where username = :username AND role = 1 AND status = '1'");
          $stmt->execute([":username" => $adminUserName]);
          $admindb = $stmt->fetch(PDO::FETCH_ASSOC);
          if (!empty($admindb) && password_verify($adminPassword, $admindb['password'])) {

            $_SESSION['firstName'] = $admindb['first_name']; //Only firstName is required as role verification already completed
            header('Location: dashboard/dashboard.php');
          } else {
            if ((empty($adminUserName) || empty($adminPassword))) {
              $error_message = 'Please fill in all fields.';
            } else {

              $error_message = 'Invalid Password';
            }
          }
        } catch (PDOException $e) {
          $error_message = 'System error. Please try again later.';
        }
      }
      ?>
      <div class="auth-header">
        <div class="feature-icon">
          <i class="fas fa-user-shield"></i>
        </div>
        <h2>Admin Login</h2>
        <p>Access your employee management dashboard</p>
      </div>
      <div class="auth-body">
        <!-- Error message (hidden by default) -->
        <?php if ($error_message): ?>
          <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <?php echo htmlspecialchars($error_message); ?>
          </div>
        <?php endif; ?>

        <?php if (isset($_GET['message'])): ?>
          <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($_GET['message']) ?>
          </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?php echo htmlspecialchars($success_message); ?>
          </div>
        <?php endif; ?>


        <form id="loginForm" action="" method="POST">
          <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-input" placeholder="Enter your username"
              required>
          </div>

          <div class="form-group password-wrapper">
            <label for="password" class="form-label">
              <i class="fas fa-lock"></i> Password
            </label>
            <div class="input-container">
              <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password"
                required autocomplete="current-password" />
              <button type="button" class="password-toggle" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

        
          <div class="flex justify-between items-center mb-6">
            <!-- <div class="flex items-center gap-2">
              <input type="checkbox" id="remember" name="remember" class="form-checkbox">
              <label for="remember" class="text-sm text-gray-600 cursor-pointer">Remember me</label>
            </div> -->
            <a href="forgot-password.php" class="text-sm text-primary-600 hover:text-primary-700">Forgot password?</a>
          </div>

          <button type="submit" class="btn btn-primary w-full" style="width: 100%">
            <i class="fas fa-sign-in-alt"></i> Login
          </button>
        </form>
      </div>
      <div class="auth-footer">
        <p class="text-sm text-gray-600">Need help?
          <a href="support.php" class="text-primary-600 hover:text-primary-700">Contact support</a>
        </p>
      </div>
    </div>
  </div>

  <style>
    .password-wrapper {
      position: relative;
    }

    .input-container {
      position: relative;
      display: flex;
      align-items: center;
    }

    .form-input {
      padding-right: 40px;
      /* Make space for the eye icon */
      width: 100%;
    }

    .password-toggle {
      position: absolute;
      right: 10px;
      background: none;
      border: none;
      cursor: pointer;
      color: #666;
      padding: 0;
    }

    .password-toggle:hover {
      color: #333;
    }

    /* Remove default button styles */
    .password-toggle:focus {
      outline: none;
    }
  </style>

  <script>
    // Auto-hide alerts after 2 seconds
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => alert.remove(), 500);
      });
    }, 2000);

    // Toggle password visibility
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const toggleBtn = field.nextElementSibling;
      if (field.type === 'password') {
        field.type = 'text';
        toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
      } else {
        field.type = 'password';
        toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
      }
    }
  </script>

</body>

</html>