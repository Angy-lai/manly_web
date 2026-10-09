<?php
/**
 * Shared Header Include for Apex Sports Club
 * ISE 2102: Web Technologies
 */
require_once __DIR__ . '/functions.php';

$title = isset($pageTitle) ? sanitize($pageTitle) . ' | Apex Sports Club' : 'Apex Sports Club | Move With Purpose. Play With Passion.';
$desc = isset($pageDescription) ? sanitize($pageDescription) : 'Apex Sports Club is a premier student-led university sports and fitness community. Push beyond limits in football, basketball, gym, running, and volleyball.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $desc; ?>">
    <meta name="author" content="ISE 2102 Student Project">
    <meta name="theme-color" content="#072804">
    <title><?php echo $title; ?></title>

    <!-- Google Fonts for Bold Athletic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700;800&display=swap" rel="stylesheet">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Favicon (Inline SVG Data URI) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%23072804'/><polygon points='50,15 85,80 15,80' fill='%2338E54D'/><polyline points='35,55 50,28 65,55' stroke='%23072804' stroke-width='6' fill='none'/></svg>">
</head>
<body>
    <!-- Skip to Main Content for Accessibility -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Sticky Navigation Bar -->
    <header class="site-header" id="site-header">
        <div class="header-container">
            <a href="index.php" class="brand-logo" aria-label="Apex Sports Club Home">
                <span class="logo-mark">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polygon points="12 2 22 19 2 19"></polygon>
                        <line x1="8" y1="13" x2="16" y2="13"></line>
                    </svg>
                </span>
                <span class="logo-text">
                    <span class="logo-name">APEX</span>
                    <span class="logo-sub">SPORTS CLUB</span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="main-nav" id="main-nav" aria-label="Primary Navigation">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo is_active('index.php'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link <?php echo is_active('about.php'); ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="activities.php" class="nav-link <?php echo is_active('activities.php'); ?>">Activities & Events</a>
                    </li>
                    <li class="nav-item">
                        <a href="gallery.php" class="nav-link <?php echo is_active('gallery.php'); ?>">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="join.php" class="nav-link <?php echo is_active('join.php'); ?>">Join Us</a>
                    </li>
                </ul>
            </nav>

            <!-- Navigation Actions -->
            <div class="header-actions">
                <a href="join.php" class="btn btn-primary btn-sm header-cta">Become a Member</a>
                <button type="button" class="mobile-toggle" id="mobile-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation menu">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
            <div class="mobile-menu-inner">
                <ul class="mobile-nav-list">
                    <li><a href="index.php" class="mobile-nav-link <?php echo is_active('index.php'); ?>">Home</a></li>
                    <li><a href="about.php" class="mobile-nav-link <?php echo is_active('about.php'); ?>">About Us</a></li>
                    <li><a href="activities.php" class="mobile-nav-link <?php echo is_active('activities.php'); ?>">Activities & Events</a></li>
                    <li><a href="gallery.php" class="mobile-nav-link <?php echo is_active('gallery.php'); ?>">Gallery</a></li>
                    <li><a href="join.php" class="mobile-nav-link <?php echo is_active('join.php'); ?>">Join Us / Contact</a></li>
                </ul>
                <div class="mobile-menu-footer">
                    <a href="join.php" class="btn btn-primary btn-block">Join The Club</a>
                    <p class="mobile-tagline">Push Beyond Limits.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Shell -->
    <main id="main-content" class="site-main">
