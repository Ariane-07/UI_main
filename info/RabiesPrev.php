<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabies Prevention & Control - Philippines</title>
    <link rel="icon" type="image/png" href="../assets/imgs/Logo.png">
    <link href="https://cdn.replit.com/agent/bootstrap-agent-dark-theme.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
    <link href="assets/main.css" rel="stylesheet">
    <style>
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
    }

    /* Icons */
    .feature-icon, .card-icon, .section-icon {
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
        background-color: var(--primary-color);
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
        border: 1px solid rgba(33, 150, 243, 0.2);
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

    .hero-icon {
        width: 64px;
        height: 64px;
        stroke-width: 1.5;
        color: var(--primary-color);
    }

    .section-icon {
        width: 24px;
        height: 24px;
        stroke-width: 2;
        color: var(--primary-color);
    }

    .card-icon {
        width: 32px;
        height: 32px;
        stroke-width: 1.5;
        color: var(--primary-color);
    }

    .feature-icon {
        width: 20px;
        height: 20px;
        stroke-width: 2;
        color: var(--primary-color);
        flex-shrink: 0;
    }

    .back-button,
    .theme-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgb(29 44 69 / 50%);;
        color: white;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, background-color 0.2s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i data-feather="shield" class="me-2"></i>Rabies Prevention</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#understanding"><i class="me-1"></i>Understanding Rabies</a></li>
                    <li class="nav-item"><a class="nav-link" href="#protection"><i class="me-1"></i>Protection</a></li>
                    <li class="nav-item"><a class="nav-link" href="#symptoms"><i class="me-1"></i>Symptoms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pet-care"><i class="me-1"></i>Pet Care</a></li>
                    <li class="nav-item"><a class="nav-link" href="#emergency"><i class="me-1"></i>Emergency</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="hero-content">
                <i data-feather="alert-triangle" class="hero-icon mb-4"></i>
                <h1 class="display-4">Understanding Rabies</h1>
                <p class="lead">A comprehensive guide to rabies prevention and control in the Philippines</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <section id="understanding" class="section">
            <h2><i data-feather="book" class="section-icon me-2"></i>What is Rabies?</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <i data-feather="info" class="card-icon mb-3"></i>
                    <p class="card-text">Rabies is a deadly viral disease that affects the brain and spinal cord. It is almost always fatal once symptoms appear, but it is completely preventable. The virus is typically transmitted through the saliva of infected mammals, most commonly through bites or scratches.</p>
                </div>
            </div>
        </section>

        <section id="protection" class="section">
            <h2><i data-feather="shield" class="section-icon me-2"></i>Protecting Yourself</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="users" class="card-icon mb-3"></i>
                            <h3 class="card-title">Avoid Contact</h3>
                            <p class="card-text">Never approach or handle wild animals, even if they appear sick or injured. Teach children to maintain distance from stray animals.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="activity" class="card-icon mb-3"></i>
                            <h3 class="card-title">Post-Exposure Steps</h3>
                            <p class="card-text">If bitten, wash the wound thoroughly with soap and water for 15 minutes and seek immediate medical attention.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="symptoms" class="section">
            <h2><i data-feather="alert-circle" class="section-icon me-2"></i>Symptoms in Animals</h2>
            <div class="list-group">
                <div class="list-group-item">
                    <i data-feather="alert-triangle" class="feature-icon me-2"></i>
                    <div>
                        <h5>Behavioral Changes</h5>
                        <p class="mb-0">Aggression, excitability, or unusual tameness</p>
                    </div>
                </div>
                <div class="list-group-item">
                    <i data-feather="droplet" class="feature-icon me-2"></i>
                    <div>
                        <h5>Physical Signs</h5>
                        <p class="mb-0">Excessive drooling or foaming at the mouth</p>
                    </div>
                </div>
                <div class="list-group-item">
                    <i data-feather="activity" class="feature-icon me-2"></i>
                    <div>
                        <h5>Neurological Signs</h5>
                        <p class="mb-0">Difficulty swallowing, paralysis, seizures</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="pet-care" class="section">
            <h2><i data-feather="heart" class="section-icon me-2"></i>Pet Care Guidelines</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group feature-list">
                        <li class="list-group-item">
                            <i data-feather="check-circle" class="feature-icon me-2"></i>
                            Regular Vaccination
                        </li>
                        <li class="list-group-item">
                            <i data-feather="eye" class="feature-icon me-2"></i>
                            Supervise Outdoor Activities
                        </li>
                        <li class="list-group-item">
                            <i data-feather="home" class="feature-icon me-2"></i>
                            Secure Your Property
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group feature-list">
                        <li class="list-group-item">
                            <i data-feather="calendar" class="feature-icon me-2"></i>
                            Keep Vaccination Records
                        </li>
                        <li class="list-group-item">
                            <i data-feather="phone" class="feature-icon me-2"></i>
                            Emergency Vet Contacts
                        </li>
                        <li class="list-group-item">
                            <i data-feather="alert-triangle" class="feature-icon me-2"></i>
                            Report Stray Animals
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="emergency" class="section">
            <h2><i data-feather="phone" class="section-icon me-2"></i>Emergency Response</h2>
            <div class="alert alert-info">
                <ul class="reminder-list mb-0">
                    <li><i data-feather="clock" class="me-2"></i>Seek immediate medical attention for animal bites</li>
                    <li><i data-feather="thermometer" class="me-2"></i>Document the incident and symptoms</li>
                    <li><i data-feather="phone-call" class="me-2"></i>Contact animal control for suspicious animals</li>
                    <li><i data-feather="calendar" class="me-2"></i>Follow up with complete PEP treatment</li>
                </ul>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container">
            <p class="text-center mb-0">
                <i data-feather="info" class="me-2"></i>
                Sources: WHO, CDC, and DOH Philippines. For medical emergencies, call emergency services immediately.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="assets/main.js"></script>
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