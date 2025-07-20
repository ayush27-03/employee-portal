<?php
require_once '..\..\includes\config.php';

// Pagination
$limit = 10;
$myPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($myPage < 1)
    $myPage = 1;
$offset = ($myPage - 1) * $limit;

// Roles Table Data retrieval
try {
    $sql = "SELECT roles.id, roles.name AS roleName, roles.description AS roleDesc, roles.status AS roleStatus, COUNT(employee.id) AS employee_count FROM roles LEFT JOIN employee ON roles.id = employee.role GROUP BY roles.id, roles.name ORDER BY roles.name LIMIT :limit OFFSET :offset;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
    $roles = [];
}

// Count retrieval
$stmt2 = $conn->query("SELECT COUNT(*) as count FROM roles");
$count = $stmt2->fetch(PDO::FETCH_ASSOC);
$allRows = $count['count'];
$allPages = ceil($allRows / $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Roles & Permissions</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="..\..\css\design-system.css">
    <link rel="stylesheet" href="..\..\css\components.css">
    <link rel="stylesheet" href="..\..\css\adminpanel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

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
                    <h1>Roles & Permissions</h1>
                    <p>Manage system roles and their permissions</p>
                </div>
                <div class="header-actions">
                    <!-- <button class="btn btn-primary" onclick="showAddRoleModal()">
                        <i class="fas fa-plus"></i> Add Role
                    </button> -->
                </div>
            </div>

            <!-- Roles Table -->
            <div class="admin-table-container">
                <div class="table-header">
                    <div class="table-title">
                        <h2>System Roles</h2>
                        <p>Enlisted data of <?php echo $count['count']; ?> Roles</p>
                    </div>
                    <div class="table-actions">
                        <!-- <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search roles...">
                        </div> -->
                    </div>
                </div>

                <?php if (count($roles) > 0): ?>
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">Role
                                    </th>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">
                                        Employee</th>
                                    <th style="font-weight: 900; color: var(--primary-900); font-size: var(--text-sm);">
                                        Description</th>
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
                                $stmt = $conn->prepare("UPDATE roles SET status = :newStatus WHERE id = :id");
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
                                <?php foreach ($roles as $role): ?>
                                    <tr>
                                        <td>
                                            <span
                                                style="display: inline-flex; align-items: center; padding: var(--space-2) var(--space-3); background: var(--primary-100); color: var(--gray-900); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                                                <?php echo htmlspecialchars($role['roleName']); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                style="display: inline-flex; align-items: center; gap: var(--space-2); padding: var(--space-1) var(--space-3); background: var(--primary-100); color: var(--primary-700); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 900;">
                                                <?php echo htmlspecialchars($role['employee_count']); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?php echo htmlspecialchars($role['roleDesc']); ?>
                                        </td>

                                        <td>
                                            <div class="action-buttons">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?= $role['id']; ?>">
                                                    <input type="hidden" name="currentStatus"
                                                        value="<?= $role['roleStatus']; ?>">
                                                    <?php if ($role['roleStatus'] == '1') { ?>
                                                        <button class="btn btn-sm success"
                                                            style="background-color: green;">Active</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-sm danger"
                                                            style="background-color: red;">Inactive</button>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn view-role-btn" title="View"
                                                    data-id="<?= $role['id'] ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn edit" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn delete" title="Delete Role"
                                                    onclick="softDeleteRole(<?php echo $role['id']; ?>, this)">
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
                    <p>No roles found.</p>
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

     <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <!-- View Role Modal -->
    <div id="viewRoleModal" class="modal">
        <div class="modal-content rounded-md shadow-lg max-w-md mx-auto bg-white">
            <div class="modal-header flex items-center justify-between border-b pb-2 mb-4">
                <h3 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-user-shield text-blue-500 mr-2"></i> Role Details
                </h3>
                <button class="modal-close text-gray-600 hover:text-red-600 text-2xl leading-none"
                    id="closeViewRoleModalBtn">&times;</button>
            </div>

            <div class="modal-body space-y-3 text-sm text-gray-700">
                <p><strong>Role ID:</strong> <span id="viewRoleId" class="text-gray-900 font-medium"></span></p>
                <p><strong>Role Name:</strong> <span id="viewRoleName" class="text-gray-900 font-medium"></span></p>
                <p><strong>Description:</strong> <span id="viewRoleDescription"
                        class="text-gray-900 font-medium"></span></p>
                <p><strong>Employee Count:</strong> <span id="viewEmployeeCount"
                        class="text-gray-900 font-medium"></span></p>
                <p>
                    <strong>Status:</strong>
                    <span id="viewRoleStatus" class="inline-block px-2 py-1 rounded-full text-xs font-semibold"></span>
                </p>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function softDeleteRole(roleId, buttonElement) {
            if (!confirm('Are you sure you want to delete this role?')) return;

            var $btn = $(buttonElement);
            var originalHTML = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-spin"></i>');
            $btn.prop('disabled', true);

            $.ajax({
                url: 'soft_delete_roles.php',
                type: 'POST',
                data: { id: roleId },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        const $row = $btn.closest('tr');
                        $row.css('opacity', '0.5');
                        setTimeout(() => {
                            $row.remove();
                            if ($('tbody tr').length === 0) {
                                location.reload();
                            }
                        }, 500);
                    } else {
                        alert('Error: ' + (response.message || 'Failed to delete role'));
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewRoleModal = document.getElementById('viewRoleModal');
            const closeRoleModalBtn = document.getElementById('closeViewRoleModalBtn');

            function showViewRoleModal() {
                viewRoleModal.style.display = 'flex';
            }

            function hideViewRoleModal() {
                viewRoleModal.style.display = 'none';
            }

            closeRoleModalBtn.addEventListener('click', hideViewRoleModal);
            window.addEventListener('click', function (event) {
                if (event.target === viewRoleModal) {
                    hideViewRoleModal();
                }
            });

            const viewRoleBtns = document.querySelectorAll('.view-role-btn');

            viewRoleBtns.forEach(button => {
                button.addEventListener('click', function () {
                    const roleId = this.getAttribute('data-id');

                    // Show modal immediately
                    showViewRoleModal();

                    // Set loading state
                    document.getElementById('viewRoleId').textContent = 'Loading...';
                    document.getElementById('viewRoleName').textContent = 'Loading...';
                    document.getElementById('viewRoleDescription').textContent = 'Loading...';
                    document.getElementById('viewRoleStatus').textContent = 'Loading...';
                    document.getElementById('viewEmployeeCount').textContent = 'Loading...';

                    $.ajax({
                        url: 'get_roles.php',
                        type: 'GET',
                        data: { roleId: roleId },
                        dataType: 'JSON',
                        success: function (response) {
                            if (response.error) {
                                alert("Could not fetch role details: " + response.error);
                                hideViewRoleModal();
                                return;
                            }

                            // Populate modal fields
                            document.getElementById('viewRoleId').textContent = response.id;
                            document.getElementById('viewRoleName').textContent = response.roleName;
                            document.getElementById('viewRoleDescription').textContent = response.roleDescription;
                            document.getElementById('viewEmployeeCount').textContent = response.employee_count;

                            // Update status display
                            const statusSpan = document.getElementById('viewRoleStatus');
                            statusSpan.textContent = response.roleStatus == '1' ? 'Active' : 'Inactive';
                            statusSpan.className = response.roleStatus == '1'
                                ? 'bg-green-100 text-green-700 inline-block px-2 py-1 rounded-full text-xs font-semibold'
                                : 'bg-red-100 text-red-700 inline-block px-2 py-1 rounded-full text-xs font-semibold';
                        },
                        error: function () {
                            alert("An error occurred while trying to contact the server.");
                            hideViewRoleModal();
                        }
                    });
                });
            });
        });
    </script>



</body>

</html>