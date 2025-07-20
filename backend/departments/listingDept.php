<?php
require_once '..\..\includes\config.php';

// Pagination
$limit = 5;
$myPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($myPage < 1)
    $myPage = 1;
$offset = ($myPage - 1) * $limit;

// Department Table Data retrieval
try {
    $sql = "SELECT department.id, department.name AS deptName, department.status AS deptStatus, COUNT(employee.id) AS employee_count FROM  department LEFT JOIN  employee ON  department.id = employee.department WHERE department.is_deleted = '0' GROUP BY  department.id, department.name ORDER BY  department.name LIMIT :limit OFFSET :offset";
    // $params = [];
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>" ;print_r($departments);die;
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
    $departments = [];
}

// Count and total rows retrieval
$stmt2 = $conn->query("SELECT COUNT(*) as count FROM department WHERE is_deleted = '0'");
$count = $stmt2->fetch(PDO::FETCH_ASSOC);
$allRows = $count['count'];
$allPages = ceil($allRows / $limit);

?>


<style>
    /* Modal styles */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        z-index: 1000;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: var(--radius-lg);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .modal-header h3 {
        margin: 0;
        font-size: var(--text-xl);
    }

    .modal-close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        background: none;
        border: none;
        cursor: pointer;
    }

    .modal-close:hover,
    .modal-close:focus {
        color: black;
        text-decoration: none;
    }

    .modal-body {
        padding-top: 1rem;
    }

    .modal-body p {
        margin-bottom: 0.5rem;
    }
</style>

