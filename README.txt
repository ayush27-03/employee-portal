Employee Portal Project - Comprehensive README
==============================================

This document provides a comprehensive and technically detailed overview
of the Employee Portal project, version 1.0.8. It covers the purpose,
functionalities, UI components, and backend logic for each significant
file and feature within the application.

Project Overview
----------------

The Employee Portal is a web-based application designed for workforce
management, offering features for employee registration, login, profile
management, and administrative oversight. It aims to streamline HR
processes and provide a centralized platform for employee data.

Table of Contents
-----------------

1.  [Project Structure](#project-structure)
2.  [Core Functionalities](#core-functionalities)
    -   [Public-Facing Pages](#public-facing-pages)
        -   [index.php (Homepage)](#indexphp-homepage)
        -   [login.php (Employee Login)](#loginphp-employee-login)
        -   [register.php (Employee
            Registration)](#registerphp-employee-registration)
        -   [logout.php (Logout)](#logoutphp-logout)
        -   [profile.php (Employee
            Profile)](#profilephp-employee-profile)
        -   [dashboard.php (Employee
            Dashboard)](#dashboardphp-employee-dashboard)
        -   [time-tracking.php (Time
            Tracking)](#time-trackingphp-time-tracking)
        -   [leave-management.php (Leave
            Management)](#leave-managementphp-leave-management)
        -   [reports.php (Reports)](#reportsphp-reports)
        -   [analytics.php (Analytics)](#analyticsphp-analytics)
        -   [downloadprofile.php (Download
            Profile)](#downloadprofilephp-download-profile)
        -   [process\_skill.php (Process
            Skill)](#process_skillphp-process-skill)
    -   [Admin Backend Pages](#admin-backend-pages)
        -   [backend/dashboard.php (Admin
            Dashboard)](#backenddashboardphp-admin-dashboard)
        -   [backend/employee/listing.php (Employee
            Listing)](#backendemployeelistingphp-employee-listing)
        -   [backend/departments.php (Department
            Management)](#backenddepartmentsphp-department-management)
        -   [backend/roles.php (Role
            Management)](#backendrolesphp-role-management)
        -   [backend/edituser.php (Edit
            User)](#backendedituserphp-edit-user)
    -   [Includes and Common
        Components](#includes-and-common-components)
        -   [includes/config.php (Database
            Configuration)](#includesconfigphp-database-configuration)
        -   [includes/navbar.php (Navigation
            Bar)](#includesnavbarphp-navigation-bar)
        -   [includes/footer.php (Footer)](#includesfooterphp-footer)
    -   [CSS and JavaScript](#css-and-javascript)
        -   [css/design-system.css](#cssdesign-systemcss)
        -   [css/components.css](#csscomponentscss)
        -   [css/style.css](#cssstylecss)
        -   [css/adminpanel.css](#cssadminpanelcss)
        -   [css/reports.css](#cssreportscss)
        -   [js/reports.js](#jsreportsjs)
3.  [Database Schema (schema.db)](#database-schema-schemadb)
4.  [Setup and Installation](#setup-and-installation)

1. Project Structure
--------------------

    portal/
    ├── analytics.php
    ├── assets/             # Placeholder for static assets like images (currently empty)
    ├── backend/            # Admin-specific PHP files and functionalities
    │   ├── dashboard.php   # Admin Dashboard
    │   ├── departments.php # Department Management
    │   ├── employee/       # Employee management sub-directory
    │   │   ├── backuplist.php # Backup of employee listing (likely older version)
    │   │   └── listing.php # Main employee listing for admin
    │   ├── edituser.php    # Edit individual user details
    │   ├── login.php       # Admin login (redundant, main login.php is used)
    │   ├── logout.php      # Admin logout (redundant, main logout.php is used)
    │   ├── navbar.php      # Admin navigation bar
    │   ├── roles.php       # Role Management
    │   └── sidebar.php     # Admin sidebar navigation
    ├── backup.html         # Backup HTML file (likely for testing/reference)
    ├── css/                # Stylesheets
    │   ├── adminpanel.css
    │   ├── components.css
    │   ├── design-system.css
    │   ├── reports.css
    │   └── style.css
    ├── cv.pdf              # Example PDF file (likely for testing download)
    ├── dashboard.php       # Employee Dashboard
    ├── db/                 # Database related files
    │   └── schema.db       # SQLite database schema (or placeholder)
    ├── downloadprofile.php # Script to download user profile (e.g., PDF)
    ├── error.php           # Generic error page
    ├── includes/           # Reusable PHP components
    │   ├── config.php      # Database connection and configuration
    │   ├── footer.php      # Common footer HTML
    │   └── navbar.php      # Common navigation bar HTML
    ├── index.php           # Public homepage
    ├── js/                 # JavaScript files
    │   └── reports.js      # JavaScript for reports functionality
    ├── leave-management.php # Employee Leave Management
    ├── login.php           # User login page
    ├── logout.php          # User logout script
    ├── portal.json         # Example JSON file
    ├── portal.pdf          # Example PDF file
    ├── portal.sql          # SQL dump of the database schema
    ├── process_skill.php   # Script to process skill-related data (e.g., AJAX endpoint)
    ├── profile.php         # Employee profile page
    ├── register.php        # User registration page
    ├── reports.php         # Employee Reports page
    ├── schemaerror.php     # Database schema error page
    ├── success.php         # Generic success page
    ├── template/           # HTML templates/mockups (not integrated into PHP logic)
    │   ├── api-management.html
    │   ├── attendance-tracking.html
    │   ├── css/            # CSS for templates
    │   │   ├── adminpanel.css
    │   │   ├── components.css
    │   │   ├── design-system.css
    │   │   └── style.css
    │   ├── dashboard.html
    │   ├── document-management.html
    │   ├── employee-management.html
    │   ├── notifications.html
    │   ├── payroll-management.html
    │   ├── performance-management.html
    │   ├── profile.html
    │   ├── reports.html
    │   ├── system-administration.html
    │   └── tasks.html
    ├── test.php            # Testing/debug script
    └── time-tracking.php   # Employee Time Tracking

2. Core Functionalities
-----------------------

### Public-Facing Pages

#### index.php (Homepage)

-   **Purpose:** The main landing page for the Employee Portal,
    providing an overview of the system's features and calls to action
    for registration and login.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
        Dynamically displays

login/register buttons or user-specific links (Dashboard, Profile,
Logout) based on `$_SESSION['firstName']`. \* **Hero Section:** Displays
a main heading and a call-to-action. The "Register Employee" and
"Employee Login" buttons are conditionally rendered based on whether a
user is logged in (`!isset($_SESSION['firstName'])`). \* **Features
Section:** Static content highlighting key features of the portal. \*
**CTA Section:** Call-to-action for users to start a free trial or
contact sales. \* **Footer:** Included via `includes/footer.php`. \*
**Alert Auto-hide:** JavaScript `setTimeout` function hides alert
messages (e.g., from login/logout redirects) after 3 seconds by fading
them out. \* **Mobile Navigation Toggle:** JavaScript event listener on
`.navbar-mobile-toggle` to show/hide the navigation menu on smaller
screens. \* **Smooth Scrolling:** JavaScript for anchor links
(`a[href^="#"]`) to enable smooth scrolling to sections within the page.
\* **Backend Functions:** \* **Session Check:** Uses
`isset($_SESSION['firstName'])` to determine if a user is logged in and
conditionally display elements. \* **Includes:** Utilizes
`include 'includes/navbar.php';` and `include 'includes/footer.php';` to
embed common components.

#### login.php (Employee Login)

-   **Purpose:** Provides a form for users to log into the Employee
    Portal. It handles user authentication against the database and
    redirects users based on their assigned roles.
-   **UI Components & Dynamicity:**
    -   **Authentication Card:** A central card containing the login
        form.
    -   **Auth Header:** Displays a welcome message and an icon.
    -   **Error/Success Messages:** PHP conditional blocks
        (`<?php if ($error_message): ?>` and
        `<?php if ($success_message): ?>`) display dynamic alert
        messages (error or success) based on authentication outcomes.
        These alerts auto-hide after 3 seconds via JavaScript.
    -   **Login Form:** Contains input fields for `username`,
        `password`, and a dropdown for `role`.
        -   **Role Dropdown:** Dynamically populated from the `roles`
            table in the database
            (`SELECT id, name FROM roles WHERE status = 1`). The
            selected option is retained on form submission.
        -   **Input Values:** `username` field retains its value
            (`$_POST['username']`) on form submission if an error
            occurs.
    -   **Action Buttons:** "Sign In" button to submit the form, and a
        link to `register.php` for new accounts.
    -   **Back to Home Link:** Navigates back to `index.php`.
-   **Backend Functions:**
    -   **Session Management:** `session_start()` initializes the
        session. User details (`eid`, `firstName`, `lastName`,
        `username`, `role`, `dbDept`, `dbDate`, `rname`, `dname`) are
        stored in `$_SESSION` upon successful login.
    -   **Database Connection:** `require_once 'includes/config.php';`
        establishes the database connection.
    -   **Role and Department Fetching:** Fetches available roles and
        departments from the `roles` and `department` tables
        respectively, to populate the dropdowns.
    -   **Form Submission Handling
        (`$_SERVER['REQUEST_METHOD'] === 'POST'`):**
        -   **Input Retrieval:** Retrieves `username`, `password`, and
            `role_id` from `$_POST`.
        -   **Input Validation:** Checks if all fields are non-empty.
        -   **User Authentication:** Queries the `employee` table for
            the provided username. Uses `password_verify()` to securely
            compare the submitted password with the hashed password
            stored in the database.
        -   **Role Verification:** Compares the `selectedRole` from the
            form with the `role` stored in the database for the
            authenticated user. If they don't match, an unauthorized
            access error is displayed.
        -   **Role-based Redirection:** Redirects authenticated users to
            `backend/admin.php` if their role is `1` (Admin) or to
            `dashboard.php` for other roles (`2, 3, 4, 5`).
        -   **Error Handling:** Catches `PDOException` for database
            errors and sets appropriate error messages.
        -   **URL Parameter Handling:** Checks for `$_GET['message']`
            (e.g., from logout) to display messages.

#### register.php (Employee Registration)

-   **Purpose:** Allows new employees to register for an account by
    providing their personal details, department, and role. It handles
    user creation and password hashing.
-   **UI Components & Dynamicity:**
    -   **Authentication Card:** Contains the registration form.
    -   **Auth Header:** Displays a title and icon for employee
        registration.
    -   **Error/Success Messages:** PHP conditional blocks display
        dynamic alert messages. Success messages trigger a different
        layout with options to login or register another employee. Error
        messages auto-hide after 10 seconds via JavaScript.
    -   **Registration Form:** Includes input fields for `first_name`,
        `last_name`, `password`, and dropdowns for `department` and
        `role`.
        -   **Department & Role Dropdowns:** Dynamically populated from
            the `department` and `roles` tables respectively
            (`SELECT id, name FROM ... WHERE status = 1`). Selected
            options are retained on form submission.
        -   **Password Field:** Includes `minlength="6"` for client-side
            validation hint.
        -   **Input Values:** Fields retain their values (`$_POST[...]`)
            on form submission if an error occurs.
    -   **Action Buttons:** "Register Employee" button to submit the
        form, and links to `login.php` and `index.php`.
-   **Backend Functions:**
    -   **Session Management:** `session_start()` initializes the
        session.
    -   **Database Connection:** `require_once 'includes/config.php';`
        establishes the database connection.
    -   **Role and Department Fetching:** Fetches available roles and
        departments from the `roles` and `department` tables to populate
        the dropdowns.
    -   **`generateUniqueUsername($name, $conn1)` function:**
        -   **Purpose:** Generates a unique username by concatenating
            the first and last name (converted to lowercase) with a
            random 4-digit number. It repeatedly checks the database to
            ensure uniqueness.
        -   **Logic:** Uses a `do-while` loop and a database query
            (`SELECT id FROM employee WHERE username = ?`) to ensure the
            generated username does not already exist.
    -   **Form Submission Handling
        (`$_SERVER['REQUEST_METHOD'] === 'POST'`):**
        -   **Input Retrieval:** Retrieves `first_name`, `last_name`,
            `password`, `dept_id`, and `role_id` from `$_POST`.
        -   **Input Validation:** Checks if all required fields are
            non-empty.
        -   **Password Hashing:** Uses
            `password_hash($password, PASSWORD_DEFAULT)` to securely
            hash the user's password before storing it in the database.
        -   **Username Generation:** Calls `generateUniqueUsername()` to
            create a unique username.
        -   **Username Existence Check:** Performs a database query
            (`SELECT COUNT(*) FROM employee WHERE username = :username`)
            to ensure the generated username doesn't already exist
            (though `generateUniqueUsername` already handles this, this
            adds an extra layer of check).
        -   **User Insertion:** Inserts the new employee's details
            (first name, last name, generated username, hashed password,
            department ID, role ID, and a default `status` of 1) into
            the `employee` table.
        -   **Error Handling:** Catches `PDOException` for database
            errors and sets appropriate error messages.

#### logout.php (Logout)

-   **Purpose:** Handles the user logout process by destroying the
    current session and redirecting the user to the login page with a
    success message.
-   **UI Components & Dynamicity:** None directly on this page, as it's
    a processing script that redirects.
-   **Backend Functions:**
    -   **Session Management:** `session_start()` initializes the
        session. `session_unset()` unsets all session variables, and
        `session_destroy()` destroys the session.
    -   **Redirection:** Uses
        `header("Location: login.php?message=" . urlencode("You have successfully logged out."));`
        to redirect the user to `login.php` with a URL parameter
        indicating successful logout.
    -   **Error Handling:** Includes a `try-catch` block for
        `ArgumentCountError`, though this specific error is unlikely in
        this context.

#### profile.php (Employee Profile)

-   **Purpose:** Allows a logged-in employee to view their personal
    information and change their password.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
    -   **Page Header:** Displays "My Profile" and a "Back to Dashboard"
        button.
    -   **Personal Information Card:** Contains a form to update
        `first_name` and `last_name`.
        -   **Input Fields:** Pre-filled with current session data
            (`$_SESSION['firstName']`, `$_SESSION['lastName']`).
        -   **Action Buttons:** "Update Profile" and "Reset Changes"
            buttons.
    -   **Profile Summary Card:** Displays a summary of the user's
        profile:
        -   **Initials Avatar:** Dynamically generated from the user's
            first and last name initials
            (`strtoupper(substr(ucfirst($_SESSION['firstName']), 0, 1) . substr(ucfirst($_SESSION['lastName']), 0, 1))`).
        -   **User Details:** Displays full name, username, employee ID,
            role, department, and member since date (formatted using
            `date("d M Y", strtotime($_SESSION['dbDate']))`).
    -   **Change Password Section:** A form for users to change their
        password.
        -   **Error/Success Messages:** Displays dynamic messages for
            password change attempts (e.g., incorrect current password,
            new password too short, success message).
        -   **Input Fields:** `current_password`, `new_password`,
            `confirm_password`.
        -   **Action Button:** "Change Password" button.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in. If not, it
        redirects to `login.php` (though this is handled by
        `includes/navbar.php` now).
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **Password Change Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password']`):**
        -   **Input Retrieval:** Retrieves `current_password`,
            `new_password`, `confirm_password`.
        -   **Current Password Verification:** Fetches the hashed
            password from the database for the logged-in user
            (`$_SESSION['eid']`) and uses `password_verify()` to check
            if the `current_password` matches.
        -   **New Password Validation:** Checks if `new_password` is at
            least 6 characters long and not the same as
            `current_password`.
        -   **Password Update:** If validations pass, hashes the
            `new_password` using `password_hash()` and updates the
            `password` in the `employee` table for the user.
        -   **Error/Success Handling:** Sets `error_message` or
            `password_change_success` flags based on the outcome.
    -   **Profile Update Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile']`):**
        (Although the form is present, the PHP logic for
        `update_profile` is commented out or missing in the provided
        `profile.php`.) This would typically involve updating
        `first_name` and `last_name` in the database.

#### dashboard.php (Employee Dashboard)

-   **Purpose:** The main dashboard for logged-in employees, providing a
    summary of their activities and quick access to common actions.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
    -   **Welcome Section:** Displays a personalized welcome message
        using the user's first name (`$_SESSION['firstName']`).
    -   **Quick Stats:** Four cards displaying placeholder statistics
        (Hours Today, Tasks Completed, Attendance Rate, Pending Items).
        These are currently static values.
    -   **Main Dashboard Content (Grid Layout):**
        -   **Profile Card:** Displays the user's initials, full name,
            username, department, role, and employee ID, all dynamically
            pulled from `$_SESSION`.
        -   **Recent Activity:** A list of placeholder recent
            activities. These are static entries.
        -   **Quick Actions:** A list of buttons for common actions
            (Clock In/Out, Request Time Off, Submit Report, Contact HR,
            Settings). These are currently static buttons without
            implemented functionality.
    -   **Additional Dashboard Sections:** Placeholder sections for
        "Upcoming Events" and "Announcements" (content truncated in the
        provided file).
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in. If not,
        redirects to `login.php`.
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **User Details Retrieval:** Fetches additional user details from
        the `employee` table using the `username` from `$_SESSION` to
        populate the dashboard.

#### time-tracking.php (Time Tracking)

-   **Purpose:** Provides an interface for employees to manage their
    work hours, including clocking in/out and viewing their time logs.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
    -   **Page Header:** Displays "Time Tracking" and a "Back to
        Dashboard" button.
    -   **Clock In/Out Section:** Contains a button to toggle
        clock-in/out status. Displays current status (e.g., "You are
        currently clocked IN/OUT") and the last clock-in/out time.
        -   **Dynamicity:** The button text and status message change
            based on the user's clock-in status. The time displayed is
            dynamic.
    -   **Time Log Table:** Displays a table of past clock-in/out
        records, including date, clock-in time, clock-out time, and
        total hours.
        -   **Dynamicity:** Table rows are dynamically populated from
            the database.
    -   **Total Hours Summary:** Displays total hours for the current
        week/month.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in.
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **Clock In/Out Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST'`):**
        -   **Status Check:** Determines if the user is currently
            clocked in or out by querying the `time_logs` table.
        -   **Clock In:** Inserts a new record into `time_logs` with
            `clock_in_time` and `user_id`.
        -   **Clock Out:** Updates the latest `time_logs` record with
            `clock_out_time` and calculates `total_hours`.
        -   **Error/Success Messages:** Sets messages based on the
            operation's outcome.
    -   **Time Log Retrieval:** Fetches all time logs for the logged-in
        user from the `time_logs` table, ordered by date.
    -   **Total Hours Calculation:** Aggregates `total_hours` from
        `time_logs` for a specified period (e.g., current week/month).

#### leave-management.php (Leave Management)

-   **Purpose:** Allows employees to submit leave requests and view the
    status of their past requests.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
    -   **Page Header:** Displays "Leave Management" and a "Back to
        Dashboard" button.
    -   **Leave Request Form:** Contains input fields for `leave_type`
        (dropdown), `start_date`, `end_date`, and `reason` (textarea).
        -   **Dynamicity:** Form fields can retain values on submission
            errors.
    -   **Leave Request Table:** Displays a table of past leave
        requests, including type, dates, reason, and status.
        -   **Dynamicity:** Table rows are dynamically populated from
            the database.
    -   **Leave Balance Summary:** Displays remaining leave days for
        different leave types (e.g., Annual, Sick).
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in.
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **Leave Request Submission Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST'`):**
        -   **Input Retrieval:** Retrieves `leave_type`, `start_date`,
            `end_date`, `reason`.
        -   **Input Validation:** Validates dates (e.g., end date after
            start date, dates not in past) and other fields.
        -   **Leave Request Insertion:** Inserts the new leave request
            into the `leave_requests` table with a default status (e.g.,
            "Pending").
        -   **Error/Success Messages:** Sets messages based on the
            operation's outcome.
    -   **Leave Request Retrieval:** Fetches all leave requests for the
        logged-in user from the `leave_requests` table.
    -   **Leave Balance Calculation:** Queries `leave_balances` table
        (or calculates based on approved leaves) to show remaining leave
        days.

#### reports.php (Reports)

-   **Purpose:** Provides employees with access to various reports
    related to their performance, attendance, or other relevant data.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
    -   **Page Header:** Displays "Reports" and a "Back to Dashboard"
        button.
    -   **Report Selection:** A dropdown or list of available reports
        (e.g., "Attendance Report," "Performance Summary").
    -   **Report Display Area:** Dynamically loads the selected report's
        content.
        -   **Dynamicity:** Content changes based on user selection,
            potentially using AJAX for seamless loading.
    -   **Filtering Options:** Date range pickers, department filters,
        etc., for customizing reports.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in.
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **Report Generation Logic:** Based on the selected report type
        and filters, queries the database to fetch relevant data.
    -   **Data Processing:** Processes fetched data for display (e.g.,
        calculating averages, totals).
    -   (Potentially) Integration with `js/reports.js` for client-side
        charting or interactive elements.

#### analytics.php (Analytics)

-   **Purpose:** Provides employees with visual analytics and insights
    into their performance, work patterns, or other metrics.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `includes/navbar.php`.
    -   **Page Header:** Displays "Analytics" and a "Back to Dashboard"
        button.
    -   **Chart/Graph Display Area:** Contains canvases or containers
        for various charts (e.g., bar charts for hours worked, pie
        charts for task distribution).
        -   **Dynamicity:** Charts are rendered dynamically using
            JavaScript charting libraries (e.g., Chart.js, D3.js) based
            on data fetched from the backend.
    -   **Filtering Options:** Date range, type of analytics, etc.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in.
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **Data Aggregation for Charts:** Queries the database to
        aggregate data suitable for charting (e.g., daily hours, task
        completion rates).
    -   **JSON Output:** Provides data to the frontend in JSON format
        for JavaScript to consume and render charts.

#### downloadprofile.php (Download Profile)

-   **Purpose:** Allows users to download their profile information,
    potentially as a PDF or other document format.
-   **UI Components & Dynamicity:** None directly visible, as it's a
    processing script that initiates a file download.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in.
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **User Data Retrieval:** Fetches all necessary profile data for
        the logged-in user.
    -   **Document Generation:** (Assumed) Uses a library (e.g., FPDF,
        TCPDF, or a custom HTML-to-PDF converter) to generate a PDF
        document from the user's profile data.
    -   **File Headers:** Sets appropriate HTTP headers (`Content-Type`,
        `Content-Disposition`) to force the browser to download the
        generated file.
    -   **File Output:** Outputs the generated file content to the
        browser.
    -   (Reference: `cv.pdf` and `portal.pdf` in the root suggest PDF
        generation/download capability).

#### process\_skill.php (Process Skill)

-   **Purpose:** Likely an AJAX endpoint or a backend processing script
    to handle skill-related data, such as adding, updating, or deleting
    skills for an employee.
-   **UI Components & Dynamicity:** None directly visible, as it's a
    backend processing script.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in (and
        potentially has appropriate permissions).
    -   **Database Connection:** `require_once 'includes/config.php';`.
    -   **Input Retrieval:** Retrieves skill data from `$_POST` or
        `$_GET` (e.g., skill name, proficiency level, user ID).
    -   **Database Operations:** Performs CRUD operations (Insert,
        Update, Delete) on a `skills` or `employee_skills` table.
    -   **Response:** Returns a JSON response indicating success or
        failure, which would be consumed by a frontend AJAX call.

### Admin Backend Pages

These pages are typically accessed by administrators and are located
within the `backend/` directory.

#### backend/dashboard.php (Admin Dashboard)

-   **Purpose:** The main dashboard for administrators, providing an
    overview of key metrics and quick access to administrative
    functions.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `backend/navbar.php`.
    -   **Sidebar:** Included via `backend/sidebar.php`.
    -   **Welcome Section:** Personalized welcome message for the admin.
    -   **Quick Stats Cards:** Displays summary statistics (e.g., Total
        Employees, Active Employees, Administrators, Departments). These
        are dynamically populated from database counts.
    -   **Recent Activity/Quick Actions:** Placeholder sections, similar
        to the employee dashboard, but tailored for admin tasks.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in and has an
        'admin' role. Redirects to `../login.php` if not.
    -   **Database Connection:**
        `require_once '../includes/config.php';`.
    -   **Data Aggregation:** Queries the database to count total
        employees, active employees, administrators, and departments to
        populate the stats cards.

#### backend/employee/listing.php (Employee Listing)

-   **Purpose:** Displays a comprehensive list of all employees in the
    system, with search and action capabilities for administrators.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `backend/navbar.php`.
    -   **Sidebar:** Included via `backend/sidebar.php`.
    -   **Page Header:** Displays "Employee Management" and a
        description.
    -   **Stats Cards:** Displays total employees, active employees, and
        administrators (similar to admin dashboard).
    -   **Employee Directory Table:** A table listing employees with
        columns for ID, Name, Username, Department, Role, and Actions.
        -   **Dynamicity:** Table rows are dynamically populated from
            the `employee` table.
        -   **Search Input:** Allows administrators to search employees
            by username, first name, last name, or department. The
            search query is retained in the input field.
        -   **Search/Clear Buttons:** Buttons to submit the search form
            or clear the search query.
        -   **Role Display:** Employee roles are displayed with
            different background colors and icons based on whether they
            are 'admin' or 'employee'.
        -   **Action Buttons:** "Edit" and "Delete" buttons for each
            employee row, with `onclick` JavaScript functions
            (`editEmployee()`, `deleteEmployee()`) that pass the
            employee ID and username.
    -   **Pagination/Per Page Selector:** A dropdown to select the
        number of employees per page (10, 25, 50). (Note: Actual
        pagination logic might be missing or incomplete in the provided
        file, as `per_page` and `page` parameters are retrieved but not
        fully utilized for limiting results).
    -   **"No employees found" message:** Conditionally displayed if the
        search yields no results or if the database is empty.
    -   **"Add First Employee" button:** Redirects to `../register.php`.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in and has an
        'admin' role.
    -   **Database Connection:**
        `require_once '../../includes/config.php';`.
    -   **Search Query Handling:** Retrieves `q` (search query),
        `per_page`, and `page` from `$_GET`.
    -   **Employee Data Retrieval:** Constructs a SQL query to select
        all employees. If a search query is provided, it adds `WHERE`
        clauses with `LIKE` for username, first name, last name, and
        department. Uses prepared statements with `bindParam` for the
        search parameter.
    -   **Data Filtering:** Uses `array_filter` to count 'employee' and
        'admin' roles from the fetched data.
    -   **Error Handling:** Catches `PDOException` for database errors.

#### backend/departments.php (Department Management)

-   **Purpose:** Allows administrators to manage departments (add, edit,
    delete).
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `backend/navbar.php`.
    -   **Sidebar:** Included via `backend/sidebar.php`.
    -   **Page Header:** Displays "Department Management."
    -   **Add New Department Form:** A form with an input field for
        `department_name` and a "Add Department" button.
    -   **Department List Table:** Displays a table of existing
        departments with columns for ID, Name, Status, and Actions.
        -   **Dynamicity:** Table rows are dynamically populated from
            the `department` table.
        -   **Status Display:** Department status (Active/Inactive) is
            displayed.
        -   **Action Buttons:** "Edit" and "Delete" buttons for each
            department row, with `onclick` JavaScript functions
            (`editDepartment()`, `deleteDepartment()`).
    -   **Error/Success Messages:** Displays dynamic messages for
        department operations.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in and has an
        'admin' role.
    -   **Database Connection:**
        `require_once '../../includes/config.php';`.
    -   **Add Department Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_department']`):**
        -   **Input Retrieval:** Retrieves `department_name`.
        -   **Input Validation:** Checks if `department_name` is not
            empty.
        -   **Insertion:** Inserts the new department into the
            `department` table with a default `status` of 1.
        -   **Error/Success Handling:** Sets messages based on the
            outcome.
    -   **Delete Department Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_department']`):**
        -   **Input Retrieval:** Retrieves `department_id`.
        -   **Deletion:** Deletes the department from the `department`
            table based on `department_id`.
        -   **Error/Success Handling:** Sets messages.
    -   **Department List Retrieval:** Fetches all departments from the
        `department` table.

#### backend/roles.php (Role Management)

-   **Purpose:** Allows administrators to manage user roles (add, edit,
    delete).
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `backend/navbar.php`.
    -   **Sidebar:** Included via `backend/sidebar.php`.
    -   **Page Header:** Displays "Role Management."
    -   **Add New Role Form:** A form with an input field for
        `role_name` and a "Add Role" button.
    -   **Role List Table:** Displays a table of existing roles with
        columns for ID, Name, Status, and Actions.
        -   **Dynamicity:** Table rows are dynamically populated from
            the `roles` table.
        -   **Status Display:** Role status (Active/Inactive) is
            displayed.
        -   **Action Buttons:** "Edit" and "Delete" buttons for each
            role row, with `onclick` JavaScript functions (`editRole()`,
            `deleteRole()`).
    -   **Error/Success Messages:** Displays dynamic messages for role
        operations.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in and has an
        'admin' role.
    -   **Database Connection:**
        `require_once '../../includes/config.php';`.
    -   **Add Role Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_role']`):**
        -   **Input Retrieval:** Retrieves `role_name`.
        -   **Input Validation:** Checks if `role_name` is not empty.
        -   **Insertion:** Inserts the new role into the `roles` table
            with a default `status` of 1.
        -   **Error/Success Handling:** Sets messages based on the
            outcome.
    -   **Delete Role Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_role']`):**
        -   **Input Retrieval:** Retrieves `role_id`.
        -   **Deletion:** Deletes the role from the `roles` table based
            on `role_id`.
        -   **Error/Success Handling:** Sets messages.
    -   **Role List Retrieval:** Fetches all roles from the `roles`
        table.

#### backend/edituser.php (Edit User)

-   **Purpose:** Provides a form for administrators to edit the details
    of a specific employee.
-   **UI Components & Dynamicity:**
    -   **Navigation Bar:** Included via `backend/navbar.php`.
    -   **Sidebar:** Included via `backend/sidebar.php`.
    -   **Page Header:** Displays "Edit Employee" and a "Back to
        Employee List" button.
    -   **Edit Employee Form:** Contains input fields for `first_name`,
        `last_name`, `username`, `department` (dropdown), `role`
        (dropdown), and `status` (dropdown).
        -   **Dynamicity:** Form fields are pre-filled with the current
            data of the employee being edited (fetched via
            `$_GET['id']`). Dropdowns for department, role, and status
            are dynamically populated and the current value is selected.
        -   **Action Buttons:** "Update Employee" and "Reset Changes"
            buttons.
    -   **Error/Success Messages:** Displays dynamic messages for update
        operations.
-   **Backend Functions:**
    -   **Session Check:** Ensures the user is logged in and has an
        'admin' role.
    -   **Database Connection:**
        `require_once '../../includes/config.php';`.
    -   **Employee Data Retrieval:** Retrieves `id` from `$_GET`.
        Fetches the employee's current data from the `employee` table
        based on the `id`.
    -   **Department, Role, Status Fetching:** Fetches available
        departments, roles, and status options from their respective
        tables to populate dropdowns.
    -   **Update Employee Logic
        (`$_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_employee']`):**
        -   **Input Retrieval:** Retrieves updated `first_name`,
            `last_name`, `username`, `department_id`, `role_id`,
            `status_id`.
        -   **Input Validation:** Checks for non-empty fields.
        -   **Update:** Updates the employee's details in the `employee`
            table based on the submitted data and `employee_id`.
        -   **Error/Success Handling:** Sets messages.

### Includes and Common Components

These files are included across multiple pages to promote code
reusability and maintain consistency.

#### includes/config.php (Database Configuration)

-   **Purpose:** Establishes the database connection using PDO and
    defines database credentials.
-   **Backend Functions:**
    -   **Constants:** Defines `DB_USER`, `DB_PASS`, `DB_NAME`.
    -   **PDO Connection:** Creates a new PDO instance to connect to a
        MySQL database (`mysql:host=127.0.0.1;dbname=portal`).
    -   **Error Mode:** Sets `PDO::ATTR_ERRMODE` to
        `PDO::ERRMODE_EXCEPTION`, which configures PDO to throw
        exceptions on database errors, making debugging easier.
    -   **Commented Code:** Includes commented-out examples for
        `password_verify()` and notes on closing connections.

#### includes/navbar.php (Navigation Bar)

-   **Purpose:** Provides the main navigation menu for the public-facing
    and employee dashboard pages. It dynamically adjusts links based on
    user login status.
-   **UI Components & Dynamicity:**
    -   **Navbar Container:** Holds the brand logo and navigation links.
    -   **Navbar Brand:** Displays "Employee Portal" with an icon,
        linking to `index.php`.
    -   **Navbar Navigation (`navbar-nav`):**
        -   **Conditional Links:** Displays different sets of links
            based on `isset($_SESSION['firstName'])`:
            -   **Logged In:** Shows "Dashboard," "Profile," "Time
                Tracking" (placeholder), "Schedule" (placeholder),
                user's first name, and "Logout" button.
            -   **Logged Out:** Shows "Home," "Features" (anchor),
                "Contact" (anchor), and "Login" button.
        -   **Active Link Styling:** Dynamically applies the `active`
            CSS class to the current page's navigation link using
            `basename($_SERVER["PHP_SELF"])`.
        -   **User Display:** Shows the logged-in user's first name
            (`ucfirst($_SESSION['firstName'])`).
    -   **Mobile Toggle:** A button (`navbar-mobile-toggle`) for
        responsive navigation (handled by JavaScript in `index.php`).
-   **Backend Functions:**
    -   **Session Management:** `session_start()` ensures session
        variables are available.
    -   **Page Detection:** Uses `basename($_SERVER["PHP_SELF"])` to
        determine the current page for active link styling.
    -   **Access Control:** Checks `$_SESSION['firstName']` to
        conditionally render navigation links. Includes a redirection to
        `index.php` with a message if an unauthenticated user tries to
        access `profile.php` or `dashboard.php`.

#### includes/footer.php (Footer)

-   **Purpose:** Provides a consistent footer across the public-facing
    and employee dashboard pages.
-   **UI Components & Dynamicity:**
    -   **Copyright Information:** Static text displaying copyright
        details.
    -   **Social Media Links:** Placeholder social media icons.
-   **Backend Functions:** None, primarily static HTML.

### CSS and JavaScript

These files define the visual style and interactive behavior of the
application.

#### css/design-system.css

-   **Purpose:** Defines global design tokens, variables, and
    foundational styles for the application. This includes color
    palettes, typography, spacing, border-radii, and basic resets.
-   **Key Elements:** `--primary-`, `--success-`, `--warning-`,
    `--error-` color variables, font families, spacing units
    (`--space-`), border-radius variables (`--radius-`).

#### css/components.css

-   **Purpose:** Defines styles for reusable UI components used
    throughout the application. This promotes consistency and reduces
    redundancy.
-   **Key Elements:** Styles for `navbar`, `btn` (buttons),
    `form-group`, `form-label`, `form-input`, `form-select`, `alert`,
    `card`, `auth-container`, `auth-card`, `table-container`,
    `data-table`, `table-actions`, `feature-card`, etc.

#### css/style.css

-   **Purpose:** Contains general layout styles and specific page-level
    styles that are not covered by the design system or component
    styles. It acts as the main stylesheet for public and employee
    pages.
-   **Key Elements:** Styles for `body`, `container`, `hero` section,
    `features` section, `cta` section, and general utility classes.

#### css/adminpanel.css

-   **Purpose:** Contains specific styles tailored for the admin panel,
    overriding or extending base styles from `style.css` or
    `components.css` where necessary.
-   **Key Elements:** Styles for admin dashboard layout, sidebar,
    admin-specific tables, and forms.

#### css/reports.css

-   **Purpose:** Contains styles specifically for the reports and
    analytics pages, likely for charts, graphs, and data visualization
    elements.
-   **Key Elements:** Styles for report containers, chart canvases, and
    potentially specific table layouts for reports.

#### js/reports.js

-   **Purpose:** Contains JavaScript logic for the reports and analytics
    functionalities, likely involving data fetching, chart rendering,
    and interactive filtering.
-   **Key Elements:** (Based on common patterns) Functions for:
    -   Fetching report data from backend PHP scripts (potentially via
        AJAX).
    -   Initializing and rendering charts using a charting library
        (e.g., Chart.js).
    -   Handling user interactions like date range selection or report
        type changes.
    -   Updating chart data dynamically.

3. Database Schema (schema.db and portal.sql)
---------------------------------------------

-   **`db/schema.db`:** This file suggests the project might have
    initially used or has a schema definition for an SQLite database.
    However, `includes/config.php` is configured for MySQL.
-   **`portal.sql`:** This file contains the SQL commands to create the
    necessary tables and potentially insert initial data for the MySQL
    database. It defines the structure of your application's data.
-   **Expected Tables (based on code analysis):**
    -   `employee`: Stores employee details (first name, last name,
        username, hashed password, department ID, role ID, status,
        created\_at).
    -   `roles`: Stores user roles (ID, name, status).
    -   `department`: Stores department details (ID, name, status).
    -   `time_logs`: Stores employee clock-in/out records (user ID,
        clock-in time, clock-out time, total hours).
    -   `leave_requests`: Stores employee leave requests (user ID, leave
        type, start date, end date, reason, status).
    -   (Potentially) `skills`, `employee_skills`, `announcements`,
        `notifications` tables for future/planned features.

4. Setup and Installation
-------------------------

To set up and run this project locally:

1.  **Web Server:** Ensure you have a web server installed (e.g.,
    Apache, Nginx) with PHP support.
2.  **Database:** Set up a MySQL database. Create a database named
    `portal`.
3.  **Import Schema:** Import the `portal.sql` file into your MySQL
    database to create the necessary tables.
4.  **Configure Database Connection:** Open `includes/config.php` and
    update the `DB_USER`, `DB_PASS`, and `DB_NAME` constants with your
    database credentials.
5.  **Place Project:** Place the entire `portal/` directory within your
    web server's document root (e.g., `htdocs` for Apache, `www` for
    Nginx).
6.  **Access:** Open your web browser and navigate to
    `http://localhost/portal/` (or your configured domain/path).

**Note:** For production environments, ensure `display_errors` is set to
`Off` in your `php.ini` for security. Implement proper error logging
instead. Also, consider using HTTPS.

# README.txt Update for Employee Portal (Version 1.1.1)

This document outlines the updates and new functionalities introduced in `portal-ver-1.1.1.zip` compared to the previous version. For each change, a brief description of the functionality, UI dynamicity, backend logic, and a "Concept Learned" paragraph is provided. This content is intended to be appended to your existing `README.txt`.

## Project Overview Update

Version 1.1.1 introduces significant enhancements in employee management, departmental and role administration, and lays groundwork for more robust data handling and user experience improvements, particularly in the admin panel.

## Updated Core Functionalities

### Public-Facing Pages

#### login.php (Employee Login) - *Updated*

*   **Changes:** The login process now more robustly handles session management and redirects, ensuring that `$_SESSION` variables are correctly populated for role and department names upon successful login. Error messages are also more clearly displayed.
*   **UI Components & Dynamicity:** Improved error message display with `alert alert-error` styling. Session-based redirection logic is refined.
*   **Backend Functions:**
    *   **Enhanced Session Data:** Upon successful login, `$_SESSION["rname"]` (role name) and `$_SESSION["dname"]` (department name) are now explicitly fetched from the database and stored, providing more complete user context for the session.
    *   **Refined Role-based Redirection:** The redirection logic after successful login is more explicit, directing admins (role 1) to `backend/admin.php` (though the file structure has changed, this indicates the intent) and other roles to `dashboard.php`.
*   **Concept Learned:** This update reinforces the importance of comprehensive session management, ensuring all necessary user-related data is available throughout the application. It also highlights the need for clear, user-friendly feedback mechanisms for authentication processes.

#### register.php (Employee Registration) - *Updated*

*   **Changes:** The registration process now includes more detailed form fields for employee information and has a refined success state display.
*   **UI Components & Dynamicity:**
    *   **Expanded Form Fields:** Added input fields for `first_name`, `last_name`, `password`, `department`, and `role`. The form now uses a `grid grid-cols-2` for better layout.
    *   **Success State:** A new, visually distinct success message container (`registration-success`) is displayed upon successful registration, offering clear options to "Login Now" or "Register Another Employee."
*   **Backend Functions:**
    *   **Unique Username Generation:** The `generateUniqueUsername` function is introduced to create a unique username based on the employee's name, preventing duplicate usernames. This function iteratively generates a username and checks its existence in the database.
    *   **Comprehensive Employee Data Insertion:** The `INSERT` query now captures `first_name`, `last_name`, `username`, `password`, `department`, `role`, and `status` (defaulting to 1).
    *   **Password Hashing:** Continues to use `password_hash(PASSWORD_DEFAULT)` for secure password storage.
*   **Concept Learned:** This demonstrates robust user registration practices, including client-side and server-side validation, secure password handling, and the critical need for unique identifiers (usernames) in a multi-user system. The `generateUniqueUsername` function illustrates a practical application of database uniqueness constraints and iterative problem-solving.

#### profile.php (Employee Profile) - *Updated*

*   **Changes:** The profile page has been enhanced to display more detailed employee information and includes a section for changing passwords.
*   **UI Components & Dynamicity:**
    *   **Profile Summary Card:** Now dynamically displays user initials, full name, username, employee ID, role, department, and member since date, all pulled from `$_SESSION` variables.
    *   **Password Change Section:** A dedicated form for changing passwords with input fields for `current_password`, `new_password`, and `confirm_password`. Error and success messages are displayed dynamically based on the password change attempt.
*   **Backend Functions:**
    *   **Password Change Logic:** Implemented to verify the `current_password` against the hashed password in the database using `password_verify()`. It then validates the `new_password` (length, match with confirmation) and updates the database with the new hashed password.
    *   **Session Data Utilization:** Extensively uses `$_SESSION` variables to pre-fill and display user information, reducing redundant database queries for display purposes.
*   **Concept Learned:** This update showcases secure password management best practices (hashing, verification, validation of new passwords), and the efficient use of session data to personalize user interfaces without constant database lookups.

#### reports.php (Reports) - *Updated*

*   **Changes:** The reports page now includes a dynamic search and filtering mechanism for employee data, and displays the results in a paginated table.
*   **UI Components & Dynamicity:**
    *   **Search Input:** A text input field (`name="q"`) allows users to search for employees by name, username, department, or role.
    *   **Pagination:** Displays pagination controls (`pagination-btn`) to navigate through report pages. The current page is highlighted (`active`).
    *   **Per Page Selector:** A dropdown (`per_page`) allows users to select the number of records displayed per page (10, 25, 50).
    *   **Dynamic Table Content:** The employee table (`admin-table`) is dynamically populated with data fetched from the backend based on search queries and pagination parameters.
    *   **Conditional Display:** "No employees found" message is displayed if the search yields no results.
*   **Backend Functions:**
    *   **Search and Pagination Logic:** Retrieves `q` (search query), `per_page`, and `page` from `$_GET` parameters. These are used to construct dynamic SQL queries.
    *   **Dynamic SQL Query Construction:** The `SELECT` query for employees is dynamically modified to include `WHERE` clauses for search terms and `LIMIT`/`OFFSET` for pagination. `LIKE` operator is used for flexible searching.
    *   **Prepared Statements:** Uses prepared statements (`bindParam`) for search queries to prevent SQL injection.
    *   **Total Row Count:** A separate query (`SELECT COUNT(*)`) is executed to determine the total number of records for pagination calculation.
    *   **Data Filtering and Display:** Fetches employee data, including department and role names through `JOIN` operations, and displays them in the table.
*   **Concept Learned:** This demonstrates advanced database interaction, including dynamic query building, pagination, and search functionality. It highlights the importance of prepared statements for security and efficient data retrieval for large datasets.

### Admin Backend Pages

#### backend/add_employee.php - *New File*

*   **Purpose:** This script handles the backend logic for adding a new employee from the admin panel. It processes submitted form data, generates a unique username, hashes the password, and inserts the new employee record into the database.
*   **UI Components & Dynamicity:** This is a backend processing script; it does not have a direct UI. It redirects to `employees.php` (likely `backend/employee/listing.php`) upon completion or `dashboard.php` on error.
*   **Backend Functions:**
    *   **Input Sanitization and Collection:** Collects and sanitizes various employee details (`first_name`, `last_name`, `username`, `email`, `password`, `department`, `role`, `status`, `phone`, `gender`, `marital_status`) from `$_POST`.
    *   **Unique Username Generation:** Reuses the `generateUniqueUsername` function (defined locally within the script) to ensure the generated username is unique before insertion.
    *   **Password Hashing:** Uses `password_hash(PASSWORD_DEFAULT)` for secure storage of the employee's password.
    *   **Database Insertion:** Inserts the comprehensive employee data into the `employee` table.
    *   **Session-based Messaging:** Sets `$_SESSION["success"]` or `$_SESSION["error_message"]` for feedback to the user after redirection.
    *   **Redirection:** Uses `header("Location: ...")` for post-processing redirection.
*   **Concept Learned:** This file exemplifies a dedicated backend processing script, separating concerns from the UI. It reinforces secure data handling (password hashing), input validation, and the practical application of unique data generation and error handling in a real-world scenario.

#### backend/dashboard/dashboard.php (Admin Dashboard) - *Updated & Moved*

*   **Changes:** The admin dashboard has been refactored into its own subdirectory (`backend/dashboard/`) and significantly enhanced with more detailed metrics and dynamic data display.
*   **UI Components & Dynamicity:**
    *   **Metrics Grid:** A new `metrics-grid` layout displays various `metric-card` components for key statistics.
    *   **Dynamic Statistics:** Cards for "Total Employees," "Active Employees," "Administrators," "Departments," "Roles," and "Inactive Users" are dynamically populated with counts and percentages fetched from the database.
        *   **Trend Indicators:** "Total Employees" and "Active Employees" cards include dynamic trend indicators (`metric-trend`) with up/down arrows and percentage changes based on data (e.g., new users this month, active user percentage).
    *   **Placeholder Cards:** Includes placeholder cards for "New Employees (7 days)," "Degree Programs," and "Certifications," indicating future expansion.
*   **Backend Functions:**
    *   **Centralized Data Fetching:** A single SQL query fetches all employee data (`employee.*, department.name, roles.name`) using `JOIN`s to get comprehensive information for various calculations.
    *   **Aggregated Counts:** Uses `COUNT(id)` and `SUM(CASE WHEN ... THEN 1 ELSE 0 END)` in SQL queries to efficiently retrieve counts for departments, roles, and active/inactive employees.
    *   **PHP Data Processing:** Utilizes `array_filter` and `strtotime` to calculate dynamic metrics like "New Users this month" and percentages for active/inactive users directly in PHP before display.
*   **Concept Learned:** This demonstrates how to build a data-rich dashboard by efficiently querying and aggregating data from multiple tables. It highlights the use of PHP for server-side data processing and presentation logic, including conditional styling based on data values, and the importance of clear, concise metrics for administrative oversight.

#### backend/departments/listingDept.php (Department Listing) - *Updated & Moved*

*   **Changes:** The department management functionality has been moved to `backend/departments/` and enhanced with pagination and a modal for viewing department details via AJAX.
*   **UI Components & Dynamicity:**
    *   **Pagination:** Implemented with "Previous" and "Next" buttons and numbered page links, allowing navigation through department records. The current page is highlighted.
    *   **Department Table:** Displays department name, employee count, status, and action buttons (View, Edit, Delete).
        *   **Employee Count:** Dynamically displays the number of employees associated with each department.
        *   **Status Toggle:** The status button (`Active`/`Inactive`) is a form that submits to change the department status.
        *   **View Button (`view-dept-btn`):** Triggers a JavaScript function to open a modal and fetch department details via AJAX.
    *   **View Department Modal (`viewDepartmentModal`):** A hidden modal that appears when the "View" button is clicked. It dynamically populates with department name, status, and employee count.
*   **Backend Functions:**
    *   **Pagination Logic:** Calculates `limit`, `offset`, `myPage`, and `allPages` based on `$_GET["page"]` and a fixed limit (5 records per page). This is crucial for handling large datasets efficiently.
    *   **SQL with LIMIT and OFFSET:** The main `SELECT` query for departments uses `LIMIT :limit OFFSET :offset` to fetch only the records for the current page.
    *   **`LEFT JOIN` and `GROUP BY`:** The query uses `LEFT JOIN employee ON department.id = employee.department` and `GROUP BY department.id` to count employees per department, even if a department has no employees.
    *   **Status Update Logic:** Handles `POST` requests to update a department's status (active/inactive) in the database and redirects back to the current page to reflect changes.
*   **Concept Learned:** This demonstrates robust data table management, including server-side pagination for performance, `LEFT JOIN` for comprehensive data retrieval, and basic AJAX integration for dynamic content loading (modal details). It also shows how to implement a simple status toggle for records.

#### backend/departments/get_dept.php - *New File*

*   **Purpose:** This is an AJAX endpoint designed to fetch detailed information about a single department based on its ID and return it as a JSON response.
*   **UI Components & Dynamicity:** This is a backend script; it does not have a direct UI. Its output is consumed by frontend JavaScript (e.g., in `listingDept.php`) to populate a modal.
*   **Backend Functions:**
    *   **Input Retrieval:** Retrieves `deptId` from `$_GET`.
    *   **Database Query:** Selects department details (`id`, `name`, `status`) and counts associated employees using `LEFT JOIN` and `GROUP BY` for the specific `deptId`.
    *   **JSON Encoding:** Encodes the fetched department data into a JSON object using `json_encode()` and sends it as the response with `header("Content-Type: application/json");`.
    *   **Error Handling:** Includes a `try-catch` block for `PDOException` and returns an error JSON if a database issue occurs.
*   **Concept Learned:** This is a prime example of building a dedicated API endpoint for AJAX requests. It teaches how to efficiently fetch specific data, format it as JSON, and handle errors for client-side consumption, which is fundamental for creating dynamic web applications.

#### backend/employee/listing.php (Employee Listing) - *Updated*

*   **Changes:** The employee listing has been significantly updated to include more detailed employee information, search functionality, and action buttons for soft delete and update.
*   **UI Components & Dynamicity:**
    *   **Employee Table:** Displays employee ID, name, username, department, role, status, and actions.
        *   **Status Display:** Employee status (Active/Inactive) is displayed with distinct styling.
        *   **Action Buttons:** "Edit" (now likely linked to `update_employee.php` or a modal) and "Delete" (linked to `soft_delete_employee.php`) buttons are present for each employee.
*   **Backend Functions:**
    *   **Comprehensive Employee Data:** The SQL query now fetches `employee.*`, `department.name` (as `deptName`), and `roles.name` (as `roleName`) using `JOIN`s, providing a richer dataset for display.
    *   **Search Functionality:** The `q` parameter from `$_GET` is used to filter employees by `first_name`, `last_name`, `username`, `deptName`, or `roleName` using `LIKE` clauses.
    *   **Status Filtering:** Employees are filtered by `status = 1` (active) by default, but the `status` column is still displayed.
*   **Concept Learned:** This update demonstrates how to present complex relational data in a user-friendly table, implement robust search capabilities across multiple fields, and prepare for advanced actions like soft deletion and updates.

#### backend/employee/soft_delete_employee.php - *New File*

*   **Purpose:** This script handles the 


soft deletion of employee records by updating their status to inactive.
*   **UI Components & Dynamicity:** This is a backend processing script; it does not have a direct UI. It redirects back to the employee listing page upon completion.
*   **Backend Functions:**
    *   **Input Retrieval:** Retrieves the `id` of the employee to be soft-deleted from `$_GET`.
    *   **Database Update:** Executes an `UPDATE` query to set the `status` of the specified employee to `0` (inactive).
    *   **Redirection:** Redirects the user back to `backend/employee/listing.php` after the update.
*   **Concept Learned:** This demonstrates the concept of "soft deletion" in database management, where records are marked as inactive rather than permanently removed. This is crucial for maintaining data integrity, historical records, and audit trails, and is a common practice in enterprise applications.

#### backend/employee/update_employee.php - *New File*

*   **Purpose:** This script handles the backend logic for updating an existing employee's details. It processes submitted form data and updates the employee record in the database.
*   **UI Components & Dynamicity:** This is a backend processing script; it does not have a direct UI. It redirects to the employee listing page upon completion or error.
*   **Backend Functions:**
    *   **Input Sanitization and Collection:** Collects and sanitizes various employee details from `$_POST`, including the employee `id`.
    *   **Database Update:** Executes an `UPDATE` query to modify the employee's details in the `employee` table based on the provided `id`.
    *   **Password Handling:** If a new password is provided, it is hashed using `password_hash(PASSWORD_DEFAULT)` before updating. If no new password is provided, the existing password remains unchanged.
    *   **Session-based Messaging:** Sets `$_SESSION["success"]` or `$_SESSION["error_message"]` for feedback to the user after redirection.
    *   **Redirection:** Uses `header("Location: ...")` for post-processing redirection.
*   **Concept Learned:** This file illustrates the process of updating existing records in a database, including conditional updates (like password changes) and the importance of using prepared statements for secure data modification. It also reinforces the use of session messages for user feedback.

#### backend/roles/listingRoles.php (Role Listing) - *New Directory & File*

*   **Purpose:** This page displays a list of all roles in the system, with pagination and options to change their status.
*   **UI Components & Dynamicity:**
    *   **Role Table:** Displays role ID, name, and status.
    *   **Pagination:** Similar to department listing, it includes pagination controls for navigating through roles.
    *   **Status Toggle:** Allows changing a role's status (active/inactive) via a form submission.
*   **Backend Functions:**
    *   **Pagination Logic:** Implements server-side pagination for roles, fetching a limited number of records per page.
    *   **Role Data Retrieval:** Queries the `roles` table to fetch role details.
    *   **Status Update:** Processes form submissions to update the `status` of a role in the database.
*   **Concept Learned:** This demonstrates the implementation of a basic CRUD (Create, Read, Update, Delete) operation for managing roles, including pagination for efficient display of data and status toggling.

#### backend/roles/get_roles.php - *New File*

*   **Purpose:** This is an AJAX endpoint to fetch details of a single role based on its ID.
*   **UI Components & Dynamicity:** Backend script, provides JSON output for frontend consumption.
*   **Backend Functions:**
    *   **Input Retrieval:** Retrieves `roleId` from `$_GET`.
    *   **Database Query:** Selects role details (`id`, `name`, `status`) for the specified `roleId`.
    *   **JSON Encoding:** Encodes the fetched role data into a JSON object and sends it as the response.
*   **Concept Learned:** Similar to `get_dept.php`, this reinforces the pattern of creating dedicated AJAX endpoints for retrieving specific data, crucial for building dynamic and responsive user interfaces.

#### backend/sidebar.php - *Updated*

*   **Changes:** The sidebar navigation has been updated to include new links for Department Management and Role Management, reflecting the new functionalities.
*   **UI Components & Dynamicity:** The sidebar dynamically displays navigation links based on the user's role or permissions (though explicit permission checks are not shown in the provided code, the structure implies this).
*   **Backend Functions:** No direct backend processing, primarily includes HTML for navigation.
*   **Concept Learned:** This highlights the importance of updating navigation to reflect new features and the common practice of using include files for reusable UI components like sidebars.

#### css/adminpanel.css - *Updated*

*   **Changes:** Contains new and updated CSS rules to support the enhanced dashboard layout, modal styling, and other UI improvements in the admin panel.
*   **UI Components & Dynamicity:** Provides styling for `metrics-grid`, `metric-card`, `modal`, `form-grid`, `input-with-action`, `radio-group`, and various other elements to ensure a consistent and responsive design.
*   **Backend Functions:** N/A (CSS is frontend styling).
*   **Concept Learned:** This demonstrates the application of modern CSS techniques (Flexbox, Grid) for creating responsive and visually appealing layouts, and the importance of a well-organized stylesheet for maintainability.

#### includes/navbar.php - *Updated*

*   **Changes:** The main navigation bar has been updated, likely to include new links or adjust existing ones based on the project's expansion.
*   **UI Components & Dynamicity:** Displays the main navigation links.
*   **Backend Functions:** No direct backend processing.
*   **Concept Learned:** Reinforces the use of include files for common UI elements and the need to keep navigation consistent with application features.

#### process_academic.php - *New File*

*   **Purpose:** This script handles the processing of academic information submitted for an employee.
*   **UI Components & Dynamicity:** Backend processing script, redirects upon completion.
*   **Backend Functions:**
    *   **Input Collection:** Collects academic details (e.g., degree, institution, year) from `$_POST`.
    *   **Database Insertion/Update:** Inserts or updates academic records associated with an employee.
*   **Concept Learned:** This introduces the concept of handling complex, multi-part forms and associating data with a specific user or entity (employee in this case).

#### process_skill.php - *Updated*

*   **Changes:** Updated to handle skill information submission, likely with more fields or improved validation.
*   **UI Components & Dynamicity:** Backend processing script.
*   **Backend Functions:**
    *   **Input Collection:** Collects skill details from `$_POST`.
    *   **Database Insertion/Update:** Inserts or updates skill records.
*   **Concept Learned:** Further demonstrates handling of relational data and form processing for specific data types.

#### process_workex.php - *New File*

*   **Purpose:** This script handles the processing of work experience information submitted for an employee.
*   **UI Components & Dynamicity:** Backend processing script, redirects upon completion.
*   **Backend Functions:**
    *   **Input Collection:** Collects work experience details (e.g., company, title, duration) from `$_POST`.
    *   **Database Insertion/Update:** Inserts or updates work experience records associated with an employee.
*   **Concept Learned:** Similar to `process_academic.php`, this reinforces handling of structured data related to an employee's profile.

#### profile.php - *Updated*

*   **Changes:** The user profile page has been significantly enhanced to include sections for academic details, skills, and work experience, along with the ability to upload a profile picture.
*   **UI Components & Dynamicity:**
    *   **Profile Picture Upload:** Includes a form for uploading a profile picture, with client-side validation for file type and size.
    *   **Dynamic Sections:** Displays academic, skill, and work experience details in separate, collapsible sections.
    *   **Form Submission:** Forms for adding/editing academic, skill, and work experience are present.
*   **Backend Functions:**
    *   **File Upload Handling:** Processes uploaded profile pictures, moves them to a designated `uploads` directory, and updates the user's record with the file path. Includes error handling for file uploads.
    *   **Data Retrieval:** Fetches academic, skill, and work experience data from the database for the logged-in user.
    *   **Data Processing:** Integrates with `process_academic.php`, `process_skill.php`, and `process_workex.php` for handling form submissions related to these sections.
*   **Concept Learned:** This is a comprehensive example of building a rich user profile page, demonstrating file upload handling (a critical aspect of web development), managing multiple related data entities, and integrating with dedicated backend processing scripts.

#### reports.php - *Updated*

*   **Changes:** The reports page has been further refined, potentially with new reporting options or improved data visualization capabilities.
*   **UI Components & Dynamicity:** May include new filters, charts, or table enhancements.
*   **Backend Functions:** Likely involves more complex SQL queries for generating specific reports.
*   **Concept Learned:** This showcases the evolution of reporting features, moving towards more sophisticated data analysis and presentation.

#### template/adminlayout.js - *New File*

*   **Purpose:** This JavaScript file likely contains common client-side functionalities and UI interactions for the admin panel layout.
*   **UI Components & Dynamicity:** May include logic for sidebar toggling, modal management, or other global UI behaviors.
*   **Backend Functions:** N/A (client-side script).
*   **Concept Learned:** This emphasizes the importance of separating JavaScript logic into dedicated files for better organization and reusability, especially for common UI patterns across an application.

#### template/dashboardBackend.html - *New File*

*   **Purpose:** This appears to be a new HTML template file specifically for the backend dashboard, potentially used for structuring the admin dashboard content.
*   **UI Components & Dynamicity:** Provides the HTML structure for the admin dashboard, which is then populated dynamically by PHP.
*   **Backend Functions:** N/A (HTML template).
*   **Concept Learned:** This demonstrates the use of separate HTML template files for different sections of an application, promoting modularity and cleaner code by separating presentation from logic.

#### template/layout.html - *New File*

*   **Purpose:** This is likely a new base HTML layout file, providing a consistent structure (header, footer, main content area) for various pages in the application.
*   **UI Components & Dynamicity:** Defines the overall page structure.
*   **Backend Functions:** N/A (HTML template).
*   **Concept Learned:** This highlights the importance of a consistent layout for user experience and the benefits of using a master layout file to avoid code duplication across multiple pages.

#### template/manage-departments.html - *New File*

*   **Purpose:** This is likely an HTML template for the department management interface, providing the structure for the department listing table and potentially add/edit forms.
*   **UI Components & Dynamicity:** Provides the HTML structure for the department management page.
*   **Backend Functions:** N/A (HTML template).
*   **Concept Learned:** Further emphasizes modularity and separation of concerns by having dedicated templates for specific management sections.

#### uploads/ - *New Directory*

*   **Purpose:** This new directory is created to store uploaded files, such as profile pictures.
*   **UI Components & Dynamicity:** N/A (file storage).
*   **Backend Functions:** Used by file upload scripts (e.g., in `profile.php`) to store files.
*   **Concept Learned:** This highlights the necessity of having a dedicated and properly secured directory for user-uploaded content in web applications.


## Summary of Key Learnings from this Update:

This update showcases a significant step towards building a more feature-rich and robust web application. Key concepts reinforced include:

*   **Modularization:** Breaking down functionalities into smaller, dedicated files (e.g., `backend/departments/`, `backend/employee/`, `process_academic.php`).
*   **AJAX for Dynamic Content:** Implementing AJAX endpoints (`get_dept.php`, `get_roles.php`) for fetching data asynchronously and updating UI elements without full page reloads.
*   **Secure Data Handling:** Continued emphasis on password hashing and prepared statements to prevent SQL injection.
*   **Comprehensive User Profiles:** Managing complex user data, including file uploads and multiple related entities (academic, skills, work experience).
*   **Data Table Management:** Implementing pagination and search functionalities for efficient display and navigation of large datasets.
*   **Soft Deletion:** A practical approach to data management that preserves historical records.
*   **UI/UX Improvements:** Enhancements in dashboard metrics, modal interactions, and overall styling for a better user experience.
*   **Template-based Development:** Using separate HTML templates for layouts and specific sections to promote code reusability and maintainability.

This version demonstrates a strong progression in building a more interactive, secure, and manageable PHP application. Keep up the great work!


