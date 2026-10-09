<?php
/**
 * Shared Footer Include for Apex Sports Club
 * ISE 2102: Web Technologies
 */
?>
    </main>

    <!-- Site Footer -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="footer-container">
                <div class="footer-brand">
                    <a href="index.php" class="brand-logo footer-logo" aria-label="Apex Sports Club Home">
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
                    <p class="footer-tagline">Move With Purpose. Play With Passion.</p>
                    <p class="footer-slogan">PUSH BEYOND LIMITS.</p>
                    <p class="footer-about-text">
                        A student-led sports and fitness community fostering athletic excellence, healthy habits, and inclusive camaraderie across all university faculties.
                    </p>
                </div>

                <div class="footer-links-group">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="activities.php">Activities & Events</a></li>
                        <li><a href="gallery.php">Club Gallery</a></li>
                        <li><a href="join.php">Join Us / Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links-group">
                    <h3 class="footer-heading">Sports Disciplines</h3>
                    <ul class="footer-nav">
                        <li><a href="activities.php?filter=football">Football Club</a></li>
                        <li><a href="activities.php?filter=basketball">Basketball Court</a></li>
                        <li><a href="activities.php?filter=fitness">Gym & Strength</a></li>
                        <li><a href="activities.php?filter=volleyball">Volleyball Squad</a></li>
                        <li><a href="activities.php?filter=running">Running & Athletics</a></li>
                    </ul>
                </div>

                <div class="footer-contact-preview">
                    <h3 class="footer-heading">Contact & Sessions</h3>
                    <ul class="footer-contact-list">
                        <li>
                            <span class="contact-icon">📍</span>
                            <span>Campus Sports Complex, Sample Venue Field 1</span>
                        </li>
                        <li>
                            <span class="contact-icon">✉️</span>
                            <span>sportsclub@apexuniversity.sample.edu</span>
                        </li>
                        <li>
                            <span class="contact-icon">🕒</span>
                            <span>Training: Mon – Fri (16:30 – 19:30)</span>
                        </li>
                    </ul>
                    <a href="join.php" class="btn btn-secondary btn-sm footer-join-btn">Send Enquiry</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-container bottom-flex">
                <div class="copyright-info">
                    &copy; <span id="copyright-year"><?php echo date('Y'); ?></span> Apex Sports Club. All rights reserved.
                </div>
                <div class="academic-notice">
                    <small>ISE 2102: Web Technologies &bull; Academic Demonstration Project &bull; Sample Dates & Content</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Main JavaScript Logic -->
    <script src="assets/js/main.js" defer></script>
</body>
</html>
