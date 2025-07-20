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
    <link rel="stylesheet" href="css/reports.css">
    <script src="js/reports.js"></script>
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navbar.php'; ?>

    <main style="padding: var(--space-8) 0; min-height: calc(100vh - 80px);">
        <div class="container">
            <!-- Page Header -->
            <div style="margin-bottom: var(--space-8);">
                <div
                    style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-4);">
                    <div>
                        <h1 style="margin-bottom: var(--space-2);">Reports & Analytics</h1>
                        <p style="color: var(--gray-600);">
                            Generate detailed reports and analyze performance metrics.
                        </p>
                    </div>
                    <div style="display: flex; gap: var(--space-3);">
                        <select class="form-select" style="width: auto;">
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                            <option>Custom Range</option>
                        </select>
                        <button class="btn btn-primary">
                            <i class="fas fa-download"></i>
                            Export All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Report Categories -->
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="card report-category" data-category="attendance">
                    <div class="card-body" style="text-align: center; cursor: pointer;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--primary-100); color: var(--primary-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-calendar-check" style="font-size: var(--text-2xl);"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">Attendance Reports</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Track attendance
                            patterns, late arrivals, and time-off requests</p>
                    </div>
                </div>

                <div class="card report-category" data-category="performance">
                    <div class="card-body" style="text-align: center; cursor: pointer;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--success-100); color: var(--success-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-chart-line" style="font-size: var(--text-2xl);"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">Performance Reports</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Analyze task completion
                            rates, productivity metrics, and goals</p>
                    </div>
                </div>

                <div class="card report-category" data-category="timesheet">
                    <div class="card-body" style="text-align: center; cursor: pointer;">
                        <div
                            style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--warning-100); color: var(--warning-600); border-radius: var(--radius-xl); margin-bottom: var(--space-4);">
                            <i class="fas fa-clock" style="font-size: var(--text-2xl);"></i>
                        </div>
                        <h3 style="margin-bottom: var(--space-2);">Timesheet Reports</h3>
                        <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Detailed time tracking,
                            overtime analysis, and billing reports</p>
                    </div>
                </div>
            </div>

            
            <!-- Quick Stats -->
            <div style="margin-top: var(--space-8);">
                <div class="grid grid-cols-4 gap-6">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <div
                                style="font-size: var(--text-2xl); font-weight: 600; color: var(--primary-600); margin-bottom: var(--space-2);">
                                24
                            </div>
                            <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Reports Generated
                            </p>
                            <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">This Month</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <div
                                style="font-size: var(--text-2xl); font-weight: 600; color: var(--success-600); margin-bottom: var(--space-2);">
                                156
                            </div>
                            <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Total Downloads</p>
                            <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">All Time</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <div
                                style="font-size: var(--text-2xl); font-weight: 600; color: var(--warning-600); margin-bottom: var(--space-2);">
                                8
                            </div>
                            <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Scheduled Reports
                            </p>
                            <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">Active</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <div
                                style="font-size: var(--text-2xl); font-weight: 600; color: var(--error-600); margin-bottom: var(--space-2);">
                                2.3GB
                            </div>
                            <p style="color: var(--gray-600); margin: 0; font-size: var(--text-sm);">Storage Used</p>
                            <p style="color: var(--gray-500); margin: 0; font-size: var(--text-xs);">Report Archive</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="search-filters">
                <div class="form-group">
                    <input type="text" class="form-input" placeholder="Search documents..." id="searchInput">
                </div>
                <select class="form-input" id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="personal">Personal Documents</option>
                    <option value="contracts">Contracts</option>
                    <option value="policies">Policies</option>
                    <option value="forms">Forms</option>
                    <option value="certificates">Certificates</option>
                </select>
                <select class="form-input" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="draft">Draft</option>
                    <option value="pending">Pending Signature</option>
                    <option value="signed">Signed</option>
                    <option value="expired">Expired</option>
                </select>
                <button class="btn btn-secondary" onclick="toggleBulkActions()">
                    <i class="fas fa-tasks"></i>
                    Bulk Actions
                </button>
            </div>

            <!-- Upload Modal -->
            <div class="modal" id="uploadModal">
                <div class="modal-content" style="max-width: 600px;">
                    <div class="modal-header">
                        <h3>Upload Document</h3>
                        <button class="modal-close" onclick="closeModal('uploadModal')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <div class="upload-zone" id="uploadZone">
                                <i class="fas fa-cloud-upload-alt"
                                    style="font-size: 3rem; color: var(--gray-400); margin-bottom: var(--space-4);"></i>
                                <h4 style="margin-bottom: var(--space-2);">Drop files here or click to browse</h4>
                                <p style="color: var(--gray-600); margin-bottom: var(--space-4);">
                                    Supports PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Max 10MB each)
                                </p>
                                <input type="file" id="fileInput" multiple
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" style="display: none;">
                                <button type="button" class="btn btn-secondary"
                                    onclick="document.getElementById('fileInput').click()">
                                    Choose Files
                                </button>
                            </div>

                            <div id="fileList" style="margin-top: var(--space-4); display: none;">
                                <h5 style="margin-bottom: var(--space-3);">Selected Files:</h5>
                                <div id="selectedFiles"></div>
                            </div>

                            <div class="grid grid-cols-2 gap-4" style="margin-top: var(--space-4);">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-input" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="personal">Personal Documents</option>
                                        <option value="contracts">Contracts</option>
                                        <option value="policies">Policies</option>
                                        <option value="forms">Forms</option>
                                        <option value="certificates">Certificates</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Access Level</label>
                                    <select class="form-input" name="access_level" required>
                                        <option value="private">Private</option>
                                        <option value="team">Team</option>
                                        <option value="department">Department</option>
                                        <option value="company">Company-wide</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-input" name="description" rows="3"
                                    placeholder="Brief description of the document..."></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-checkbox">
                                    <input type="checkbox" name="require_signature">
                                    <span class="checkmark"></span>
                                    Require digital signature
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="form-checkbox">
                                    <input type="checkbox" name="set_expiry">
                                    <span class="checkmark"></span>
                                    Set expiry date
                                </label>
                            </div>

                            <div class="form-group" id="expiryDateGroup" style="display: none;">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" class="form-input" name="expiry_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" onclick="closeModal('uploadModal')">Cancel</button>
                        <button class="btn btn-primary" onclick="uploadDocuments()">
                            <i class="fas fa-upload"></i>
                            Upload Documents
                        </button>
                    </div>
                </div>
            </div>

            <!-- Document Viewer Modal -->
            <div class="modal" id="viewerModal">
                <div class="modal-content" style="max-width: 900px; max-height: 90vh;">
                    <div class="modal-header">
                        <h3 id="viewerTitle">Document Viewer</h3>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-sm btn-secondary" onclick="downloadCurrentDocument()">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-sm btn-secondary" onclick="printCurrentDocument()">
                                <i class="fas fa-print"></i>
                            </button>
                            <button class="modal-close" onclick="closeModal('viewerModal')">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="document-preview" id="documentPreview">
                            <!-- Document content will be loaded here -->
                            <div style="text-align: center; padding: var(--space-8); color: var(--gray-500);">
                                <i class="fas fa-file-alt" style="font-size: 4rem; margin-bottom: var(--space-4);"></i>
                                <p>Document preview will appear here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Version History Modal -->
            <div class="modal" id="versionModal">
                <div class="modal-content" style="max-width: 700px;">
                    <div class="modal-header">
                        <h3>Version History</h3>
                        <button class="modal-close" onclick="closeModal('versionModal')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="version-timeline">
                            <div class="version-item">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--space-2);">
                                    <div>
                                        <h5 style="margin: 0;">Version 2.1 (Current)</h5>
                                        <p style="color: var(--gray-600); font-size: var(--text-sm); margin: 0;">
                                            Updated contract terms and salary structure
                                        </p>
                                    </div>
                                    <span class="badge badge-primary">Current</span>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; font-size: var(--text-sm); color: var(--gray-500);">
                                    <span>By John Smith • Dec 15, 2024 at 2:30 PM</span>
                                    <div style="display: flex; gap: var(--space-2);">
                                        <button class="btn btn-xs btn-secondary"
                                            onclick="viewVersion('2.1')">View</button>
                                        <button class="btn btn-xs btn-secondary"
                                            onclick="downloadVersion('2.1')">Download</button>
                                    </div>
                                </div>
                            </div>

                            <div class="version-item">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--space-2);">
                                    <div>
                                        <h5 style="margin: 0;">Version 2.0</h5>
                                        <p style="color: var(--gray-600); font-size: var(--text-sm); margin: 0;">
                                            Added remote work policy section
                                        </p>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; font-size: var(--text-sm); color: var(--gray-500);">
                                    <span>By Sarah Johnson • Nov 28, 2024 at 10:15 AM</span>
                                    <div style="display: flex; gap: var(--space-2);">
                                        <button class="btn btn-xs btn-secondary"
                                            onclick="viewVersion('2.0')">View</button>
                                        <button class="btn btn-xs btn-secondary"
                                            onclick="downloadVersion('2.0')">Download</button>
                                        <button class="btn btn-xs btn-outline"
                                            onclick="restoreVersion('2.0')">Restore</button>
                                    </div>
                                </div>
                            </div>

                            <div class="version-item">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--space-2);">
                                    <div>
                                        <h5 style="margin: 0;">Version 1.0</h5>
                                        <p style="color: var(--gray-600); font-size: var(--text-sm); margin: 0;">
                                            Initial contract version
                                        </p>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; font-size: var(--text-sm); color: var(--gray-500);">
                                    <span>By HR Department • Oct 15, 2024 at 9:00 AM</span>
                                    <div style="display: flex; gap: var(--space-2);">
                                        <button class="btn btn-xs btn-secondary"
                                            onclick="viewVersion('1.0')">View</button>
                                        <button class="btn btn-xs btn-secondary"
                                            onclick="downloadVersion('1.0')">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Digital Signature Modal -->
            <div class="modal" id="signatureModal">
                <div class="modal-content" style="max-width: 600px;">
                    <div class="modal-header">
                        <h3>Digital Signature</h3>
                        <button class="modal-close" onclick="closeModal('signatureModal')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div style="margin-bottom: var(--space-4);">
                            <h5>Document: Employment Contract v2.1</h5>
                            <p style="color: var(--gray-600);">Please review and sign the document below.</p>
                        </div>

                        <div class="workflow-step completed">
                            <i class="fas fa-check-circle"
                                style="color: var(--success-600); margin-right: var(--space-2);"></i>
                            <div>
                                <strong>Document Review</strong>
                                <div style="font-size: var(--text-sm); color: var(--gray-600);">Completed by John Smith
                                </div>
                            </div>
                        </div>

                        <div class="workflow-step active">
                            <i class="fas fa-signature"
                                style="color: var(--primary-600); margin-right: var(--space-2);"></i>
                            <div>
                                <strong>Employee Signature</strong>
                                <div style="font-size: var(--text-sm); color: var(--gray-600);">Awaiting your signature
                                </div>
                            </div>
                        </div>

                        <div class="workflow-step pending">
                            <i class="fas fa-user-tie"
                                style="color: var(--gray-400); margin-right: var(--space-2);"></i>
                            <div>
                                <strong>HR Approval</strong>
                                <div style="font-size: var(--text-sm); color: var(--gray-600);">Pending employee
                                    signature</div>
                            </div>
                        </div>

                        <div style="margin: var(--space-6) 0;">
                            <label class="form-label">Signature</label>
                            <canvas class="signature-pad" id="signaturePad" width="500" height="200"></canvas>
                            <div style="margin-top: var(--space-2); display: flex; gap: var(--space-2);">
                                <button class="btn btn-sm btn-secondary" onclick="clearSignature()">
                                    <i class="fas fa-eraser"></i>
                                    Clear
                                </button>
                                <button class="btn btn-sm btn-secondary" onclick="uploadSignature()">
                                    <i class="fas fa-upload"></i>
                                    Upload Image
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-checkbox">
                                <input type="checkbox" id="signatureConsent" required>
                                <span class="checkmark"></span>
                                I acknowledge that I have read, understood, and agree to the terms of this document. My
                                digital signature has the same legal effect as a handwritten signature.
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" onclick="closeModal('signatureModal')">Cancel</button>
                        <button class="btn btn-primary" onclick="submitSignature()" id="submitSignatureBtn" disabled>
                            <i class="fas fa-signature"></i>
                            Sign Document
                        </button>
                    </div>
                </div>
            </div>

            <!-- Document Grid -->
            <div class="document-grid" id="documentGrid">
                <!-- Sample Documents -->
                <div class="document-card" data-category="contracts" data-status="signed">
                    <input type="checkbox" class="document-checkbox" style="position: absolute; top: 8px; left: 8px;">
                    <div class="version-badge">v2.1</div>
                    <div class="document-icon pdf">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h4 style="margin-bottom: var(--space-2); font-size: var(--text-base);">Employment Contract</h4>
                    <p style="color: var(--gray-600); font-size: var(--text-sm); margin-bottom: var(--space-3);">
                        Updated employment terms and conditions
                    </p>
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-3);">
                        <span class="signature-status signed">
                            <i class="fas fa-check-circle"></i>
                            Signed
                        </span>
                        <span style="font-size: var(--text-xs); color: var(--gray-500);">2.3 MB</span>
                    </div>
                    <div style="display: flex; gap: var(--space-2);">
                        <button class="btn btn-sm btn-secondary" onclick="viewDocument('contract-001')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="downloadDocument('contract-001')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="viewVersions('contract-001')">
                            <i class="fas fa-history"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="shareDocument('contract-001')">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                </div>

                <div class="document-card" data-category="personal" data-status="pending">
                    <input type="checkbox" class="document-checkbox" style="position: absolute; top: 8px; left: 8px;">
                    <div class="version-badge">v1.0</div>
                    <div class="document-icon img">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <h4 style="margin-bottom: var(--space-2); font-size: var(--text-base);">ID Verification</h4>
                    <p style="color: var(--gray-600); font-size: var(--text-sm); margin-bottom: var(--space-3);">
                        Government issued ID document
                    </p>
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-3);">
                        <span class="signature-status pending">
                            <i class="fas fa-clock"></i>
                            Pending Review
                        </span>
                        <span style="font-size: var(--text-xs); color: var(--gray-500);">1.8 MB</span>
                    </div>
                    <div style="display: flex; gap: var(--space-2);">
                        <button class="btn btn-sm btn-secondary" onclick="viewDocument('id-001')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="downloadDocument('id-001')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="requestSignature('id-001')">
                            <i class="fas fa-signature"></i>
                        </button>
                    </div>
                </div>

                <div class="document-card" data-category="policies" data-status="signed">
                    <input type="checkbox" class="document-checkbox" style="position: absolute; top: 8px; left: 8px;">
                    <div class="version-badge">v3.2</div>
                    <div class="document-icon doc">
                        <i class="fas fa-file-word"></i>
                    </div>
                    <h4 style="margin-bottom: var(--space-2); font-size: var(--text-base);">HR Policy Manual</h4>
                    <p style="color: var(--gray-600); font-size: var(--text-sm); margin-bottom: var(--space-3);">
                        Company policies and procedures
                    </p>
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-3);">
                        <span class="signature-status signed">
                            <i class="fas fa-check-circle"></i>
                            Acknowledged
                        </span>
                        <span style="font-size: var(--text-xs); color: var(--gray-500);">5.7 MB</span>
                    </div>
                    <div style="display: flex; gap: var(--space-2);">
                        <button class="btn btn-sm btn-secondary" onclick="viewDocument('policy-001')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="downloadDocument('policy-001')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="viewVersions('policy-001')">
                            <i class="fas fa-history"></i>
                        </button>
                    </div>
                </div>

                <div class="document-card" data-category="forms" data-status="draft">
                    <input type="checkbox" class="document-checkbox" style="position: absolute; top: 8px; left: 8px;">
                    <div class="version-badge">v1.0</div>
                    <div class="document-icon xls">
                        <i class="fas fa-file-excel"></i>
                    </div>
                    <h4 style="margin-bottom: var(--space-2); font-size: var(--text-base);">Expense Report</h4>
                    <p style="color: var(--gray-600); font-size: var(--text-sm); margin-bottom: var(--space-3);">
                        Monthly expense reimbursement form
                    </p>
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-3);">
                        <span class="signature-status" style="background: var(--gray-100); color: var(--gray-700);">
                            <i class="fas fa-edit"></i>
                            Draft
                        </span>
                        <span style="font-size: var(--text-xs); color: var(--gray-500);">0.9 MB</span>
                    </div>
                    <div style="display: flex; gap: var(--space-2);">
                        <button class="btn btn-sm btn-primary" onclick="editDocument('expense-001')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="submitForReview('expense-001')">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

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

</body>

</html>