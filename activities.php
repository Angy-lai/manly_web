<?php
/**
 * Activities and Events Page - Apex Sports Club
 * ISE 2102: Web Technologies
 */
$pageTitle = "Activities & Events";
$pageDescription = "Explore sports sessions, upcoming university matches, fitness circuits, and open training schedules at Apex Sports Club.";
require_once __DIR__ . '/includes/header.php';

$activities = get_activities_list();
$events = get_sample_events();
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="act-hero-title">
    <div class="container">
        <div class="page-hero-inner">
            <span class="eyebrow">GET INVOLVED</span>
            <h1 class="section-title" id="act-hero-title">FIND YOUR PACE.<br><span style="color: var(--color-accent-lime);">PLAY YOUR GAME.</span></h1>
            <p class="section-subtitle">
                From friendly matches to fitness challenges, discover ways to stay active, learn new skills and connect with the Apex community.
            </p>
        </div>
    </div>
</section>

<!-- Activity Disciplines Section -->
<section class="section section-dark" aria-labelledby="all-activities-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Disciplines Overview</span>
            <h2 class="section-title" id="all-activities-heading">OUR CORE SPORTS</h2>
            <p class="section-subtitle">
                Explore our student divisions. Each activity features beginner workshops, weekly open sessions, and competitive league rosters.
            </p>
        </div>

        <div class="sports-grid">
            <?php foreach ($activities as $act): ?>
                <article class="sport-card" id="<?php echo sanitize($act['id']); ?>">
                    <div class="sport-card-image-wrap">
                        <img src="<?php echo sanitize($act['image']); ?>" alt="<?php echo sanitize($act['name']); ?> training" loading="lazy">
                        <span class="sport-card-badge"><?php echo sanitize($act['badge']); ?></span>
                    </div>
                    <div class="sport-card-body">
                        <div class="sport-header">
                            <span class="sport-icon" aria-hidden="true"><?php echo sanitize($act['icon']); ?></span>
                            <h3><?php echo sanitize($act['name']); ?></h3>
                        </div>
                        <p class="sport-tagline"><?php echo sanitize($act['tagline']); ?></p>
                        <p class="sport-description"><?php echo sanitize($act['description']); ?></p>
                        <a href="join.php?purpose=enquiry&activity=<?php echo urlencode($act['name']); ?>" class="btn btn-secondary btn-sm">
                            Enquire About <?php echo sanitize($act['name']); ?>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Interactive Events & Fixtures Section -->
