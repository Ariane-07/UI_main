<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Clinics & Rabies Prevention</title>
    <link href="https://cdn.replit.com/agent/bootstrap-agent-dark-theme.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
    <link href="assets/main.css" rel="stylesheet">
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
            <a class="navbar-brand" href="#"><i data-feather="heart" class="me-2"></i>Veterinary Clinics</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#key-roles"><i class="me-1"></i>Key Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#find-clinics"><i class="me-1"></i>Find Clinics</a></li>
                    <li class="nav-item"><a class="nav-link" href="#what-to-look"><i class="me-1"></i>What to Look For</a></li>
                    <li class="nav-item"><a class="nav-link" href="#questions"><i class="me-1"></i>Questions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reminders"><i class="me-1"></i>Reminders</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="hero-content">
                <i data-feather="shield" class="hero-icon mb-4"></i>
                <h1 class="display-4">Veterinary Clinics in the Philippines</h1>
                <p class="lead">Essential information about rabies prevention and control through veterinary services</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <section id="key-roles" class="section">
            <h2><i data-feather="award" class="section-icon me-2"></i>Key Roles of Veterinary Clinics in Rabies Control</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="activity" class="card-icon mb-3"></i>
                            <h3 class="card-title">Rabies Vaccination</h3>
                            <p class="card-text">Regular vaccinations for dogs and cats following established protocols.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="plus-circle" class="card-icon mb-3"></i>
                            <h3 class="card-title">Animal Bite Management</h3>
                            <p class="card-text">Professional assessment and advice for animal bites and exposure risks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i data-feather="info" class="card-icon mb-3"></i>
                            <h3 class="card-title">PEP Guidance</h3>
                            <p class="card-text">Direction on when and where to seek Post-Exposure Prophylaxis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="find-clinics" class="section">
            <h2><i data-feather="map" class="section-icon me-2"></i>How to Find Veterinary Clinics</h2>
            <div class="list-group">
                <div class="list-group-item">
                    <i data-feather="search" class="feature-icon me-2"></i>
                    <div>
                        <h5>Online Search</h5>
                        <p class="mb-0">Use search engines with terms like "Veterinary clinic [Your City/Municipality]"</p>
                    </div>
                </div>
                <div class="list-group-item">
                    <i data-feather="map-pin" class="feature-icon me-2"></i>
                    <div>
                        <h5>Google Maps</h5>
                        <p class="mb-0">Search nearby clinics and filter by location and ratings</p>
                    </div>
                </div>
                <div class="list-group-item">
                    <i data-feather="home" class="feature-icon me-2"></i>
                    <div>
                        <h5>Local Government Units</h5>
                        <p class="mb-0">Check with your city or municipal government for registered clinics</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="what-to-look" class="section">
            <h2><i data-feather="check-square" class="section-icon me-2"></i>What to Look For in a Veterinary Clinic</h2>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group feature-list">
                        <li class="list-group-item">
                            <i data-feather="user-check" class="feature-icon me-2"></i>
                            Licensed Veterinarians
                        </li>
                        <li class="list-group-item">
                            <i data-feather="home" class="feature-icon me-2"></i>
                            Clean and Well-Maintained Facilities
                        </li>
                        <li class="list-group-item">
                            <i data-feather="star" class="feature-icon me-2"></i>
                            Positive Reviews and Reputation
                        </li>
                        <li class="list-group-item">
                            <i data-feather="package" class="feature-icon me-2"></i>
                            Comprehensive Services
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group feature-list">
                        <li class="list-group-item">
                            <i data-feather="map-pin" class="feature-icon me-2"></i>
                            Convenient Location and Hours
                        </li>
                        <li class="list-group-item">
                            <i data-feather="dollar-sign" class="feature-icon me-2"></i>
                            Affordable Prices
                        </li>
                        <li class="list-group-item">
                            <i data-feather="message-circle" class="feature-icon me-2"></i>
                            Good Communication
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="questions" class="section">
            <h2><i data-feather="help-circle" class="section-icon me-2"></i>Questions to Ask the Veterinary Clinic</h2>
            <div class="accordion" id="questionsAccordion">
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                            <i data-feather="clipboard" class="me-2"></i>
                            Licensing and Vaccinations
                        </button>
                    </h3>
                    <div id="q1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <ul class="question-list">
                               <li>Are you licensed to administer rabies vaccinations?</li>
                                <li>What type of rabies vaccine do you use?</li>
                                <li>How often should my pet be vaccinated?</li>
                                <li>What is the cost of the rabies vaccination?</li>
                                <li>Do you provide animal bite management advice?</li>
                                <li>What should I do if my pet bites someone?</li>
                                <li>What are your hours of operation?</li>
                                <li>Do you offer emergency services?</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="reminders" class="section">
            <h2><i data-feather="bell" class="section-icon me-2"></i>Key Reminders</h2>
            <div class="alert alert-info">
                <ul class="reminder-list mb-0">
                    <li><i data-feather="clock" class="me-2"></i>Keep your pet's rabies vaccination up-to-date</li>
                    <li><i data-feather="users" class="me-2"></i>Practice responsible pet ownership</li>
                    <li><i data-feather="alert-triangle" class="me-2"></i>Report animal bites immediately</li>
                    <li><i data-feather="activity" class="me-2"></i>Seek veterinary care quickly when needed</li>
                </ul>
            </div>
        </section>
    </main>

    <!-- Sticky CTA Button -->
    <a href="https://www.google.com/search?q=veterinary+clinic+near+me+philippines" 
       target="_blank" 
       class="btn btn-primary sticky-cta">
        <i data-feather="search" class="me-2"></i>Find a Clinic Near Me
    </a>

    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container">
            <p class="text-center mb-0">
                <i data-feather="info" class="me-2"></i>
                Disclaimer: This information is for general guidance only. Always consult with a qualified veterinarian.
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