<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Portal - Professional Workforce Management</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/design-system.css">
  <link rel="stylesheet" href="css/components.css">
</head>
<body>
  <!-- Navigation -->
  <?php include 'includes/navbar.php';?>

  
  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Professional Workforce Management Solution</h1>
      <p>Streamline your HR processes with our comprehensive employee portal. Manage records, track performance, and enhance productivity with enterprise-grade tools.</p>
      <?php if (!isset($_SESSION['firstName'])){
      ?>
      <div class="hero-actions">
        <a href="register.php" class="btn btn-lg" style="background: white; color: var(--primary-600);">
          <i class="fas fa-user-plus"></i>
          Register Employee
        </a>
        <a href="login.php" class="btn btn-lg btn-outline" style="border-color: white; color: white;">
          <i class="fas fa-sign-in-alt"></i>
          Employee Login
        </a>
      </div>
      <?php } ?>
    </div>
</section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="container">
      <div class="text-center mb-16">
        <h2 class="mb-4">Comprehensive HR Management</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Our platform provides all the tools you need to manage your workforce efficiently and professionally.
        </p>
      </div>
      
      <div class="grid grid-cols-3 gap-8">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <h3>Secure Authentication</h3>
          <p>Multi-role authentication system with encrypted password storage and secure session management.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-users-cog"></i>
          </div>
          <h3>Employee Management</h3>
          <p>Comprehensive employee database with role-based access control and department organization.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <h3>Analytics Dashboard</h3>
          <p>Real-time insights into workforce metrics, performance tracking, and detailed reporting.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h3>Time Management</h3>
          <p>Advanced time tracking, attendance monitoring, and automated scheduling systems.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Data Security</h3>
          <p>Enterprise-grade security with encrypted data storage and compliance with industry standards.</p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-mobile-alt"></i>
          </div>
          <h3>Mobile Responsive</h3>
          <p>Fully responsive design that works seamlessly across all devices and screen sizes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section style="background: var(--gray-100); padding: var(--space-20) 0;">
    <div class="container text-center">
      <h2 class="mb-4">Ready to Get Started?</h2>
      <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
        Join thousands of organizations that trust our platform for their workforce management needs.
      </p>
      
      <div class="flex gap-4 justify-center">
        <a href="register.php" class="btn btn-primary btn-lg">
          <i class="fas fa-rocket"></i>
          Start Free Trial
        </a>
        <a href="#contact" class="btn btn-secondary btn-lg">
          <i class="fas fa-phone"></i>
          Contact Sales
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <script>
    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => alert.remove(), 500);
      });
    }, 3000);

    // Mobile navigation toggle
    document.querySelector('.navbar-mobile-toggle')?.addEventListener('click', function() {
      const nav = document.querySelector('.navbar-nav');
      nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
</body>
</html>
