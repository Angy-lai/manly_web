<?php
/**
 * Join Us / Contact Page - Apex Sports Club
 * ISE 2102: Web Technologies
 */
$pageTitle = "Join Us / Contact";
$pageDescription = "Submit your membership application or send an enquiry to Apex Sports Club. Open to university students across all degree years and skill levels.";
require_once __DIR__ . '/includes/header.php';

// Support pre-populating fields via query parameters from event/activity links
$selectedActivity = isset($_GET['activity']) ? sanitize($_GET['activity']) : '';
$selectedPurpose = isset($_GET['purpose']) ? sanitize($_GET['purpose']) : 'join';
?>

<!-- Page Hero -->
<section class="page-hero" aria-labelledby="join-hero-title">
    <div class="container">
        <div class="page-hero-inner">
            <span class="eyebrow">YOUR MOVE STARTS HERE</span>
            <h1 class="section-title" id="join-hero-title">THERE'S A PLACE<br><span style="color: var(--color-accent-lime);">FOR YOU AT APEX.</span></h1>
            <p class="section-subtitle">
                Ready to get involved? Tell us a little about yourself and the activities you're interested in. Whether you're a beginner or an experienced athlete, we'd love to hear from you.
            </p>
        </div>
    </div>
</section>

<!-- Main Join Layout Section -->
<section class="section section-dark" aria-labelledby="form-heading">
    <div class="container">
        <div class="join-layout">
            
            <!-- Membership Application Form -->
            <div class="form-card">
                <span class="eyebrow">Student Registration</span>
                <h2 class="section-title" id="form-heading" style="font-size: 1.8rem; margin-bottom: 24px;">MEMBERSHIP APPLICATION</h2>

                <!-- Client-side Status / Error Summary Alert -->
                <div id="form-status-alert" class="empty-state" style="display: none; padding: 16px; margin-bottom: 24px; text-align: left; border-color: var(--color-error); background: rgba(239, 68, 68, 0.1);">
                    <strong style="color: var(--color-error); display: block; margin-bottom: 4px;">Please correct the highlighted issues:</strong>
                    <ul id="form-errors-list" style="margin-left: 20px; font-size: 0.9rem; color: #FCA5A5;"></ul>
                </div>

                <form id="membership-form" action="process.php" method="POST" novalidate>
                    <div class="form-grid">
                        
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="full_name" class="form-label">
                                Full Name <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="e.g. Alex Morgan" required maxlength="120" autocomplete="name">
                            <span class="form-error-msg" id="error-full_name">Please enter your full name (minimum 2 letters).</span>
                        </div>

                        <!-- Student Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Student Email <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="e.g. s123456@university.sample.edu" required autocomplete="email">
                            <span class="form-error-msg" id="error-email">Please enter a valid student email address.</span>
                        </div>

                        <!-- Student ID (Optional) -->
                        <div class="form-group">
                            <label for="student_id" class="form-label">
                                Student ID Number <small style="color: var(--color-text-muted);">(Optional)</small>
                            </label>
                            <input type="text" id="student_id" name="student_id" class="form-control" placeholder="e.g. STU-2026-987" maxlength="30">
                            <span class="form-error-msg" id="error-student_id">Invalid student ID format.</span>
                        </div>

                        <!-- Course / Department -->
                        <div class="form-group">
                            <label for="course" class="form-label">
                                Course / Department <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <input type="text" id="course" name="course" class="form-control" placeholder="e.g. BSc Information Systems" required maxlength="120">
                            <span class="form-error-msg" id="error-course">Please provide your course or department.</span>
                        </div>

                        <!-- Year of Study -->
                        <div class="form-group">
                            <label for="study_year" class="form-label">
                                Year of Study <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <select id="study_year" name="study_year" class="form-control" required>
                                <option value="">-- Select Year --</option>
                                <option value="Year 1">Year 1 (Freshman)</option>
                                <option value="Year 2">Year 2 (Sophomore)</option>
                                <option value="Year 3">Year 3 (Junior)</option>
                                <option value="Year 4">Year 4 (Senior)</option>
                                <option value="Postgraduate / Other">Postgraduate / Other</option>
                            </select>
                            <span class="form-error-msg" id="error-study_year">Please select your year of study.</span>
                        </div>

                        <!-- Preferred Activity -->
                        <div class="form-group">
                            <label for="preferred_activity" class="form-label">
                                Preferred Activity <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <select id="preferred_activity" name="preferred_activity" class="form-control" required>
                                <option value="">-- Select Activity --</option>
                                <option value="Football" <?php echo ($selectedActivity === 'Football') ? 'selected' : ''; ?>>Football</option>
                                <option value="Basketball" <?php echo ($selectedActivity === 'Basketball') ? 'selected' : ''; ?>>Basketball</option>
                                <option value="Fitness" <?php echo ($selectedActivity === 'Fitness' || $selectedActivity === 'Gym & Fitness') ? 'selected' : ''; ?>>Gym & Fitness</option>
                                <option value="Running" <?php echo ($selectedActivity === 'Running' || $selectedActivity === 'Running & Athletics') ? 'selected' : ''; ?>>Running & Athletics</option>
                                <option value="Volleyball" <?php echo ($selectedActivity === 'Volleyball') ? 'selected' : ''; ?>>Volleyball</option>
                                <option value="Multiple Activities" <?php echo ($selectedActivity === 'Multiple Activities') ? 'selected' : ''; ?>>Multiple Activities</option>
                                <option value="Other" <?php echo ($selectedActivity === 'Other') ? 'selected' : ''; ?>>Other / Social Sports</option>
                            </select>
                            <span class="form-error-msg" id="error-preferred_activity">Please choose your preferred sport.</span>
                        </div>

                        <!-- Experience Level -->
                        <div class="form-group form-group-full">
                            <label class="form-label">
                                Experience Level <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <div class="radio-group" role="radiogroup" aria-required="true">
                                <label class="radio-label">
                                    <input type="radio" name="experience_level" value="Beginner" checked>
                                    <span>Beginner (New to sport)</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="experience_level" value="Intermediate">
                                    <span>Intermediate (Played recreationally)</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="experience_level" value="Experienced">
                                    <span>Experienced (Competitive league player)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Form Purpose -->
                        <div class="form-group form-group-full">
                            <label for="form_purpose" class="form-label">
                                Submission Purpose <span class="required-star" aria-hidden="true">*</span>
                            </label>
                            <select id="form_purpose" name="form_purpose" class="form-control" required>
                                <option value="Join the club" <?php echo ($selectedPurpose === 'join') ? 'selected' : ''; ?>>Join the club (General Membership)</option>
                                <option value="Event enquiry" <?php echo ($selectedPurpose === 'enquiry' || $selectedPurpose === 'event') ? 'selected' : ''; ?>>Event / Training Session Enquiry</option>
                                <option value="Ask a question" <?php echo ($selectedPurpose === 'question') ? 'selected' : ''; ?>>Ask a question to Committee</option>
                            </select>
                        </div>

                        <!-- Reason for Joining (Optional) -->
                        <div class="form-group form-group-full">
                            <label for="reason" class="form-label">
                                Reason for Joining / Message <small style="color: var(--color-text-muted);">(Optional)</small>
                            </label>
                            <textarea id="reason" name="reason" class="form-control" rows="4" placeholder="Tell us about your fitness goals, positions played, or what you hope to gain from the club..." maxlength="600"></textarea>
                            <span class="form-error-msg" id="error-reason">Message must not exceed 600 characters.</span>
                        </div>

                        <!-- Consent Checkbox -->
                        <div class="form-group form-group-full">
                            <label class="checkbox-label">
                                <input type="checkbox" id="consent" name="consent" value="1" required>
                                <span>I agree to allow Apex Sports Club to use the contact details provided to communicate regarding club sessions, fixtures, and membership updates. <span class="required-star" aria-hidden="true">*</span></span>
                            </label>
                            <span class="form-error-msg" id="error-consent">You must accept the consent agreement before submitting.</span>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group form-group-full" style="margin-top: 10px;">
                            <button type="submit" id="submit-btn" class="btn btn-primary btn-block">
                                Submit Application
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Sidebar: Benefits & Contact Information -->
            <aside class="join-sidebar" aria-label="Membership benefits and contact info">
                
                <!-- Benefits Card -->
                <div class="benefits-card">
                    <span class="eyebrow">Why Join Us?</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 12px;">MEMBER BENEFITS</h3>
                    <p style="color: var(--color-text-muted); font-size: 0.92rem;">
                        Being part of Apex unlocks active opportunities on campus:
                    </p>
                    <ul class="benefits-list">
                        <li>
                            <span class="benefit-bullet" aria-hidden="true">✔</span>
                            <span><strong>Discover new sports:</strong> Try games with patient, encouraging peers.</span>
                        </li>
                        <li>
                            <span class="benefit-bullet" aria-hidden="true">✔</span>
                            <span><strong>Meet your people:</strong> Connect with energetic students sharing similar goals.</span>
                        </li>
                        <li>
                            <span class="benefit-bullet" aria-hidden="true">✔</span>
                            <span><strong>Build skills & confidence:</strong> Level up technique and game fitness every week.</span>
                        </li>
                        <li>
                            <span class="benefit-bullet" aria-hidden="true">✔</span>
                            <span><strong>Competitions & Socials:</strong> Play in friendly interfaculty tournaments & meetups.</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact Details Card -->
                <div class="contact-card">
                    <span class="eyebrow">Direct Contact</span>
                    <h3 style="font-size: 1.3rem; margin-bottom: 12px;">CLUB OFFICE</h3>
                    <p style="color: var(--color-text-muted); font-size: 0.92rem; margin-bottom: 20px;">
                        Have questions before submitting your application? Reach out to our student desk:
                    </p>
                    
                    <ul class="footer-contact-list">
                        <li>
                            <span style="font-size: 1.2rem;">📍</span>
                            <div>
                                <strong>Campus Sports Office:</strong>
                                <p style="font-size: 0.88rem; color: var(--color-text-muted);">Student Union Building, Room 204 (Sample Venue)</p>
                            </div>
                        </li>
                        <li>
                            <span style="font-size: 1.2rem;">✉️</span>
                            <div>
                                <strong>Email Desk:</strong>
                                <p style="font-size: 0.88rem; color: var(--color-text-muted);">sportsclub@apexuniversity.sample.edu</p>
                            </div>
                        </li>
                        <li>
                            <span style="font-size: 1.2rem;">📞</span>
                            <div>
                                <strong>Information Line:</strong>
                                <p style="font-size: 0.88rem; color: var(--color-text-muted);">+00 (0) 123 456 789 (Sample Number)</p>
                            </div>
                        </li>
                    </ul>

                    <div style="background-color: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: var(--radius-sm); padding: 12px; margin-top: 20px;">
                        <small style="color: #F59E0B; display: block; line-height: 1.4;">
                            * Academic Demonstration: Replace sample campus contacts with confirmed university club contact info.
                        </small>
                    </div>
                </div>

            </aside>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