<section class="section section-alt" id="events-section" aria-labelledby="events-list-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Upcoming Schedule</span>
            <h2 class="section-title" id="events-list-heading">CLUB FIXTURES & SESSIONS</h2>
            <p class="section-subtitle">
                Filter upcoming activities by sport. All university students are welcome to participate.
            </p>
            <p style="color: #F59E0B; font-size: 0.85rem; margin-top: -24px; margin-bottom: 30px;">
                * Notice: Sample event dates — replace with confirmed university booking calendar details.
            </p>
        </div>

        <!-- Filter Controls (Handled dynamically by assets/js/main.js) -->
        <div class="filter-bar" role="tablist" aria-label="Event category filters">
            <button type="button" class="filter-btn active" data-filter="all" role="tab" aria-selected="true">All Activities</button>
            <button type="button" class="filter-btn" data-filter="Football" role="tab" aria-selected="false">Football</button>
            <button type="button" class="filter-btn" data-filter="Basketball" role="tab" aria-selected="false">Basketball</button>
            <button type="button" class="filter-btn" data-filter="Fitness" role="tab" aria-selected="false">Fitness</button>
            <button type="button" class="filter-btn" data-filter="Running" role="tab" aria-selected="false">Running</button>
            <button type="button" class="filter-btn" data-filter="Volleyball" role="tab" aria-selected="false">Volleyball</button>
        </div>

        <!-- Event Cards Container -->
        <div class="events-grid" id="events-container">
            <?php foreach ($events as $event): ?>
                <article class="event-card" data-category="<?php echo sanitize($event['category']); ?>">
                    <div class="event-meta-top">
                        <span class="event-category-badge"><?php echo sanitize($event['category']); ?></span>
                        <span class="event-sample-tag">Sample Date</span>
                    </div>
                    <h3><?php echo sanitize($event['title']); ?></h3>
                    <ul class="event-details-list">
                        <li>
                            <span aria-hidden="true">📅</span>
                            <time datetime="<?php echo sanitize($event['date']); ?>">
                                <?php echo date('l, F j, Y', strtotime($event['date'])); ?>
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
                        <li>
                            <span aria-hidden="true">👥</span>
                            <span><?php echo sanitize($event['spots']); ?></span>
                        </li>
                    </ul>
                    <p class="event-description"><?php echo sanitize($event['description']); ?></p>
                    <a href="join.php?purpose=enquiry&activity=<?php echo urlencode($event['category']); ?>" class="btn btn-primary btn-sm btn-block">
                        Join This Event
                    </a>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Empty State (Shown via JS when filter yields 0 matches) -->
        <div id="events-empty-state" class="empty-state" style="display: none;">
            <div style="font-size: 2.5rem; margin-bottom: 12px;" aria-hidden="true">🔍</div>
            <h3>No sessions found</h3>
            <p style="color: var(--color-text-muted);">No fixtures currently scheduled in this category. Check back soon or register your interest!</p>
            <button type="button" class="btn btn-secondary btn-sm" id="reset-filter-btn" style="margin-top: 16px;">View All Events</button>
        </div>

        <!-- Weekly Recurring Training Timetable (Semantic Table for ISE 2102 HTML Requirement) -->
        <div class="schedule-table-wrap">
            <table class="schedule-table">
                <caption>Weekly Training & Open Session Timetable</caption>
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Time</th>
                        <th scope="col">Sport</th>
                        <th scope="col">Session Type</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Monday</strong></td>
                        <td>16:30 - 18:30</td>
                        <td>Football</td>
                        <td>Passing & Tactical Drills</td>
                        <td>Turf Pitch 1</td>
                        <td>All Abilities</td>
                    </tr>
                    <tr>
                        <td><strong>Tuesday</strong></td>
                        <td>17:00 - 18:30</td>
                        <td>Basketball</td>
                        <td>Shooting Clinics & 3v3 Runs</td>
                        <td>Indoor Sports Hall</td>
                        <td>Beginner & Intermediate</td>
                    </tr>
                    <tr>
                        <td><strong>Wednesday</strong></td>
                        <td>16:00 - 17:30</td>
                        <td>Gym & Fitness</td>
                        <td>Strength Circuits & Conditioning</td>
                        <td>Campus Fitness Studio</td>
                        <td>Open / Co-ed</td>
                    </tr>
                    <tr>
                        <td><strong>Thursday</strong></td>
                        <td>17:00 - 19:00</td>
                        <td>Volleyball</td>
                        <td>Serving, Spiking & Scrimmage</td>
                        <td>Multi-Sport Court</td>
                        <td>Recreational</td>
                    </tr>
                    <tr>
                        <td><strong>Friday</strong></td>
                        <td>16:30 - 18:00</td>
                        <td>Running & Track</td>
                        <td>Pace Group 5K & Interval Work</td>
                        <td>Athletics Track</td>
                        <td>All Paces</td>
                    </tr>
                    <tr>
                        <td><strong>Saturday</strong></td>
                        <td>09:00 - 12:00</td>
                        <td>Social Sports</td>
                        <td>Interfaculty Games & Mini-Tournaments</td>
                        <td>Main Sports Grounds</td>
                        <td>Community Fun</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-strip" aria-labelledby="act-cta-heading">
    <div class="container">
        <div class="cta-inner">
            <span class="eyebrow" style="color: var(--color-accent-lime);">Ready to Play?</span>
            <h2 class="cta-title" id="act-cta-heading">DON'T SIT ON THE BENCH</h2>
            <p style="color: var(--color-text-light); font-size: 1.05rem; margin-bottom: 28px;">
                Membership gives you free access to all regular training sessions, club tournaments, fitness challenges, and sports socials.
            </p>
            <a href="join.php" class="btn btn-primary">Sign Up Today</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
