<?php
/**
 * About Us Page - Apex Sports Club
 * ISE 2102: Web Technologies
 */
$pageTitle = "About Us";
$pageDescription = "Learn about Apex Sports Club: our student-led mission, vision, core values, objectives, and dedicated committee members.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="about-hero-title">
    <div class="container">
        <div class="page-hero-inner">
            <span class="eyebrow">WHO WE ARE</span>
            <h1 class="section-title" id="about-hero-title">BUILT BY STUDENTS.<br><span style="color: var(--color-accent-lime);">UNITED BY SPORT.</span></h1>
            <p class="section-subtitle">
                Apex Sports Club exists to make sport and fitness an accessible, enjoyable and rewarding part of student life.
            </p>
        </div>
    </div>
</section>

<!-- Our Story & Mission Section (Alternating Light Theme Section) -->
<section class="section section-light" aria-labelledby="story-heading">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="eyebrow">Our Story</span>
                <h2 class="section-title" id="story-heading" style="color: var(--color-text-dark);">WHY APEX?</h2>
                <p style="font-size: 1.05rem; line-height: 1.7; margin-bottom: 20px; color: #2D3748;">
                    University life can be busy, and finding time to stay active or meet new people can be difficult. Apex was created as a student-led community where people can connect through sport, discover new interests and develop habits that support a balanced lifestyle.
                </p>
                <p style="font-size: 1.05rem; line-height: 1.7; color: #2D3748;">
                    We believe participation matters as much as performance. Whether you want to compete, learn a new sport or simply move more often, we want to help you take that first step.
                </p>
            </div>
            <div>
                <div style="border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-card); border: 2px solid var(--color-border-light);">
                    <img src="assets/sports.jpeg" alt="Apex Sports Club community in action" style="width: 100%; height: 380px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div style="margin-top: 60px;" class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-box" style="background-color: rgba(30, 102, 16, 0.1); border-color: rgba(30, 102, 16, 0.25);" aria-hidden="true">🎯</div>
                <h3 style="color: var(--color-text-dark);">OUR MISSION</h3>
                <p>To create an inclusive and energetic student community that promotes physical activity, teamwork, sporting development and personal growth through accessible sports and fitness opportunities.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background-color: rgba(30, 102, 16, 0.1); border-color: rgba(30, 102, 16, 0.25);" aria-hidden="true">🔭</div>
                <h3 style="color: var(--color-text-dark);">OUR VISION</h3>
                <p>To become a recognised student community where every participant feels welcome, motivated and empowered to pursue an active, rewarding lifestyle throughout their university journey.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box" style="background-color: rgba(30, 102, 16, 0.1); border-color: rgba(30, 102, 16, 0.25);" aria-hidden="true">📋</div>
                <h3 style="color: var(--color-text-dark);">OUR COMMITMENT</h3>
                <p>Ensuring transparent student leadership, beginner-accessible sessions, well-maintained sports equipment, and an encouraging atmosphere free of intimidation or barriers.</p>
            </div>
        </div>
    </div>
</section>

<!-- Objectives Section -->
<section class="section section-dark" aria-labelledby="objectives-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Strategic Goals</span>
            <h2 class="section-title" id="objectives-heading">OUR KEY OBJECTIVES</h2>
            <p class="section-subtitle">
                Clear milestones guiding our athletic calendars, weekly sessions, and student initiatives.
            </p>
        </div>

        <div class="features-grid">
            <article class="feature-card">
                <div class="feature-icon-box">🏃</div>
                <h3>Regular Physical Activity</h3>
                <p>Encourage routine physical exercise and healthy daily habits across diverse student faculties.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box">🏀</div>
                <h3>Skill Development</h3>
                <p>Provide accessible opportunities to learn fundamentals and master tactical nuances across multiple sports.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box">🏆</div>
                <h3>Teamwork & Leadership</h3>
                <p>Foster sportsmanship, leadership under pressure, effective communication, and genuine mutual respect.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box">🎉</div>
                <h3>Friendly Competitions</h3>
                <p>Organise inclusive campus tournaments, weekend leagues, and memorable recreational fitness events.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box">🤝</div>
                <h3>Interfaculty Connections</h3>
                <p>Bridge students from varying years, degree disciplines, and backgrounds through shared passions for movement.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-box">⭐</div>
                <h3>Inclusive Access</h3>
                <p>Ensure beginners receive encouraging coaching while experienced athletes find high-tempo competitive challenges.</p>
            </article>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="section section-alt" aria-labelledby="values-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Principles</span>
            <h2 class="section-title" id="values-heading">CORE VALUES</h2>
            <p class="section-subtitle">The standards that define every training drill, match, and social meetup.</p>
        </div>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-name">INCLUSION</div>
                <p style="color: var(--color-text-muted);">Everyone deserves an opportunity to participate, learn and feel valued.</p>
            </div>
            <div class="value-card">
                <div class="value-name">TEAMWORK</div>
                <p style="color: var(--color-text-muted);">We achieve more and elevate our games when we uplift each other.</p>
            </div>
            <div class="value-card">
                <div class="value-name">DISCIPLINE</div>
                <p style="color: var(--color-text-muted);">Lasting progress comes from consistency, effort, and commitment.</p>
            </div>
            <div class="value-card">
                <div class="value-name">RESPECT</div>
                <p style="color: var(--color-text-muted);">We respect teammates, opponents, match officials, and the sporting spirit.</p>
            </div>
            <div class="value-card">
                <div class="value-name">GROWTH</div>
                <p style="color: var(--color-text-muted);">Every session is a fresh opportunity to sharpen skills and mindset.</p>
            </div>
        </div>
    </div>
