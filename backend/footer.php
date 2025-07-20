<?php
// footer.php - Admin Panel Footer
?>
<footer class="admin-footer">
    <div class="footer-content">
        <div class="footer-copyright">
            <p>&copy; <?php echo date('Y'); ?> Employee Management System. All rights reserved.</p>
        </div>
        <div class="footer-links">
            <a href="#" class="text-gray-500 hover:text-primary-600 transition-colors">
                <i class="fas fa-question-circle"></i> Help Center
            </a>
            <a href="#" class="text-gray-500 hover:text-primary-600 transition-colors">
                <i class="fas fa-shield-alt"></i> Privacy Policy
            </a>
            <a href="#" class="text-gray-500 hover:text-primary-600 transition-colors">
                <i class="fas fa-file-alt"></i> Terms of Service
            </a>
        </div>
        <div class="footer-version">
            <span class="text-gray-500">v1.0.0</span>
        </div>
    </div>
</footer>

<style>
.admin-footer {
    background-color: white;
    border-top: 1px solid var(--gray-200);
    padding: 1rem 1.5rem;
    margin-left: 250px;
    transition: margin 0.3s ease;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
    font-size: var(--text-sm);
}

.footer-links {
    display: flex;
    gap: var(--space-4);
}

.footer-links a {
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

@media (max-width: 768px) {
    .admin-footer {
        margin-left: 0;
    }
    
    .footer-content {
        flex-direction: column;
        gap: var(--space-3);
        text-align: center;
    }
    
    .footer-links {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>