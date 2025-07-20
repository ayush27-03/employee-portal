<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile - Employee Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/design-system.css">
    <link rel="stylesheet" href="css/components.css">

    <!-- International telephone Numbers -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="js\csd.js"></script>

</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main Content -->
    <main style="padding: var(--space-8) 0; min-height: calc(100vh - 80px);">
        <div class="container">
            <!-- Page Header -->
            <div style="margin-bottom: var(--space-8);">
                <div
                    style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-4);">
                    <div>
                        <h1 style="margin-bottom: var(--space-2);">My Profile</h1>
                        <p style="color: var(--gray-600);">
                            Manage your personal information and account settings.
                        </p>
                    </div>
                    <a href="dashboard.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="grid grid-cols-3 gap-8">
                <!-- Profile Information Card -->
                <div class="card" style="grid-column: span 2;">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-user-edit"></i>
                            Personal Information
                        </h3>
                    </div>
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
                                <input class="form-input" type="email" id="email" name="email"
                                    value="<?= htmlspecialchars($currMail) ?>" />
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

                <!-- Profile Summary Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-id-card"></i>
                            Profile Summary
                        </h3>
                    </div>
                    <div class="card-body">

                        <div style="text-align: center; margin-bottom: var(--space-6);">
                            <div
                                style="width: 80px; height: 80px; background: var(--primary-100); color: var(--primary-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: var(--text-2xl); margin: 0 auto var(--space-4);">
                                <!-- PHP: Display user initials here -->
                                <?php echo strtoupper(substr(ucfirst($_SESSION['firstName']) ?? 'U', 0, 1) . substr(ucfirst($_SESSION['lastName']) ?? 'N', 0, 1)); ?>
                            </div>
                            <h4 style="margin-bottom: var(--space-1);">
                                <?= htmlspecialchars($_SESSION['firstName'] ?? '') . ' ' . (ucfirst($_SESSION['lastName']) ?? '') ?>
                            </h4>
                            <p style="color: var(--gray-500); margin: 0; font-size: var(--text-sm);">
                                @<?= htmlspecialchars($_SESSION['username']) ?>
                            </p>
                        </div>

                        <div style="space-y: var(--space-3);">
                            <div
                                style="display: flex; justify-content: space-between; padding: var(--space-2) 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Employee</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm); font-family: var(--font-family-mono);">
                                    <!-- PHP: Display formatted employee ID here -->
                                    #<?php echo str_pad($_SESSION['eid'] ?? '0', 4, '0', STR_PAD_LEFT); ?>
                                </span>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: var(--space-2) 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Role</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm); font-family: var(--font-family-mono);">
                                    <!-- PHP: Display formatted employee ID here -->
                                    <?php echo ucfirst($_SESSION['rname']) ?>
                                </span>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: var(--space-2) 0; border-bottom: 1px solid var(--gray-200);">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Department</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm); font-family: var(--font-family-mono);">
                                    <!-- PHP: Display formatted employee ID here -->
                                    <?php echo ucfirst($_SESSION['dname']) ?>
                                </span>
                            </div>

                            <div style="display: flex; justify-content: space-between; padding: var(--space-2) 0;">
                                <span style="color: var(--gray-600); font-size: var(--text-sm);">Member Since</span>
                                <span
                                    style="font-weight: 500; font-size: var(--text-sm); font-family: var(--font-family-mono);">
                                    <!-- PHP: Display registration date here -->
                                    <?= htmlspecialchars(date("d M Y", strtotime($_SESSION['dbDate']))) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Details Change Section -->
            <div style="margin-top: var(--space-8);">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-address-book"></i>
                            Other Details
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // //@ Other Details Changing Functionality
                        $id = $_SESSION['eid'];
                        $stmt = $conn->prepare("SELECT phone, city, zip, state, country, pan, aadhaar, marital_status, gender FROM employee WHERE id = :id");
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($currentData) {
                            // Set session vars for comparison (if not set already)
                            foreach ($currentData as $key => $value) {
                                if (!isset($_SESSION[$key])) {
                                    $_SESSION[$key] = $value;
                                }
                            }
                        }

                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['details-change-form'])) {
                            // Collect and trim inputs
                            // $newPhone = trim($_POST['phone'] ?? '');
                            $newPhone = !empty($_POST['full_phone']) ? trim($_POST['full_phone']) : trim($_POST['phone'] ?? '');
                            $newCity = trim($_POST['city'] ?? '');
                            $newZip = trim($_POST['zip'] ?? '');
                            $newState = trim($_POST['state'] ?? '');
                            $newCountry = trim($_POST['country'] ?? '');
                            $newPan = trim($_POST['pan'] ?? '');
                            $newAadhar = trim($_POST['aadhaar'] ?? '');
                            $newMaritalStatus = trim($_POST['marital_status'] ?? '');
                            $newGender = trim($_POST['gender'] ?? '');

                            // Update DB
                            $stmtUpdate = $conn->prepare("UPDATE employee SET phone = :phone, city = :city, zip = :zip, state = :state, country = :country, pan = :pan, aadhaar = :aadhaar, marital_status = :marital_status, gender = :gender WHERE id = :id");

                            $stmtUpdate->execute([
                                ':phone' => $newPhone,
                                ':city' => $newCity,
                                ':zip' => $newZip,
                                ':state' => $newState,
                                ':country' => $newCountry,
                                ':pan' => $newPan,
                                ':aadhaar' => $newAadhar,
                                ':marital_status' => $newMaritalStatus,
                                ':gender' => $newGender,
                                ':id' => $id
                            ]);

                            // Track changed fields
                            $messages2 = [];

                            if ($newPhone !== $_SESSION['phone']) {
                                $_SESSION['phone'] = $newPhone;
                                $messages2[] = "Phone updated to: $newPhone";
                            }

                            if ($newCity !== $_SESSION['city']) {
                                $_SESSION['city'] = $newCity;
                                $messages2[] = "City updated to: $newCity";
                            }

                            if ($newZip !== $_SESSION['zip']) {
                                $_SESSION['zip'] = $newZip;
                                $messages2[] = "ZIP updated to: $newZip";
                            }

                            if ($newState !== $_SESSION['state']) {
                                $_SESSION['state'] = $newState;
                                $messages2[] = "State updated to: $newState";
                            }

                            if ($newCountry !== $_SESSION['country']) {
                                $_SESSION['country'] = $newCountry;
                                $messages2[] = "Country updated to: $newCountry";
                            }

                            if ($newPan !== $_SESSION['pan']) {
                                $_SESSION['pan'] = $newPan;
                                $messages2[] = "PAN updated to: $newPan";
                            }

                            if ($newAadhar !== $_SESSION['aadhaar']) {
                                $_SESSION['aadhaar'] = $newAadhar;
                                $messages2[] = "Aadhaar updated to: $newAadhar";
                            }

                            if ($newMaritalStatus !== $_SESSION['marital_status']) {
                                $_SESSION['marital_status'] = $newMaritalStatus;
                                $messages2[] = "Marital status updated to: $newMaritalStatus";
                            }

                            if ($newGender !== $_SESSION['gender']) {
                                $_SESSION['gender'] = $newGender;
                                $messages2[] = "Gender updated to: $newGender";
                            }

                            if (!empty($messages2)) {
                                $message2 = implode('<br>', $messages2);
                            } else {
                                $message2 = "No changes were made.";
                            }
                        }

                        ?>

                        <?php if (!empty($message2))
                            // echo "<div class='msg'>$message</div>";
                            echo "<script>alert(" . json_encode($message2) . ");</script>";
                        ?>
                        <div style="max-width: 800px;">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            <i class="fas fa-phone"></i> Phone Number
                                        </label>
                                        <input type="tel" id="phone" name="phone" class="form-input"
                                            placeholder="Enter phone number" value="<?= $_SESSION['phone'] ?>" />
                                        <input type="hidden" id="full_phone" name="full_phone" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="form-label">
                                            <i class="fas fa-city"></i> City
                                        </label>
                                        <input type="text" id="city" name="city" class="form-input"
                                            placeholder="Enter City" value="<?= $_SESSION['city'] ?>" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="zip" class="form-label">
                                            <i class="fas fa-map-marker-alt"></i> ZIP
                                        </label>
                                        <input type="zip" class="form-input" placeholder="Enter Area ZIP Code"
                                            value="<?= $_SESSION['zip'] ?>" name="zip" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">
                                            <i class="fas fa-map"></i> State/UT
                                        </label>
                                        <select id="state" name="state" class="form-input" required>
                                            <option value="">Select State/UT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="form-label">
                                            <i class="fas fa-earth-americas"></i> Country
                                        </label>
                                        <input type="text" id="country" name="country" class="form-input"
                                            placeholder="Enter Nationality" value="<?= $_SESSION['country'] ?>"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label for="pan" class="form-label">
                                            <i class="fas fa-circle-user"></i> PAN/SSN
                                        </label>
                                        <input type="alphanumeric" id="pan" name="pan" class="form-input"
                                            placeholder="Enter PAN/SSN" value="<?= $_SESSION['pan'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="aadhar" class="form-label">
                                            <i class="fas fa-id-badge"></i> Aadhaar Number
                                        </label>
                                        <input type="text" id="aadhar" name="aadhar" class="form-input"
                                            value="<?= $_SESSION['aadhaar'] ?>" placeholder="Enter 12-digit Aadhaar"
                                            maxlength="12" />
                                    </div>
                                    <div class="form-group">
                                        <label for="marital_status" class="form-label">
                                            <i class="fas fa-ring"></i> Marital Status
                                        </label>
                                        <select id="marital_status" name="marital_status" class="form-input">
                                            <option value="">Select</option>
                                            <option value="single" <?= (isset($_SESSION['marital_status']) && $_SESSION['marital_status'] === 'single') ? 'selected' : '' ?>>Single
                                            </option>
                                            <option value="married" <?= (isset($_SESSION['marital_status']) && $_SESSION['marital_status'] === 'married') ? 'selected' : '' ?>>Married
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="form-label">
                                            <i class="fas fa-venus-mars"></i> Gender
                                        </label>
                                        <select id="gender" name="gender" class="form-input">
                                            <option value="">Select Gender</option>
                                            <option value="male" <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'male') ? 'selected' : '' ?>>Male</option>
                                            <option value="female" <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'female') ? 'selected' : '' ?>>Female</option>
                                            <option value="other" <?= (isset($_SESSION['gender']) && $_SESSION['gender'] === 'other') ? 'selected' : '' ?>>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="display: flex; gap: var(--space-4); margin-top: var(--space-6);">
                                    <button type="submit" name="details-change-form" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Update Info
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i>
                                        Reset Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Work Experience Section -->
            <div style="margin-top: var(--space-8);">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-address-book"></i>
                            Work Experience
                        </h3>
                    </div>

                    <!-- Detailed Work-Ex Data Section -->
                    <!-- <div id="workexList" class="mt-4"></div> -->

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Duration</th>
                                    <th>Remarks</th>
                                    <th>Uploads</th>
                                </tr>
                            </thead>
                            <tbody id="dynamicWorkexBody">

                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div style="max-width: 800px;">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                                id="workexForm">
                                <input type="hidden" id="empId" value="<?php echo $_SESSION['eid']; ?>">
                                <div id="inputContainer">
                                    <div class="grid grid-cols-3 gap-1 experience-row">
                                        <div class="form-group">
                                            <label for="company" class="form-label">
                                                <i class="fas fa-briefcase"></i> Company
                                            </label>
                                            <input type="text" id="company" name="company[]"
                                                class="form-input company-input" placeholder="Enter Experience" value=""
                                                required />
                                        </div>

                                        <div class="form-group">
                                            <label for="duration" class="form-label">
                                                <i class="fas fa-clock"></i> Duration
                                            </label>
                                            <input type="text" id="duration" name="duration[]"
                                                class="form-input duration-input" placeholder="Enter duration" value=""
                                                required />
                                        </div>

                                        <div class="form-group">
                                            <label for="remarks" class="form-label">
                                                <i class="fas fa-pen"></i> Remarks
                                            </label>
                                            <input type="text" id="remarks" name="remarks[]"
                                                class="form-input remarks-input" placeholder="Enter remarks" value=""
                                                required />
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-bottom: 15px;">
                                    <button type="button" onclick="addExperienceRow()" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" onclick="removeExperienceRow()" class="btn btn-danger">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                                <div style="display: flex; gap: var(--space-4); margin-top: var(--space-6);">
                                    <button type="submit" name="workex" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Update Info
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i>
                                        Reset Changes
                                    </button>
                                </div>
                            </form>
                            <!-- <div id="workexList" class="mt-4"></div> -->
                        </div>
                    </div>

                </div>
            </div>

            <style>
                .max-w-2xl {
                    max-width: 80rem;
                }

                .max-w-4xl {
                    max-width: 80rem;
                }
            </style>

            <!-- SKills Section -->
            <div class="mt-8 bg-white shadow-md rounded-lg overflow-hidden max-w-2xl mx-auto">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-cogs text-blue-600"></i>
                        <span>Skills & Expertise</span>
                    </h2>
                    <p class="text-gray-600 text-sm mt-1">Manage your professional skills</p>
                </div>

                <div class="p-6">
                    <!-- Skills Display -->
                    <div id="skillsContainer" class="flex flex-wrap gap-2 mb-4"></div>

                    <!-- Input Field + Add Button -->
                    <div class="flex space-x-2">
                        <input type="text" id="skillInput" placeholder="Add a new skill..."
                            class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <button id="addSkillBtn"
                            class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Academic Section -->
            <?php
            $degree = $conn->query('SELECT id, name FROM degree')->fetchAll(PDO::FETCH_ASSOC);
            $institution = $conn->query('SELECT id, name FROM institution')->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="mt-8 bg-white shadow-md rounded-lg overflow-hidden max-w-4xl mx-auto">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-graduation-cap text-blue-600"></i>
                        <span>Academic Details</span>
                    </h2>
                    <p class="text-gray-600 text-sm mt-1">Manage your educational qualifications</p>
                </div>

                <div class="p-6">
                    <form method="post" class="space-y-6">
                        <div id="qualificationsContainer" class="space-y-4">

                        </div>

                        <!-- Add New Qualification -->

                        <h3 class="text-lg font-medium text-gray-800 mb-4">Add New Qualification</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Degree Selection -->
                            <div>
                                <label for="degree" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-certificate text-blue-500 mr-1"></i>
                                    Degree
                                </label>
                                <select id="degree" name="degree"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Select Degree</option>
                                    <?php foreach ($degree as $x): ?>
                                        <option value="<?= htmlspecialchars($x['id']) ?>">
                                            <?= htmlspecialchars($x['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Institution Selection -->
                            <div>
                                <label for="institution" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-university text-blue-500 mr-1"></i>
                                    Institution
                                </label>
                                <select id="institution" name="institution"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Select Institution</option>
                                    <?php foreach ($institution as $x): ?>
                                        <option value="<?= htmlspecialchars($x['id']) ?>">
                                            <?= htmlspecialchars($x['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Certification Upload -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">
                                <i class="fas fa-file-upload text-blue-500 mr-1"></i>
                                Upload certifications (Optional)
                            </label>
                            <div class="mt-1">
                                <button type="button" onclick="openModal('uploadModal')"
                                    class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm text-left focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-50 transition">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Certification
                                </button>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">PDF, JPG or PNG (Max. 5MB)</p>
                        </div>

                        <!-- Upload Modal -->
                        <div id="uploadModal" class="fixed z-50 inset-0 overflow-y-auto hidden"
                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                    aria-hidden="true"></div>

                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                    aria-hidden="true">&#8203;</span>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Upload Document
                                            </h3>
                                            <button type="button" onclick="closeModal('uploadModal')"
                                                class="text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Close</span>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        <div class="mt-4">
                                            <form id="uploadForm" enctype="multipart/form-data" class="space-y-4">
                                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition"
                                                    id="uploadZone"
                                                    onclick="document.getElementById('fileInput').click()">
                                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                                    <h4 class="text-sm font-medium text-gray-700 mb-1">Drop files here
                                                        or click to browse</h4>
                                                    <p class="text-xs text-gray-500">
                                                        Supports PDF, DOC, DOCX, JPG, PNG (Max 5MB each)
                                                    </p>
                                                    <input type="file" id="fileInput" name="certification"
                                                        class="hidden" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                                </div>

                                                <div id="fileList" class="hidden">
                                                    <h5 class="text-sm font-medium text-gray-700 mb-2">Selected File:
                                                    </h5>
                                                    <div id="selectedFiles" class="text-sm text-gray-600"></div>
                                                </div>

                                                <div class="grid grid-cols-1 gap-4">
                                                    <div class="form-group">
                                                        <label
                                                            class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                                        <select class="form-input w-full" name="category">
                                                            <option value="">Select Category</option>
                                                            <option value="certification">Certification</option>
                                                            <option value="degree">Degree</option>
                                                            <option value="training">Training</option>
                                                        </select>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="set_expiry" name="set_expiry"
                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                            onchange="document.getElementById('expiryDateGroup').style.display = this.checked ? 'block' : 'none'">
                                                        <label for="set_expiry"
                                                            class="ml-2 block text-sm text-gray-700">
                                                            Set expiry date
                                                        </label>
                                                    </div>

                                                    <div class="form-group hidden" id="expiryDateGroup">
                                                        <label
                                                            class="block text-sm font-medium text-gray-700 mb-1">Expiry
                                                            Date</label>
                                                        <input type="date" class="form-input w-full" name="expiry_date">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="button" onclick="uploadDocuments()"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            <i class="fas fa-upload mr-2"></i>
                                            Upload Document
                                        </button>
                                        <button type="button" onclick="closeModal('uploadModal')"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="reset"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-undo mr-2"></i>
                                Reset
                            </button>
                            <button type="submit" name="save_qualification"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i>
                                Save Qualification
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div></div>
            <!-- Password Change Section -->
            <div style="margin-top: var(--space-8);" id="change-password">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; display: flex; align-items: center; gap: var(--space-2);">
                            <i class="fas fa-lock"></i>
                            Change Password
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="max-width: 800px;">
                            <?php
                            require_once 'includes/config.php';
                            //@ Update Password Functionality
                            $error_message = '';
                            $password_change_success = false;

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
                                $current_password = $_POST['current_password'] ?? '';
                                $new_password = $_POST['new_password'] ?? '';
                                $confirm_password = $_POST['confirm_password'] ?? '';

                                $stmt = $conn->prepare("SELECT password FROM employee WHERE id = :id");
                                $stmt->bindParam(':id', $_SESSION['eid']);
                                $stmt->execute();
                                $db_current_password = $stmt->fetchColumn();

                                if (!password_verify($current_password, $db_current_password)) {
                                    $error_message = "Current password is incorrect. Contact your administrator.";
                                } elseif (strlen($new_password) < 6) {
                                    $error_message = "New password must be at least 6 characters long.";
                                } elseif ($new_password === $current_password) {
                                    $error_message = "New password cannot be the same as the current password.";
                                } elseif ($new_password !== $confirm_password) {
                                    $error_message = "New password and confirm password do not match.";
                                } else {
                                    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                                    $update = $conn->prepare("UPDATE employee SET password = :new_password WHERE id = :id");
                                    $update->bindParam(':new_password', $hashed_new_password);
                                    $update->bindParam(':id', $_SESSION['eid']);
                                    if ($update->execute()) {
                                        $password_change_success = true;
                                    } else {
                                        $error_message = 'Failed to change password. Please try again later.';
                                    }
                                }
                                ?>
                                <script>window.location.hash = "#change-password";</script>
                                <?php
                            }
                            ?>
                            <!-- PHP: Add your password change success/error message here -->
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <?= htmlspecialchars($error_message); ?>
                                </div>
                            <?php elseif ($password_change_success): ?>
                                <p class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Password changed successfully.
                                </p>
                            <?php endif; ?>

                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                                class="password-form">
                                <div class="form-group">
                                    <label for="current_password" class="form-label">
                                        <i class="fas fa-key"></i> Current Password
                                    </label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-input" placeholder="Enter your current password" required />
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="new_password" class="form-label">
                                            <i class="fas fa-lock"></i> New Password
                                        </label>
                                        <input type="password" id="new_password" name="new_password" class="form-input"
                                            placeholder="Enter new password" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password" class="form-label">
                                            <i class="fas fa-lock"></i> Confirm New Password
                                        </label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="form-input" placeholder="Confirm new password" required />
                                    </div>
                                </div>

                                <div style="margin-top: var(--space-6);">
                                    <button type="submit" name="change_password" class="btn btn-primary">
                                        <i class="fas fa-shield-alt"></i>
                                        Change Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php if (!empty($popupMessage))
        echo $popupMessage; ?>
    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const skillInput = document.getElementById("skillInput");
        const addSkillBtn = document.getElementById("addSkillBtn");
        const skillsContainer = document.getElementById("skillsContainer");

        let skills = ["JavaScript", "React", "PHP"];

        function renderSkills() {
            skillsContainer.innerHTML = "";
            skills.forEach((skill, index) => {
                const badge = document.createElement("div");
                badge.className = "bg-blue-100 text-blue-800 text-sm font-medium rounded-full px-3 py-1 flex items-center space-x-2 hover:bg-blue-200 transition";
                badge.innerHTML = `
        <span>${skill}</span>
        <button class="hover:text-blue-600" onclick="removeSkill(${index})">
          <i class="fas fa-times text-xs"></i>
        </button>
      `;
                skillsContainer.appendChild(badge);
            });
        }

        function removeSkill(index) {
            skills.splice(index, 1);
            renderSkills();
        }

        function addSkill() {
            const newSkill = skillInput.value.trim();
            if (newSkill && !skills.includes(newSkill)) {
                skills.push(newSkill);
                skillInput.value = "";
                renderSkills();
            }
        }

        // Event Listeners
        addSkillBtn.addEventListener("click", addSkill);
        skillInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") addSkill();
        });

        // Initial Render
        renderSkills();
    </script>

    <script>
        // AJAX here

        // AJAX FOR SKILLS
        $(document).ready(function () {
            loadSkills(); // Load on page load

            // Add skill on button click
            $('#addSkillBtn').click(function () {
                const skill = $('#skillInput').val().trim();
                if (!skill) {
                    alert("Please enter a skill.");
                    return;
                }

                $.ajax({
                    url: 'process_skill.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'add_skill',
                        skill: skill
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#skillInput').val('');
                            renderSkills(response.skills);
                        } else {
                            alert(response.message || "Skill could not be added.");
                        }
                    },
                    error: function () {
                        alert("An error occurred while adding the skill.");
                    }
                });
            });

            // Remove skill using event delegation (for dynamic buttons)
            $('#skillsContainer').on('click', '.remove-skill-btn', function () {
                const skill = $(this).data('skill');

                $.ajax({
                    url: 'process_skill.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'remove_skill',
                        skill: skill
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            renderSkills(response.skills);
                        } else {
                            alert(response.message || "Skill could not be removed.");
                        }
                    },
                    error: function () {
                        alert("An error occurred while removing the skill.");
                    }
                });
            });

            function loadSkills() {
                $.ajax({
                    url: 'process_skill.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { action: 'get_skills' },
                    success: function (response) {
                        if (response.status === 'success') {
                            renderSkills(response.skills);
                        } else {
                            $('#skillsContainer').html('<span class="text-sm text-gray-500">No skills available.</span>');
                        }
                    },
                    error: function () {
                        $('#skillsContainer').html('<span class="text-sm text-red-500">Failed to load skills.</span>');
                    }
                });
            }

            function renderSkills(skills) {
                const container = $('#skillsContainer');
                container.empty();

                if (!skills || skills.length === 0) {
                    container.html('<span class="text-sm text-gray-500">No skills added yet.</span>');
                    return;
                }

                skills.forEach(skill => {
                    container.append(`
                    <div class="bg-blue-100 text-blue-800 text-sm font-medium rounded-full px-3 py-1 flex items-center space-x-2 hover:bg-blue-200 transition">
                        <span>${skill}</span>
                        <button class="remove-skill-btn hover:text-blue-600" data-skill="${skill}">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                `);
                });
            }
        });

    </script>

    <script>
        const submitQualification = document.getElementsByClassName('save_qualification');
        $(document).ready(function () {
            function loadAcademicQualifications() {
                $.ajax({
                    url: 'process_academic.php',
                    type: 'POST',
                    data: {
                        action: 'get_qualifications',
                        empId: '<?php echo $_SESSION["eid"] ?? ""; ?>'
                    },
                    dataType: 'json',
                    success: function (response) {
                        const container = $('.qualificationsContainer');
                        container.empty(); // Clear existing content
                        if (response.status == 'success' && response.data.length > 0) {
                            response.data.forEach(qualification => {
                                const qualHtml = `
                                            <div class="border border-gray-200 rounded-lg p-4 mb-4">
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700">Degree</label>
                                                    </div>
                                                        <p class="mt-1 text-sm text-gray-900">${qualification.degree || 'N/A'}</p>
                                                        <div>
                                                        <label class="block text-sm font-medium text-gray-700">Institution</label>
                                                        <p class="mt-1 text-sm text-gray-900">${qualification.institution || 'N/A'}</p>
                                                        </div>
                                            <div class="flex items-end space-x-2">
                                                <button type="button" class="text-red-600 hover:text-red-800 text-sm remove-qualification" data-id="${qualification.id}">
                                                    <i class="fas fa-trash-alt mr-1"></i> Remove
                                                </button>
                                            </div>
                                                </div>
                                                </div>
                                                `;
                                container.append(qualHtml);
                            });
                        } else {
                            container.html(`
                                            <div class="text-center py-4 text-gray-500">
                                                You have no academic qualifications yet!
                                            </div>
                                        `);
                        }
                    },
                    error: function () {
                        alert('Error loading academic details')
                    }
                });
            }

            loadAcademicQualifications();

            $(document).on('click', '.remove-qualification', function () {
                if (confirm('Are you sure you want to remove this qualification?')) {
                    const qualificationCard = $(this).closest('.border');
                    $.ajax({
                        url: 'process_academic.php',
                        type: 'POST',
                        data: {
                            action: 'delete_qualification',
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                qualificationCard.remove();
                                // Reload if this was the last qualification
                                if ($('.qualifications-container').children().length === 0) {
                                    loadAcademicQualifications();
                                }
                            } else {
                                alert('Failed to remove qualification: ' + response.message);
                            }
                        },
                        error: function () {
                            alert('Error removing qualification');
                        }
                    });
                }
            });

            // Handle save qualification button
            $('.save_qualification').on('click', function () {
                const formData = {
                    action: 'save_qualification',
                    empId: '<?php echo $_SESSION["eid"] ?? ""; ?>',
                    degree: $('#degree').val(),
                    institution: $('#institution').val(),
                };
                $.ajax({
                    url: 'process_academic.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Qualification saved successfully!');
                            loadAcademicQualifications();
                        } else {
                            alert('Error: ' + (response.message || 'Failed to save qualification'));
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Error saving qualification: ' + error);
                    }
                });
            });
        });
    </script>

    <script>
        function openModal() {
            document.getElementById('uploadModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('uploadModal').style.display = 'none';
        }

        function uploadFile() {
            const formData = new FormData();
            const fileInput = document.getElementById('fileInput');
            const category = document.querySelector('select[name="category"]').value;
            const description = document.querySelector('textarea[name="description"]').value;

            if (fileInput.files.length === 0) {
                alert('Please select a file');
                return;
            }

            formData.append('file', fileInput.files[0]);
            formData.append('category', category);
            formData.append('description', description);
            console.log(formData); return false;
            $.ajax({
                url: 'upload_handler.php', // Replace with your upload handler
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('Upload successful: ' + response);
                    closeModal();
                },
                error: function (xhr, status, error) {
                    alert('Upload failed: ' + error);
                }
            });
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target == document.getElementById('uploadModal')) {
                closeModal();
            }
        }
    </script>

    <script>
        // Function to show popup alerts
        setTimeout(() => {
            const popup = document.querySelector('.popup-alert');
            if (popup) {
                popup.style.transition = "opacity 0.5s ease";
                popup.style.opacity = 0;
                setTimeout(() => popup.remove(), 500);
            }
        }, 3000); // 3 seconds

        // Auto-hide alerts after 10 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 10000);


        function contactSupport() {
            alert('Contact support functionality would be implemented here');
        }

        // Function to add work experience rows
        function addExperienceRow() {
            const container = document.getElementById("inputContainer");
            const firstRow = document.querySelector(".experience-row");
            const newRow = firstRow.cloneNode(true);

            // Remove all label elements inside cloned row
            const labels = newRow.querySelectorAll("label");
            labels.forEach(label => label.remove());

            // Clear input values
            const inputs = newRow.querySelectorAll("input");
            inputs.forEach(input => {
                input.value = "";
            });

            container.appendChild(newRow);
        }

        function removeExperienceRow() {
            const container = document.getElementById("inputContainer");
            const rows = container.querySelectorAll(".experience-row");
            if (rows.length > 1) {
                container.removeChild(rows[rows.length - 1]);
            } else {
                alert("At least add your latest work experience.");
            }
        }

        // AJAX for Work Experience
        $(document).ready(function () {
            $('#workexForm').on('submit', function (e) {
                e.preventDefault();

                const formData = {
                    action: 'add',
                    company: [],
                    duration: [],
                    remarks: []
                };

                $('.experience-row').each(function () {
                    const $row = $(this);
                    formData.company.push($row.find('.company-input').val());
                    formData.duration.push($row.find('.duration-input').val());
                    formData.remarks.push($row.find('.remarks-input').val());
                });

                // Send AJAX request
                $.ajax({
                    url: 'process_workex.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            fetchWorkExperience();
                            alert(response.message);
                            $('#workexForm')[0].reset();
                            $('.experience-row:not(:first)').remove();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Request failed: ' + error);
                    }
                });
            });

            $('#workexForm').on('reset', function (e) {
                e.preventDefault();

                // Send AJAX request
                $.ajax({
                    url: 'process_workex.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            fetchWorkExperience();
                            alert(response.message);
                            $('#workexForm')[0].reset();
                            $('.experience-row:not(:first)').remove();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Request failed: ' + error);
                    }
                });
            });

        });

        // Function to update the work experience list in the UI
        function updateWorkExperienceList(data) {
            const $container = $('#dynamicWorkexBody'); // Target the existing tbody
            $container.empty(); // Clear existing content

            if (data.length === 0) {
                $container.html('<tr><td colspan="4" class="text-center">No work experience added yet.</td></tr>');
                return;
            }

            // Add each work experience item to the table
            data.forEach(item => {
                $container.append(`
            <tr>
                <td style="font-weight: 500;">${item.company || ''}</td>
                <td>
                    <span style="background: var(--primary-100); color: var(--primary-700); 
                          padding: 2px 8px; border-radius: 12px; font-size: var(--text-xs);">
                        ${item.duration || ''}
                    </span>
                </td>
                <td>${item.remarks || ''}</td>
                <td>
                    <div class="table-actions">
                        <button class="action-btn delete-workex" title="Delete" 
                            style="background: var(--danger-100); color: var(--danger-600);"
                            data-id="${item.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="action-btn" title="Upload Certificate"
                            style="background: var(--primary-100); color: var(--primary-600);">
                            <i class="fas fa-upload"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `);
            });

            // Modify your delete button click handler to this:
            $(document).on('click', '.delete-workex', function () {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this entry?')) {
                    deleteWorkExperience(id);
                }
            });
        }

        // Function to delete work experience
        function deleteWorkExperience(id) {
            const $btn = $(`.delete-workex[data-id="${id}"]`);
            const $row = $btn.closest('tr');
            const originalHTML = $btn.html();

            // Show loading state on the button
            $btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

            // Fade out the row
            $row.css('opacity', '0.5');

            $.ajax({
                url: 'process_workex.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        // Complete the fade out animation
                        $row.animate({ opacity: 0 }, 300, function () {
                            $row.remove();

                            // Check if table is empty and refresh if needed
                            if ($('#dynamicWorkexBody tr').length === 0) {
                                fetchWorkExperience(); // This will show the empty state message
                            }
                        });
                    } else {
                        // Restore the row if deletion failed
                        $row.css('opacity', '1');
                        alert('Error: ' + (response.message || 'Failed to delete work experience'));
                    }
                    $btn.html(originalHTML).prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    // Restore the row on error
                    $row.css('opacity', '1');
                    $btn.html(originalHTML).prop('disabled', false);
                    alert('Request failed: ' + error);
                }
            });
        }


        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Reset form confirmation
        document.querySelector('button[type="reset"]')?.addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to reset all changes?')) {
                e.preventDefault();
            }
        });
    </script>

    <script>
        //For phone
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize intl-tel-input
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                separateDialCode: true,
                preferredCountries: ['in', 'us', 'gb'], // Customize as needed
                initialCountry: "auto",
                geoIpLookup: function (callback) {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("us"));
                }
            });

            // Update hidden field with full international number before form submission
            document.querySelector('form').addEventListener('submit', function (e) {
                const fullNumber = phoneInput.getNumber();
                document.querySelector('#full_phone').value = fullNumber;

                // Also update the visible phone input with just the national number
                phoneInputField.value = phoneInput.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
            });

            // Set initial value if session phone exists
            <?php if (!empty($_SESSION['phone'])): ?>
                phoneInput.setNumber("<?= $_SESSION['phone'] ?> ");
            <?php endif; ?>
        });
    </script>
</body>

</html>
<!-- 
//@ To-Do

//@ Starting session functionality to be only added into the navbar
//@ Each and every detail updation has to be done and to be done via session 
//@ Password updation is a different functionality so update it separately


-->