<body class="admin-page">
    <!-- Include Navbar -->
    <?php include '..\navbar.php'; ?>

    <!-- Include Sidebar -->
    <?php include '..\sidebar.php' ?>


    <!-- Main Content -->
    <main class="admin-main-content">
        <div class="admin-container">
            <!-- Page Header -->
            <div class="admin-page-header">
                <div class="header-title">
                    <h1>Department Management</h1>
                    <p>Manage all departments in the organization</p>
                </div>
                <div class="header-actions">
                    <!-- <button class="btn btn-primary" onclick="showAddDepartmentModal()">
                        <i class="fas fa-plus"></i> Add Department
                    </button> -->
                </div>
            </div>

            <!-- Department Table -->
            <div class="admin-table-container">
                <div class="table-header">
                    <div class="table-title">
                        <h2>All Departments</h2>
                        <p>Enlisted data of <?php echo $count['count']; ?> Departments</p>
                    </div>
                    <!-- <div class="table-actions">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search departments...">
                        </div>
                    </div> -->
                </div>

                <?php if (count($departments) > 0): ?>
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">
                                        Department</th>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">
                                        Employee</th>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">
                                        Status</th>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">
                                        Actions</th>
                                </tr>
                            </thead>
                            <?php

                            if (isset($_POST['currentStatus'])) {
                                if ($_POST['currentStatus'] == 1) {
                                    $newStatus = '0';
                                } else {
                                    $newStatus = '1';
                                }
                                $stmt = $conn->prepare("UPDATE department SET status = :newStatus WHERE id = :id");
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
                            ?>
                            <tbody>
                                <?php
                                foreach ($departments as $dept): ?>
                                    <tr>
                                        <!-- Department -->
                                        <td>
                                            <span
                                                style="display: inline-flex; align-items: center; padding: var(--space-2) var(--space-3); background: var(--primary-100); color: var(--gray-900); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                                                <?php echo htmlspecialchars($dept['deptName']); ?>
                                            </span>
                                        </td>

                                        <!-- Employees -->
                                        <td>
                                            <span
                                                style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-1) var(--space-3); background: var(--primary-100); color: var(--primary-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                                                <?php echo htmlspecialchars($dept['employee_count']); ?>
                                            </span>
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <div class="action-buttons">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?= $dept['id'] ?>">
                                                    <input type="hidden" name="currentStatus"
                                                        value="<?= $dept['deptStatus']; ?>">
                                                    <?php if ($dept['deptStatus'] == '1') { ?>
                                                        <button class="btn btn-sm success"
                                                            style="background-color: green; font-weight: 900; color: var(--success-50); font-size: var(--text-xs);">Active</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-sm danger"
                                                            style="background-color: red; font-weight: 900; color: var(--success-50); font-size: var(--text-xs);">Inactive</button>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn view-dept-btn" title="View"
                                                    data-id="<?= $dept['id'] ?>">
                                                    <i class="fas fa-eye"></i>
                                                    <p id="gone"></p>
                                                </button>
                                                <button class="action-btn edit" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn delete" title="Delete Department"
                                                    onclick="softDeleteDepartment(<?php echo $dept['id']; ?>, this)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>No departments found.</p>
                <?php endif; ?>

                <div class="table-footer">
                    <div class="table-pagination">
                        <?php if ($myPage > 1): ?>
                            <a href="?page=<?= $myPage - 1 ?>" class="pagination-btn"><i
                                    class="fas fa-chevron-left"></i></a>
                        <?php else: ?>
                            <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i></button>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $allPages; $i++): ?>
                            <?php if ($i == $myPage): ?>
                                <button class="pagination-btn active"><?= $i ?></button>
                            <?php else: ?>
                                <a href="?page=<?= $i ?>" class="pagination-btn"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($myPage < $allPages): ?>
                            <a href="?page=<?= $myPage + 1 ?>" class="pagination-btn"><i
                                    class="fas fa-chevron-right"></i></a>
                        <?php else: ?>
                            <button class="pagination-btn" disabled><i class="fas fa-chevron-right"></i></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../footer.php'; ?>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-close {
            cursor: pointer;
            font-size: 24px;
        }
    </style>



    <!-- View Department Modal -->
    <div id="viewDepartmentModal" class="modal">
        <div class="modal-content rounded-md shadow-lg max-w-md mx-auto bg-white">
            <div class="modal-header flex items-center justify-between border-b pb-2 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-building text-blue-500 mr-2"></i> Department Details
                </h3>
                <button class="modal-close text-gray-600 hover:text-red-600 text-2xl leading-none"
                    id="closeViewModalBtn">&times;</button>
            </div>

            <div class="modal-body space-y-3 text-sm text-gray-700">
                <p><strong>Department Name:</strong> <span id="viewDeptName" class="text-gray-900 font-medium"></span>
                </p>
                <p><strong>Employee Count:</strong> <span id="viewEmployeeCount"
                        class="text-gray-900 font-medium"></span></p>
                <p>
                    <strong>Status:</strong>
                    <span id="viewDeptStatus" class="inline-block px-2 py-1 rounded-full text-xs font-semibold"></span>
                </p>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Getting the full modal and its close button
            const viewModal = document.getElementById('viewDepartmentModal');
            const closeModalBtn = document.getElementById('closeViewModalBtn');

            // Function to show the modal
            function showViewDepartmentModal() {
                viewModal.style.display = 'flex';
            }

            // Function to hide the modal
            function hideViewDepartmentModal() {
                viewModal.style.display = 'none';
            }

            // Adding click listners to hide the modal
            closeModalBtn.addEventListener('click', hideViewDepartmentModal);
            window.addEventListener('click', function (event) {
                if (event.target === viewModal) {
                    hideViewDepartmentModal();
                }
            })

            // Finding all of the view buttons present in the page and adding the functionality for all
            const viewBtns = document.querySelectorAll('.view-dept-btn');

            viewBtns.forEach(button => {
                button.addEventListener('click', function () {
                    // This is how we get the dpartment Id from any view button present on the page
                    const departmentId = this.getAttribute('data-id');

                    // This has to be sent to AJAX so that department information could be fetched.

                    $.ajax({
                        url: 'get_dept.php',
                        type: 'GET',
                        data: {
                            deptId: departmentId
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            if (response.error) {
                                alert("Could not fetch department details" + response.error);
                                return;
                            }
                            document.getElementById('viewDeptName').textContent = response.deptName;
                            document.getElementById('viewEmployeeCount').textContent = response.employee_count;

                            if (response.deptStatus == '1') {
                                document.getElementById('viewDeptStatus').textContent = 'Active';
                            } else {
                                document.getElementById('viewDeptStatus').textContent = 'Inactive';
                            }

                            // Showing populated Modal
                            showViewDepartmentModal();
                        },
                        error: function (xhr, status, error) {
                            alert("An error occurred while trying to contact the server.");
                        }
                    });
                    // And after that we show the modal.
                    showViewDepartmentModal();
                })
            })
        })
    </script>

    <script>
        function softDeleteDepartment(deptId, buttonElement) {
            if (!confirm('Are you sure you want to delete this department?')) return;

            var $btn = $(buttonElement);
            var originalHTML = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin"></i>');
            $btn.prop('disabled', true);

            $.ajax({
                url: 'soft_delete_department.php',
                type: 'POST',
                data: {
                    id: deptId
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        const $row = $btn.closest('tr');
                        $row.css('opacity', '0.5');
                        setTimeout(() => {
                            $row.remove();
                            if ($('tbody tr').length === 0) {
                                location.reload(); // Show empty state if last row
                            }
                        }, 500);
                    } else {
                        alert('Error: ' + (response.message || 'Failed to delete department'));
                        $btn.html(originalHTML).prop('disabled', false);
                    }
                },
                error: function () {
                    alert('AJAX error occurred');
                    $btn.html(originalHTML).prop('disabled', false);
                }
            });
        }
    </script>



</body>

</html>