<?php
session_start();
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login - Employee Portal</title>
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
            //@ Fetching data from roles table
            try {
                $stmt = $conn->prepare("SELECT id, name FROM roles where id != 1 AND status = 1");
                $stmt->execute();
                $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                echo "Error: Database Issue";
            }
            ?>

            <div class="auth-header">
                <i class="fas fa-user-shield" style="font-size: var(--text-3xl); margin-bottom: var(--space-4);"></i>
                <h2>Welcome Back</h2>
                <p>Sign in to your employee account</p>
            </div>

            <div class="auth-body">
                <?php
                $error_message = '';
                $success_message = '';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $username = trim($_POST['username'] ?? '');
                    $password = $_POST['password'] ?? '';
                    $selectedRole = $_POST['role_id'] ?? '';

                    if (empty($username) || empty($password) || empty($selectedRole) || $selectedRole === 'select role') {
                        $error_message = 'Please fill in all fields and select a valid role.';
                    } else {
                        try {
                            $sql = "SELECT * FROM employee WHERE username = :username AND role = :selectedRole AND status = 1";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([':username' => $username, ':selectedRole' => (int) $selectedRole]);
                            $employee = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($employee && password_verify($password, $employee['password'])) {

                                //@ Getting all password verified data to the session
                                $_SESSION['eid'] = $employee['id'];
                                $_SESSION['firstName'] = $employee['first_name'];
                                $_SESSION['lastName'] = $employee['last_name'];
                                $_SESSION['username'] = $username;
                                $_SESSION['role'] = $employee['role'];
                                $_SESSION['dbDept'] = $employee['department'];
                                $_SESSION['dbDate'] = $employee['created_at'];

                                //@ Fetching Role Name from the roles table
                                $roleID = $_SESSION['role'];
                                $sql1 = "SELECT name from roles where id = :roleID and status = 1";
                                $stmt1 = $conn->prepare($sql1);
                                $stmt1->execute([':roleID' => $roleID]);

                                $roleName = $stmt1->fetchColumn();
                                $_SESSION['rname'] = $roleName;

                                //@ Fetching Department Name from the department table
                                $deptID = $_SESSION['role'];
                                $sql1 = "SELECT name from department where id = :deptID and status = 1";
                                $stmt1 = $conn->prepare($sql1);
                                $stmt1->execute([':deptID' => $deptID]);

                                $deptName = $stmt1->fetchColumn();
                                $_SESSION['dname'] = $deptName;


                                //@ Verification of selected role with database role but using session
                                if ((int) $selectedRole !== (int) $employee['role']) {
                                    $error_message = "You're unauthorized for this level of access";
                                } else {
                                    header('Location: dashboard.php');
                                }
                            } else {
                                $error_message = 'Invalid Password';
                            }
                        } catch (PDOException $e) {
                            $error_message = 'System error. Please try again later.';
                        }
                    }
                }
                ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <!-- //@ For Logout functionality -->
                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($_GET['message']) ?>
                    </div>
                <?php endif; ?>

                <!-- //@ For Denying access to critical pages functionality -->
                <!-- //if (!isset($_GET['message'])): -->
                <!-- <div class="alert alert-error"> -->
                <!-- <i class="fas fa-exclamation-circle"></i> -->
                <!--  //htmlspecialchars($_GET['message']) -->
                <!-- // </div> -->

                <?php if ($success_message): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input type="text" id="username" name="username" class="form-input"
                            placeholder="Enter your username"
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required
                            autocomplete="username" />
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" id="password" name="password" class="form-input"
                            placeholder="Enter your password" required autocomplete="current-password" />
                    </div>

                    <div class="form-group">
                        <label for="role" class="form-label">
                            <i class="fas fa-user-tag"></i> Role *
                        </label>
                        <select name="role_id" class="form-select" required>
                            <option value="">Select Role</option>
                            <?php foreach ($roles as $x): ?>
                                <option value="<?= htmlspecialchars($x['id']) ?>">
                                    <?= htmlspecialchars($x['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>
            </div>

            <div class="auth-footer">
                <p style="margin-bottom: var(--space-4); color: var(--gray-600);">
                    Don't have an account?
                </p>
                <a href="register.php" class="btn btn-outline" style="width: 100%;">
                    <i class="fas fa-user-plus"></i>
                    Create New Account
                </a>

                <div
                    style="margin-top: var(--space-6); padding-top: var(--space-4); border-top: 1px solid var(--gray-200);">
                    <a href="index.php" style="color: var(--gray-500); font-size: var(--text-sm);">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Auto-hide alerts after 3 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);
    </script>
</body>

</html>

<!-- 
//@ Remove multiple PHP_SELf as navbar attached to the top would've all the functionality
-->