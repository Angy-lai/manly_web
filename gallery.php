<?php
/**
 * Gallery Page - Apex Sports Club
 * ISE 2102: Web Technologies
 */
$pageTitle = "Club Gallery";
$pageDescription = "Relive the action, teamwork, and milestones across football, basketball, gym circuits, and volleyball with the Apex Sports Club photo gallery.";
require_once __DIR__ . '/includes/header.php';

// Gallery Items List
$galleryItems = [
    [
        'id' => 1,
        'title' => 'Functional Battle Ropes Circuit',
        'category' => 'Fitness',
        'src' => 'assets/girl_holding_ropes.jpeg',
        'caption' => 'High intensity conditioning and endurance training during our campus fitness bootcamp.',
        'alt' => 'Student holding battle ropes during gym conditioning'
    ],
    [
        'id' => 2,
        'title' => 'Multi-Sport Training Balls & Gear',
        'category' => 'Community',
        'src' => 'assets/pic_of_balls.jpeg',
        'caption' => 'Official club match balls prepared for weekend interfaculty tournaments.',
        'alt' => 'Assortment of football, basketball, and training balls on the turf'
    ],
    [
        'id' => 3,
        'title' => 'Track Sprints & Running Cadence',
        'category' => 'Running',
        'src' => 'assets/sports.jpeg',
        'caption' => 'Early morning athletics pace drills and endurance training on the campus track.',
        'alt' => 'Athletes sprinting on running track'
    ],
    [
        'id' => 4,
        'title' => 'Volleyball Spike at the Net',
        'category' => 'Volleyball',
        'src' => 'assets/volley.jpeg',
        'caption' => 'Intense rally and net block during our annual mixed volleyball showcase.',
        'alt' => 'Volleyball player jumping to spike above the net'
    ],
    [
        'id' => 5,
        'title' => 'Turf Football Tactics & Drills',
        'category' => 'Football',
        'src' => 'assets/pic_of_balls.jpeg',
        'caption' => 'Fast-paced one-touch passing and possession training under evening floodlights.',
        'alt' => 'Football match preparation and ball drills on the pitch'
    ],
    [
        'id' => 6,
        'title' => 'Strength & Calisthenics Challenge',
        'category' => 'Fitness',
        'src' => 'assets/girl_holding_ropes.jpeg',
        'caption' => 'Pushing limits with bodyweight movements and functional fitness stations.',
        'alt' => 'Student athlete engaged in heavy strength training'
    ],
    [
        'id' => 7,
        'title' => 'Indoor Basketball Scrimmage',
        'category' => 'Basketball',
        'src' => 'assets/sports.jpeg',
        'caption' => 'High-energy full court fast breaks and team defense during open court night.',
        'alt' => 'Basketball practice scrimmage in the indoor sports hall'
    ],
    [
        'id' => 8,
        'title' => 'Team Celebration & Sportsmanship',
        'category' => 'Community',
        'src' => 'assets/volley.jpeg',
        'caption' => 'Celebrating progress, sportsmanship, and friendships following friendly matches.',
        'alt' => 'Club members celebrating after competitive friendly match'
    ]
];
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="gallery-hero-title">
    <div class="container">
        <div class="page-hero-inner">
            <span class="eyebrow">MOMENTS THAT MOVE US</span>
            <h1 class="section-title" id="gallery-hero-title">THE GAME IS BETTER<br><span style="color: var(--color-accent-lime);">TOGETHER.</span></h1>
            <p class="section-subtitle">
                Every session brings a new challenge, a new connection and a new memory. Explore the spirit of sports and fitness at Apex.
            </p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section section-dark" aria-labelledby="gallery-main-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Visual Highlights</span>
            <h2 class="section-title" id="gallery-main-heading">OUR PHOTO ARCHIVE</h2>
            <p class="section-subtitle">
                Browse through training sessions, matches, and community celebrations. Click any photo to view in fullscreen.
            </p>
            <p style="color: #F59E0B; font-size: 0.85rem; margin-top: -24px; margin-bottom: 30px;">
                * Demonstration photos representing multi-sport activities for ISE 2102 project.
            </p>
        </div>

        <!-- Filter Controls -->
        <div class="filter-bar" role="tablist" aria-label="Gallery category filters">
            <button type="button" class="gallery-filter-btn filter-btn active" data-filter="all" role="tab" aria-selected="true">All Photos</button>
            <button type="button" class="gallery-filter-btn filter-btn" data-filter="Fitness" role="tab" aria-selected="false">Fitness</button>
            <button type="button" class="gallery-filter-btn filter-btn" data-filter="Volleyball" role="tab" aria-selected="false">Volleyball</button>
            <button type="button" class="gallery-filter-btn filter-btn" data-filter="Football" role="tab" aria-selected="false">Football</button>
            <button type="button" class="gallery-filter-btn filter-btn" data-filter="Basketball" role="tab" aria-selected="false">Basketball</button>
            <button type="button" class="gallery-filter-btn filter-btn" data-filter="Community" role="tab" aria-selected="false">Community</button>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="gallery-container">
            <?php foreach ($galleryItems as $index => $item): ?>
                <div class="gallery-item" 
                     data-index="<?php echo $index; ?>" 
                     data-category="<?php echo sanitize($item['category']); ?>" 
                     tabindex="0" 
                     role="button" 
                     aria-label="View <?php echo sanitize($item['title']); ?> in lightbox">
                    <img src="<?php echo sanitize($item['src']); ?>" alt="<?php echo sanitize($item['alt']); ?>" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-tag"><?php echo sanitize($item['category']); ?></span>
                        <h3 class="gallery-title"><?php echo sanitize($item['title']); ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty state if filter doesn't match -->
        <div id="gallery-empty-state" class="empty-state" style="display: none;">
            <div style="font-size: 2.5rem; margin-bottom: 12px;" aria-hidden="true">📷</div>
            <h3>No photos found</h3>
            <p style="color: var(--color-text-muted);">No images found in this category. Check back soon for fresh match photos!</p>
            <button type="button" class="btn btn-secondary btn-sm" id="reset-gallery-filter-btn" style="margin-top: 16px;">View All Photos</button>
        </div>
    </div>
</section>

<!-- Lightbox Modal Component (Accessible keyboard navigation & focus) -->
<div class="lightbox-modal" id="lightbox-modal" role="dialog" aria-modal="true" aria-label="Image Lightbox Viewer" style="display: none;">
    <div class="lightbox-content">
        <button type="button" class="lightbox-close" id="lightbox-close" aria-label="Close Lightbox">&times;</button>
        
        <button type="button" class="lightbox-nav lightbox-prev" id="lightbox-prev" aria-label="Previous Image">&larr;</button>
        <button type="button" class="lightbox-nav lightbox-next" id="lightbox-next" aria-label="Next Image">&rarr;</button>

        <div class="lightbox-image-wrap">
            <img src="" alt="" id="lightbox-img">
        </div>
        
        <div class="lightbox-caption">
            <h3 class="lightbox-title" id="lightbox-title"></h3>
            <span class="lightbox-category" id="lightbox-category"></span>
            <p id="lightbox-desc" style="color: var(--color-text-muted); font-size: 0.92rem; margin-top: 6px;"></p>
        </div>
    </div>
</div>

<!-- Embedded JSON Data for JavaScript Lightbox & Filtering -->
<script>
    window.APEX_GALLERY_DATA = <?php echo json_encode($galleryItems, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
