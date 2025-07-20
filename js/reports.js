
// Global variables
let selectedDocuments = [];
let signaturePad;

// Initialize page
document.addEventListener('DOMContentLoaded', function () {
    initializeEventListeners();
    initializeSignaturePad();
    loadDocuments();
});

function initializeEventListeners() {
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', filterDocuments);
    document.getElementById('categoryFilter').addEventListener('change', filterDocuments);
    document.getElementById('statusFilter').addEventListener('change', filterDocuments);

    // File upload
    const fileInput = document.getElementById('fileInput');
    const uploadZone = document.getElementById('uploadZone');

    fileInput.addEventListener('change', handleFileSelect);
    uploadZone.addEventListener('click', () => fileInput.click());
    uploadZone.addEventListener('dragover', handleDragOver);
    uploadZone.addEventListener('drop', handleFileDrop);

    // Expiry date toggle
    document.querySelector('input[name="set_expiry"]').addEventListener('change', function () {
        document.getElementById('expiryDateGroup').style.display = this.checked ? 'block' : 'none';
    });

    // Signature consent
    document.getElementById('signatureConsent').addEventListener('change', function () {
        document.getElementById('submitSignatureBtn').disabled = !this.checked;
    });

    // Document checkboxes
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('document-checkbox')) {
            updateSelectedDocuments();
        }
    });
}

function initializeSignaturePad() {
    const canvas = document.getElementById('signaturePad');
    if (canvas) {
        signaturePad = new SignaturePad(canvas);
    }
}

// Document Management Functions
function loadDocuments() {
    // This would typically load documents from the server
    console.log('Loading documents...');
}

function filterDocuments() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;

    const documents = document.querySelectorAll('.document-card');

    documents.forEach(doc => {
        const title = doc.querySelector('h4').textContent.toLowerCase();
        const category = doc.dataset.category;
        const status = doc.dataset.status;

        const matchesSearch = title.includes(searchTerm);
        const matchesCategory = !categoryFilter || category === categoryFilter;
        const matchesStatus = !statusFilter || status === statusFilter;

        doc.style.display = matchesSearch && matchesCategory && matchesStatus ? 'block' : 'none';
    });
}

// File Upload Functions
function handleFileSelect(e) {
    displaySelectedFiles(e.target.files);
}

function handleDragOver(e) {
    e.preventDefault();
    e.currentTarget.classList.add('dragover');
}

function handleFileDrop(e) {
    e.preventDefault();
    e.currentTarget.classList.remove('dragover');
    displaySelectedFiles(e.dataTransfer.files);
}

function displaySelectedFiles(files) {
    const fileList = document.getElementById('fileList');
    const selectedFiles = document.getElementById('selectedFiles');

    if (files.length > 0) {
        fileList.style.display = 'block';
        selectedFiles.innerHTML = '';

        Array.from(files).forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.style.cssText = 'display: flex; justify-content: space-between; align-items: center; padding: 8px; border: 1px solid var(--gray-200); border-radius: 4px; margin-bottom: 8px;';

            fileItem.innerHTML = `
                        <div>
                            <strong>${file.name}</strong>
                            <span style="color: var(--gray-600); font-size: var(--text-sm);"> (${formatFileSize(file.size)})</span>
                        </div>
                        <button type="button" class="btn btn-xs btn-danger" onclick="removeFile(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    `;

            selectedFiles.appendChild(fileItem);
        });
    } else {
        fileList.style.display = 'none';
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function removeFile(index) {
    // Implementation to remove file from selection
    console.log('Removing file at index:', index);
}

function uploadDocuments() {
    const form = document.getElementById('uploadForm');
    const formData = new FormData(form);

    // Add files to form data
    const fileInput = document.getElementById('fileInput');
    Array.from(fileInput.files).forEach(file => {
        formData.append('documents[]', file);
    });

    // Simulate upload process
    console.log('Uploading documents...');

    // Show progress or success message
    alert('Documents uploaded successfully!');
    closeModal('uploadModal');

    // Reload documents
    loadDocuments();
}

// Document Actions
function viewDocument(documentId) {
    document.getElementById('viewerTitle').textContent = `Viewing: ${documentId}`;
    openModal('viewerModal');

    // Load document content
    console.log('Loading document:', documentId);
}

function downloadDocument(documentId) {
    console.log('Downloading document:', documentId);
    // Implement download functionality
}

function shareDocument(documentId) {
    console.log('Sharing document:', documentId);
    // Implement share functionality
}

function viewVersions(documentId) {
    openModal('versionModal');
    console.log('Loading version history for:', documentId);
}

function editDocument(documentId) {
    console.log('Editing document:', documentId);
    // Implement edit functionality
}

function submitForReview(documentId) {
    console.log('Submitting document for review:', documentId);
    // Implement review submission
}

function requestSignature(documentId) {
    openModal('signatureModal');
    console.log('Requesting signature for:', documentId);
}

// Version Control Functions
function viewVersion(version) {
    console.log('Viewing version:', version);
}

function downloadVersion(version) {
    console.log('Downloading version:', version);
}

function restoreVersion(version) {
    if (confirm(`Are you sure you want to restore version ${version}? This will create a new version.`)) {
        console.log('Restoring version:', version);
    }
}

// Digital Signature Functions
function clearSignature() {
    if (signaturePad) {
        signaturePad.clear();
    }
}

function uploadSignature() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Load signature image
                console.log('Signature image uploaded');
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
}

