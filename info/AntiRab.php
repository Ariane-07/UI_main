<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Clinics & Rabies Prevention</title>
    <link href="https://cdn.replit.com/agent/bootstrap-agent-dark-theme.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        outline: none;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    :root {
        --primary-color:  #2c3e50;
        --secondary-color:  #2c3e50;
        --spacing-unit: 2rem;
    }

    /* Base Theme Colors */
    body {
        --text-color: #2c3e50;
        --bg-color: #ffffff;
        --nav-bg: #ffffff;
        --card-bg: #ffffff;
        --border-color: rgba(0, 0, 0, 0.1);
        background-color: var(--bg-color);
        color: var(--text-color);
        line-height: 1.6;
        padding-top: 60px;
    }

    /* Dark Theme Colors */
    body.dark {
        --text-color: #e9ecef;
        --bg-color: #121212;
        --nav-bg: #1e1e1e;
        --card-bg: #1e1e1e;
        --border-color: rgba(255, 255, 255, 0.1);
    }

    /* Navigation */
    .navbar {
        background-color: var(--nav-bg) !important;
        border-bottom: 1px solid var(--border-color);
    }

    .navbar-brand, .nav-link {
        color: var(--text-color) !important;
    }

    .nav-link:hover {
        color: var(--primary-color) !important;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, rgb(0 0 0 / 10%) 0%, rgba(33, 150, 243, 0.2) 100%);
        padding: calc(var(--spacing-unit) * 2) 0;
        margin-bottom: var(--spacing-unit);
        text-align: center;
        border-radius: 0 0 2rem 2rem;
        color: var(--text-color);
    }

    .hero-section .hero-icon {
        width: 80px;
        height: 80px;
        stroke-width: 1.5;
        color: var(--primary-color);
    }

    /* Cards */
    .card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        transition: transform 0.2s, box-shadow 0.2s;
        color: var(--text-color);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: var(--text-color);
    }

    .card-icon {
        width: 32px;
        height: 32px;
        stroke-width: 1.5;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    /* List Groups */
    .list-group-item {
        background-color: var(--card-bg);
        border-color: var(--border-color);
        color: var(--text-color);
    }

    /* Sections */
    .section {
        margin-bottom: var(--spacing-unit);
        padding: var(--spacing-unit) 0;
        border-bottom: 1px solid var(--border-color);
    }

    .section h2 {
        color: var(--text-color);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-icon {
        width: 24px;
        height: 24px;
        stroke-width: 2;
        color: var(--primary-color);
    }

    /* Buttons and Controls */
    .back-button,
    .theme-toggle,
    .sticky-cta {
        background-color: var(--primary-color);
        color: #ffffff;
        border: none;
    }

    .back-button:hover,
    .theme-toggle:hover,
    .sticky-cta:hover {
        background-color: var(--secondary-color);
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* Accordion */
    .accordion-button {
        background-color: var(--card-bg);
        color: var(--text-color);
    }

    .accordion-button:not(.collapsed) {
        background-color:#191b1f;
        color: #ffffff;
    }

    .accordion-body {
        background-color: var(--card-bg);
        color: var(--text-color);
    }

    /* Footer */
    .footer {
        color: #ffffff;
        border-top: 1px solid var(--border-color);
        padding: 10px;
    }

    /* Alerts */
    .alert-info {
        background-color: rgb(24 67 100 / 10%);
        border: 1px solid rgba(33, 150, 243, 0.1);
        color: var(--text-color);
    }

    /* Lists */
    .question-list li,
    .reminder-list li {
        color: var(--text-color);
    }

    /* Top Controls */
    .top-controls {
        position: fixed;
        top: 5rem;
        left: 1rem;
        z-index: 1100;
        display: flex;
        gap: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sticky-cta {
            bottom: 1rem;
            right: 1rem;
            padding: 0.75rem 1.5rem;
        }

        .section {
            padding: 1.5rem 0;
        }

        .hero-section {
            padding: var(--spacing-unit) 0;
        }
    }

    /* Accessibility */
    :focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }

    .back-button,
    .theme-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color:  rgb(29 44 69 / 50%);
        color: white;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, background-color 0.2s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sticky-cta {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        padding: 1rem 2rem;
        border-radius: 2rem;
        background-color: rgb(29 44 69 / 50%);
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .question-list {
        list-style: none;
        padding: 0;
    }

    .question-list li {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    .reminder-list {
        list-style: none;
        padding: 0;
    }

    .reminder-list li {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }

    /* Table Styling */
    .table {
        background-color: var(--card-bg);
        color: var(--text-color);
        border-color: var(--border-color);
    }

    .table th,
    .table td {
        border-color: var(--border-color);
    }

    .table thead th {
        background-color: var(--nav-bg);
        color: var(--text-color);
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05); /* Lighten odd rows in light mode */
    }

    [data-bs-theme="dark"] .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.05); /* Darken odd rows in dark mode */
    }
    </style>
</head>
<body>
   <!-- Back Button and Theme Toggle -->
   <div class="top-controls">
        <a href="javascript:history.back()" class="back-button" aria-label="Back to Information Page">
            <i data-feather="arrow-left"></i>
        </a>
        <button class="theme-toggle" aria-label="Toggle Dark/Light Mode">
            <i data-feather="moon" class="theme-icon-dark"></i>
            <i data-feather="sun" class="theme-icon-light"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i data-feather="book" class="me-2"></i>Anti-Rabies Law</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#prevention">Prevention</a></li>
                    <li class="nav-item"><a class="nav-link" href="#penalties">Penalties</a></li>
                    <li class="nav-item"><a class="nav-link" href="#enforcement">Enforcement</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <i data-feather="book" class="hero-icon mb-4"></i>
            <h1 class="display-4">Rabies Prevention & Control</h1>
            <p class="lead">Understanding the Anti-Rabies Act of 2007 (RA 9482)</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <section id="about" class="section">
            <h2><i data-feather="info" class="section-icon"></i>About the Anti-Rabies Act</h2>
            <p>The Anti-Rabies Act of 2007 (RA 9482) is a crucial law in the Philippines aimed at preventing and controlling rabies. It promotes responsible pet ownership, outlines rabies eradication strategies, and prescribes penalties for violations. Understanding its implementation, enforcement, and impact is essential in achieving rabies eradication.</p>
        </section>

        <section id="prevention" class="section">
            <h2><i data-feather="shield" class="section-icon"></i>Prevention Measures</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="shield" class="card-icon"></i>
                            <h3>Vaccination</h3>
                            <p>Regular vaccination of dogs against rabies is mandatory.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="file-text" class="card-icon"></i>
                            <h3>Registration</h3>
                            <p>All dogs must be registered with local government units.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="lock" class="card-icon"></i>
                            <h3>Restraint</h3>
                            <p>Dogs must be properly restrained when in public places.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="penalties" class="section">
            <h2><i data-feather="alert-triangle" class="section-icon"></i>Penalties for Violations</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Violation</th>
                            <th>Penalty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Failure to Register and Vaccinate Dogs</td>
                            <td>₱2,000 - ₱10,000</td>
                        </tr>
                        <tr>
                            <td>Failure to Keep Dogs Under Restraint</td>
                            <td>₱500 - ₱2,000</td>
                        </tr>
                        <tr>
                            <td>Failure to Report Dog Bite</td>
                            <td>₱3,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="enforcement" class="section">
            <h2><i data-feather="users" class="section-icon"></i>Enforcement of the Law</h2>
            <div class="alert alert-info">
                <p><strong>The following agencies are responsible for enforcing the Anti-Rabies Act:</strong></p>
                <ul class="reminder-list">
                    <li><i data-feather="chevron-right" class="feature-icon me-2"></i><strong>Local Government Units (LGUs):</strong> Implement vaccination campaigns, maintain animal pounds, and enforce rabies control measures.</li>
                    <li><i data-feather="chevron-right" class="feature-icon me-2"></i><strong>Philippine National Police (PNP):</strong> Assist in enforcing the law, particularly in cases of obstruction or violence.</li>
                    <li><i data-feather="chevron-right" class="feature-icon me-2"></i><strong>Department of Agriculture (DA):</strong> Provides technical guidance on rabies control.</li>
                    <li><i data-feather="chevron-right" class="feature-icon me-2"></i><strong>Department of Health (DOH):</strong> Ensures the availability of PEP and educates the public on rabies prevention.</li>
                </ul>
            </div>
            <div class="alert alert-info mt-4">
                <p><strong>The Importance of Reporting Violations:</strong></p>
                <p>Reporting violations of the Anti-Rabies Act helps hold offenders accountable and protect public health. If you witness a violation, report it to your local veterinary office or animal control unit.</p>
            </div>
        </section>
    </main>

    <!-- Sticky CTA Button -->
    <a href="https://paws.org.ph/downloads/ra9482_anti_rabies_act_of_2007.pdf" 
       target="_blank" 
       class="sticky-cta">
        <i data-feather="download" class="me-2"></i>
        Download RA 9482
    </a>

    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container">
            <p class="text-center mb-0">
               For legal details on rabies prevention and pet responsibilities, refer to the Philippine Anti-Rabies Act (RA 9482).
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Feather icons
            feather.replace();

            // Theme Toggle Functionality
            const themeToggle = document.querySelector('.theme-toggle');
            const body = document.body;

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'dark';
            body.classList.toggle('dark', savedTheme === 'dark');

            themeToggle.addEventListener('click', () => {
                body.classList.toggle('dark');
                const newTheme = body.classList.contains('dark') ? 'dark' : 'light';
                localStorage.setItem('theme', newTheme);
            });

            // Smooth scroll for navigation links
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

            // Close mobile menu on link click
            const navLinks = document.querySelectorAll('.nav-link');
            const menuToggle = document.getElementById('navbarNav');
            const bsCollapse = new bootstrap.Collapse(menuToggle, {toggle: false});

            navLinks.forEach((link) => {
                link.addEventListener('click', () => {
                    if (menuToggle.classList.contains('show')) {
                        bsCollapse.toggle();
                    }
                });
            });

            // Show/hide sticky CTA based on scroll position
            const stickyCta = document.querySelector('.sticky-cta');
            let lastScrollPosition = 0;

            window.addEventListener('scroll', () => {
                const currentScrollPosition = window.pageYOffset;

                // Show CTA when scrolling up or when near bottom of page
                if (currentScrollPosition < lastScrollPosition || 
                    (window.innerHeight + currentScrollPosition) >= document.documentElement.scrollHeight - 100) {
                    stickyCta.style.transform = 'translateY(0)';
                    stickyCta.style.opacity = '1';
                } else {
                    stickyCta.style.transform = 'translateY(100px)';
                    stickyCta.style.opacity = '0';
                }

                lastScrollPosition = currentScrollPosition;
            });

            // Add aria-labels for better accessibility
            const backButton = document.querySelector('.back-button');
            const stickyCtaButton = document.querySelector('.sticky-cta');

            if (backButton) {
                backButton.setAttribute('aria-label', 'Go back to previous page');
            }

            if (stickyCtaButton) {
                stickyCtaButton.setAttribute('aria-label', 'Find a veterinary clinic near me');
            }
        });
    </script>
</body>
</html>