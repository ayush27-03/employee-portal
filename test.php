<?php
session_start();
require_once 'includes/config.php';

// if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
//     header('Location: index.php');
// }

// try {
    // if ($_SERVER['PHP_SELF']) {
    //     $stmt1 = $conn->prepare("SELECT id FROM roles");
    //     $stmt1->execute();
    //     $roledb = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    //     $stmt2 = $conn->prepare("SELECT id FROM department");
    //     $stmt2->execute();
    //     $deptdb = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    //     $stmt3 = $conn->prepare("SELECT id FROM employee");
    //     $stmt3->execute();
    //     $empdb = $stmt3->fetchAll(PDO::FETCH_ASSOC);


    //@ Session Details
    echo "<pre>";
    echo "Session Details<br><br>";
    print_r($_SESSION);
    // print_r(session_status());
    echo "<br><br>";
    // session_destroy();
    /*
    //       <?php if (isset($_GET['message'])): ?>
        //  <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <?= htmlspecialchars($_GET['message']) ?>
        </div>
        <?php endif; ?>
        */

        // function checkAsUserTypesPassword($error_message)
        // {
            //     if ($error_message) {
                //         echo "<div class='alert alert-error'>$error_message</div>";
    //     }
    // }
    // function checkPasswordChangeSuccess($password_change_success)
    // {
        //     if ($password_change_success) {
            //         echo "<div class='alert alert-success'>Password changed successfully.</div>";
            //     }
            /* <input class="form-input" type="email" id="email" name="email" <?php if (!empty($_SESSION['email'])) { ?>value="<?php echo htmlspecialchars($currMail); ?>" <?php } else { ?> value="" required<?php } ?>  />
    // } 

    
    //@ Check current passsword from db and forms match or not

    echo "<br><br>";
    // echo $_SESSION['dname'];
    // print_r($x['name']);
    
    //     // var_dump($emp); echo "<br>";
    
    //     print "Roles Database Details<br>";
    //     print_r($roledb[1]["id"]);echo "<br>";echo "<br>";
    
    //     print "Department Database Details<br>";
    //     print_r($deptdb[1]["id"]);echo "<br>";echo "<br>";

    //     print "Employee Database Details<br>";
    //     print_r($empdb[1]["id"]);echo "<br>";echo "<br>";

    //     // print "Data to retrieve<br>";
    //     // print_r($emp[2]["id"]);
    //     // echo "<br>";echo "<br>";

    // }
} catch (Exception $e) {
    $error_message = "Error loading user data.";
}

*/

/**
                <div class="card-body">
                        <!-- Success/Error message -->
                        <!-- PHP: Add your success/error message display here -->
                        <?php
                        require_once 'includes/config.php';
                        $password_change_success = false;
                        $error_message = '';

                        //@ Personal Info Change Functionality
                            $id = $_SESSION['eid'];
                            $stmt = $conn->prepare("SELECT email FROM employee WHERE id = :id");
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $storedEmailFromDB = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                            if (!isset($_SESSION['email'])) {
                                $_SESSION['email'] = $storedEmailFromDB['email'];
                            }
                            $currMail = $_SESSION['email'] ?? '';

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
                                $newEmail = trim($_POST['email'] ?? '');
                                $newFirstName = trim($_POST['first_name'] ?? '');
                                $newLastName = trim($_POST['last_name'] ?? '');
                                
                                $stmt1 = $conn->prepare("UPDATE employee SET email = :email, first_name = :first_name, last_name = :last_name WHERE id = :id");
                                $stmt1->bindParam(':email', $newEmail, PDO::PARAM_STR);
                                $stmt1->bindParam(':first_name', $newFirstName, PDO::PARAM_STR);
                                $stmt1->bindParam(':last_name', $newLastName, PDO::PARAM_STR);
                                $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
                                $stmt1->execute();
                                
                                $messages = [];
                                
                                if (!empty($newEmail) && $newEmail !== $_SESSION['email']) {
                                    $storedEmailFromDB = $newEmail;
                                    $_SESSION['email'] = $newEmail;
                                    $messages[] = "Email updated successfully to: $newEmail";
                                }
                                
                                if (!empty($newFirstName) && $newFirstName !== $_SESSION['firstName']) {
                                    $_SESSION['firstName'] = $newFirstName;
                                    $messages[] = "First name updated to: $newFirstName";
                                }
                                
                                if (!empty($newLastName) && $newLastName !== $_SESSION['lastName']) {
                                    $_SESSION['lastName'] = $newLastName;
                                    $messages[] = "Last name updated to: $newLastName";
                                }
                                if (!empty($messages)) {
                                    $message = implode('<br>', $messages);  // Concatenate for display
                                } else {
                                    $message = "No changes were made.";
                                }
                                $currMail = $_SESSION['email'];
                                $first_name = $_SESSION['firstName'];
                                $last_name = $_SESSION['lastName'];
                            }
                        ?>

                        <?php if (!empty($message))
                            // echo "<div class='msg'>$message</div>";
                            echo "<script>alert(" . json_encode($message) . ");</script>";
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                            class="profile-form">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label for="first_name" class="first_name">
                                        <i class="fas fa-user"></i> First Name
                                    </label>
                                    <input type="text" id="first_name" name="first_name" class="form-input"
                                        placeholder="Enter first name" value="<?= $_SESSION['firstName'] ?>" required />
                                </div>

                                <div class="form-group">
                                    <label for="last_name" class="last_name">
                                        <i class="fas fa-user"></i> Last Name
                                    </label>
                                    <input type="text" id="last_name" name="last_name" class="form-input"
                                        placeholder="Enter last name" value="<?= $_SESSION['lastName'] ?>" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="email">
                                    <i class="fas fa-envelope"></i> Email Address
                                </label>
                                <input class="form-input" type="email" id="email" name="email" value="<?=htmlspecialchars($currMail)?>"/>
                                <small>You can change your email and submit again.</small>
                            </div>

                            <div style="display: flex; gap: var(--space-4); margin-top: var(--space-6);">
                                <button type="submit" name="update_profile" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Update Profile
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i>
                                    Reset Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div> 
  
 */

?>