function submitSignature() {
    if (signaturePad && !signaturePad.isEmpty()) {
        const signatureData = signaturePad.toDataURL();
        console.log('Submitting signature...');

        // Simulate signature submission
        alert('Document signed successfully!');
        closeModal('signatureModal');
    } else {
        alert('Please provide a signature before submitting.');
    }
}

// Template Functions
function openTemplateModal() {
    openModal('templateModal');
}

function useTemplate(templateId) {
    console.log('Using template:', templateId);
    closeModal('templateModal');
    openModal('uploadModal');
}

// Bulk Actions
function toggleBulkActions() {
    const panel = document.getElementById('bulkActionsPanel');
    panel.classList.toggle('show');
}

function updateSelectedDocuments() {
    const checkboxes = document.querySelectorAll('.document-checkbox:checked');
    selectedDocuments = Array.from(checkboxes).map(cb => cb.closest('.document-card'));

    document.getElementById('selectedCount').textContent = selectedDocuments.length;

    if (selectedDocuments.length === 0) {
        document.getElementById('bulkActionsPanel').classList.remove('show');
    }
}

function bulkDownload() {
    console.log('Bulk downloading:', selectedDocuments.length, 'documents');
}

function bulkMove() {
    console.log('Bulk moving:', selectedDocuments.length, 'documents');
}

function bulkShare() {
    console.log('Bulk sharing:', selectedDocuments.length, 'documents');
}

function bulkDelete() {
    if (confirm(`Are you sure you want to delete ${selectedDocuments.length} documents?`)) {
        console.log('Bulk deleting:', selectedDocuments.length, 'documents');
    }
}

// Utility Functions
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function downloadCurrentDocument() {
    console.log('Downloading current document');
}

function printCurrentDocument() {
    window.print();
}

// Simple SignaturePad implementation (replace with actual library)
class SignaturePad {
    constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.drawing = false;
        this.isEmpty = true;

        this.setupEventListeners();
    }

    setupEventListeners() {
        this.canvas.addEventListener('mousedown', (e) => this.startDrawing(e));
        this.canvas.addEventListener('mousemove', (e) => this.draw(e));
        this.canvas.addEventListener('mouseup', () => this.stopDrawing());
        this.canvas.addEventListener('mouseout', () => this.stopDrawing());
    }

    startDrawing(e) {
        this.drawing = true;
        this.isEmpty = false;
        const rect = this.canvas.getBoundingClientRect();
        this.ctx.beginPath();
        this.ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    }

    draw(e) {
        if (!this.drawing) return;
        const rect = this.canvas.getBoundingClientRect();
        this.ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
        this.ctx.stroke();
    }

    stopDrawing() {
        this.drawing = false;
    }

    clear() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.isEmpty = true;
    }

    toDataURL() {
        return this.canvas.toDataURL();
    }
}
