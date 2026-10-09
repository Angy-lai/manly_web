<?php
/**
 * Home Page - Apex Sports Club
 * ISE 2102: Web Technologies
 */
$pageTitle = "Home";
$pageDescription = "Welcome to Apex Sports Club - University Student Sports and Fitness Community. Push beyond limits in football, basketball, gym, running, and volleyball.";
require_once __DIR__ . '/includes/header.php';

$activities = get_activities_list();
$events = array_slice(get_sample_events(), 0, 3);
?>

<!-- Hero Section -->
<section class="hero-home" aria-labelledby="hero-heading">
    <img src="assets/sports.jpeg" alt="Athletes in training" class="hero-background-image" loading="eager">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <span class="eyebrow">APEX SPORTS CLUB / UNIVERSITY COMMUNITY</span>
            <h1 class="hero-title" id="hero-heading">
                PUSH BEYOND <span class="highlight">LIMITS.</span>
            </h1>
            <p class="hero-description">
                Your game. Your goals. Your community. Join a student-led sports and fitness community that brings people together through movement, competition and a shared passion for staying active.
            </p>
            <div class="hero-cta-group">
                <a href="join.php" class="btn btn-primary">Join The Club</a>
                <a href="activities.php" class="btn btn-secondary">Explore Activities</a>
            </div>
            <div class="hero-badge-strip">
                <span>⚡ Built for every body. Driven by every goal.</span>
            </div>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="section section-dark" aria-labelledby="intro-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Our Philosophy</span>
            <h2 class="section-title" id="intro-heading">MORE THAN JUST A GAME.</h2>
            <p class="section-subtitle">
                At Apex, sport is about more than winning. It's about showing up, challenging yourself, supporting your teammates and finding a community that keeps you moving. Whether you're stepping onto the court for the first time or preparing for your next competition, there's a place for you here.
            </p>
        </div>

        <div class="features-grid">
            <article class="feature-card">
                <div class="feature-icon-box" aria-hidden="true">🤝</div>
                <h3>COMMUNITY</h3>
                <p>Meet people, build friendships and be part of an encouraging team that supports your personal and athletic growth on and off campus.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box" aria-hidden="true">⚡</div>
                <h3>PERFORMANCE</h3>
                <p>Improve your skills, develop consistency, master physical discipline, and discover what your body and mind can truly achieve.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box" aria-hidden="true">🌱</div>
                <h3>WELLBEING</h3>
                <p>Make intentional movement an energising part of your university routine and invest in lifelong physical stamina and mental clarity.</p>
            </article>
        </div>
    </div>
</section>

<!-- Sports Disciplines Grid Section -->
<section class="section section-alt" aria-labelledby="sports-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">All Disciplines</span>
            <h2 class="section-title" id="sports-heading">FIND YOUR GAME.</h2>
            <p class="section-subtitle">
                From competitive pitch action to recreational strength training, explore our student-led athletic divisions.
            </p>
        </div>

        <div class="sports-grid">
            <?php foreach ($activities as $act): ?>
                <article class="sport-card">
                    <div class="sport-card-image-wrap">
                        <img src="<?php echo sanitize($act['image']); ?>" alt="<?php echo sanitize($act['name']); ?> session at Apex Sports Club" loading="lazy">
                        <span class="sport-card-badge"><?php echo sanitize($act['badge']); ?></span>
                    </div>
                    <div class="sport-card-body">
                        <div class="sport-header">
                            <span class="sport-icon" aria-hidden="true"><?php echo sanitize($act['icon']); ?></span>
                            <h3><?php echo sanitize($act['name']); ?></h3>
                        </div>
                        <p class="sport-tagline"><?php echo sanitize($act['tagline']); ?></p>
                        <p class="sport-description"><?php echo sanitize($act['description']); ?></p>
                        <a href="activities.php?category=<?php echo urlencode($act['name']); ?>" class="sport-link">
                            View Schedule &rarr;
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Upcoming Events Preview Section -->
<section class="section section-dark" aria-labelledby="events-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Upcoming Sessions</span>
            <h2 class="section-title" id="events-heading">WHAT'S NEXT?</h2>
            <p class="section-subtitle">
                Sample fixtures and open sessions scheduled for our student community.
            </p>
        </div>

        <div class="events-grid">
            <?php foreach ($events as $event): ?>
                <article class="event-card">
                    <div class="event-meta-top">
                        <span class="event-category-badge"><?php echo sanitize($event['category']); ?></span>
                        <span class="event-sample-tag">Sample Event</span>
                    </div>
                    <h3><?php echo sanitize($event['title']); ?></h3>
                    <ul class="event-details-list">
                        <li>
                            <span aria-hidden="true">📅</span>
                            <time datetime="<?php echo sanitize($event['date']); ?>">
                                <?php echo date('l, M j, Y', strtotime($event['date'])); ?>
                            </time>
                        </li>
                        <li>
                            <span aria-hidden="true">🕒</span>
                            <span><?php echo sanitize($event['time']); ?></span>
                        </li>
                        <li>
                            <span aria-hidden="true">📍</span>
                            <span><?php echo sanitize($event['venue']); ?></span>
                        </li>
                    </ul>
                    <p class="event-description"><?php echo sanitize($event['description']); ?></p>
                    <a href="join.php?purpose=event&activity=<?php echo urlencode($event['category']); ?>" class="btn btn-secondary btn-sm btn-block">
                        Register Enquiry
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="text-center" style="margin-top: 48px;">
            <a href="activities.php" class="btn btn-primary">View All Activities & Schedule</a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-strip" aria-labelledby="cta-heading">
    <div class="container">
        <div class="cta-inner">
            <span class="eyebrow" style="color: var(--color-accent-lime);">Get Started</span>
            <h2 class="cta-title" id="cta-heading">YOUR NEXT CHAPTER STARTS HERE.</h2>
            <p style="color: var(--color-text-light); font-size: 1.15rem; margin-bottom: 32px;">
                Try something new, meet your people and make movement an unforgettable part of your university experience.
            </p>
            <a href="join.php" class="btn btn-primary">Become A Member</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