</section>

<!-- Committee Members Section -->
<section class="section section-dark" aria-labelledby="committee-heading">
    <div class="container">
        <div class="text-center">
            <span class="eyebrow">Student Leadership</span>
            <h2 class="section-title" id="committee-heading">THE PEOPLE BEHIND APEX.</h2>
            <p class="section-subtitle">
                Elected student leaders coordinating fixtures, safety, training sessions, and community initiatives.
            </p>
            <p style="color: #F59E0B; font-size: 0.85rem; margin-top: -24px; margin-bottom: 40px;">
                * Note: Sample committee information for ISE 2102 project demonstration.
            </p>
        </div>

        <div class="committee-grid">
            <article class="committee-card">
                <div class="committee-avatar" aria-hidden="true">👨‍💼</div>
                <div class="committee-role">Club President</div>
                <h3 class="committee-name">Sample President</h3>
                <p class="committee-desc">Oversees club strategy, university liaison, fixture schedules, and community development.</p>
            </article>

            <article class="committee-card">
                <div class="committee-avatar" aria-hidden="true">👩‍💼</div>
                <div class="committee-role">Vice President</div>
                <h3 class="committee-name">Sample Vice President</h3>
                <p class="committee-desc">Assists executive operations, internal communications, and club member welfare.</p>
            </article>

            <article class="committee-card">
                <div class="committee-avatar" aria-hidden="true">📝</div>
                <div class="committee-role">Secretary</div>
                <h3 class="committee-name">Sample Secretary</h3>
                <p class="committee-desc">Manages member records, meeting documentation, and formal correspondence.</p>
            </article>

            <article class="committee-card">
                <div class="committee-avatar" aria-hidden="true">💳</div>
                <div class="committee-role">Treasurer</div>
                <h3 class="committee-name">Sample Treasurer</h3>
                <p class="committee-desc">Manages equipment budgets, logistics accounts, and sports resource allocations.</p>
            </article>

            <article class="committee-card">
                <div class="committee-avatar" aria-hidden="true">⚽</div>
                <div class="committee-role">Sports Coordinator</div>
                <h3 class="committee-name">Sample Sports Coordinator</h3>
                <p class="committee-desc">Coordinates pitch bookings, referee logistics, match equipment, and tournament brackets.</p>
            </article>

            <article class="committee-card">
                <div class="committee-avatar" aria-hidden="true">🧘</div>
                <div class="committee-role">Fitness & Wellness Coordinator</div>
                <h3 class="committee-name">Sample Fitness Coordinator</h3>
                <p class="committee-desc">Designs gym circuit schedules, warm-up workshops, and student wellness challenges.</p>
            </article>
        </div>
    </div>
</section>

<!-- Membership Information Callout -->
<section class="cta-strip" aria-labelledby="membership-info-heading">
    <div class="container">
        <div class="cta-inner">
            <span class="eyebrow" style="color: var(--color-accent-lime);">Open Registration</span>
            <h2 class="cta-title" id="membership-info-heading">JOIN OUR ACTIVE SQUAD</h2>
            <p style="color: var(--color-text-light); font-size: 1.05rem; margin-bottom: 28px;">
                Interested students can submit our online registration form. Detailed participation guidelines, code of conduct, and season schedules will be emailed directly to your student inbox upon registration.
            </p>
            <a href="join.php" class="btn btn-primary">Submit Membership Application</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
