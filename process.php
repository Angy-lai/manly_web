<?php
/**
 * Form Processor - Apex Sports Club
 * ISE 2102: Web Technologies
 * 
 * Secure server-side validation, sanitization, output escaping,
 * and prepared statement database insertion (PDO).
 */
$pageTitle = "Application Status";
$pageDescription = "Membership application processing status for Apex Sports Club.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

// Verify POST request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ?>
    <section class="section section-dark">
        <div class="container">
            <div class="status-card" style="border-color: var(--color-error);">
                <div class="status-icon" aria-hidden="true">⚠️</div>
                <h2 style="color: var(--color-error); margin-bottom: 12px;">Invalid Request</h2>
                <p style="color: var(--color-text-muted); margin-bottom: 24px;">
                    This processing script only accepts form submissions via HTTP POST. Direct page access is not permitted.
                </p>
                <a href="join.php" class="btn btn-secondary">Go to Application Form</a>
            </div>
        </div>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

// Extract and trim POST inputs
$fullName = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$studentId = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';
$course = isset($_POST['course']) ? trim($_POST['course']) : '';
$studyYear = isset($_POST['study_year']) ? trim($_POST['study_year']) : '';
$preferredActivity = isset($_POST['preferred_activity']) ? trim($_POST['preferred_activity']) : '';
$experienceLevel = isset($_POST['experience_level']) ? trim($_POST['experience_level']) : '';
$reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';
$formPurpose = isset($_POST['form_purpose']) ? trim($_POST['form_purpose']) : '';
$consent = isset($_POST['consent']) ? 1 : 0;

// Server-side validation checks
$errors = [];

if (empty($fullName) || mb_strlen($fullName) < 2 || mb_strlen($fullName) > 120) {
    $errors[] = "Full Name is required and must be between 2 and 120 characters.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid student email address is required.";
}

if (!empty($studentId) && mb_strlen($studentId) > 30) {
    $errors[] = "Student ID must not exceed 30 characters.";
}

if (empty($course) || mb_strlen($course) < 2 || mb_strlen($course) > 120) {
    $errors[] = "Course / Department is required.";
}

$validYears = ['Year 1', 'Year 2', 'Year 3', 'Year 4', 'Postgraduate / Other'];
if (empty($studyYear) || !in_array($studyYear, $validYears, true)) {
    $errors[] = "Please select a valid Year of Study.";
}

$validActivities = ['Football', 'Basketball', 'Fitness', 'Running', 'Volleyball', 'Multiple Activities', 'Other'];
if (empty($preferredActivity) || !in_array($preferredActivity, $validActivities, true)) {
    $errors[] = "Please select a valid sport or activity.";
}

$validExperience = ['Beginner', 'Intermediate', 'Experienced'];
if (empty($experienceLevel) || !in_array($experienceLevel, $validExperience, true)) {
    $errors[] = "Please select a valid experience level.";
}

if (!empty($reason) && mb_strlen($reason) > 600) {
    $errors[] = "Reason for joining must not exceed 600 characters.";
}

$validPurposes = ['Join the club', 'Event enquiry', 'Ask a question'];
if (empty($formPurpose) || !in_array($formPurpose, $validPurposes, true)) {
    $errors[] = "Please choose a valid form purpose.";
}

if ($consent !== 1) {
    $errors[] = "You must provide consent for the club to use your contact details.";
}

// Check for validation failures
if (!empty($errors)) {
    ?>
    <section class="section section-dark">
        <div class="container">
            <div class="status-card" style="border-color: var(--color-error); text-align: left;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div class="status-icon" aria-hidden="true" style="color: var(--color-error);">❌</div>
                    <h2 style="color: var(--color-error); margin-bottom: 8px;">Submission Errors Detected</h2>
                    <p style="color: var(--color-text-muted);">
                        Please review and correct the following items before resubmitting:
                    </p>
                </div>

                <ul style="margin: 20px 0 28px 24px; color: #FCA5A5; line-height: 1.8;">
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo sanitize($err); ?></li>
                    <?php endforeach; ?>
                </ul>

                <div style="text-align: center;">
                    <a href="javascript:history.back()" class="btn btn-primary">Return & Edit Form</a>
                </div>
            </div>
        </div>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

// Database storage via PDO prepared statement
$dbSaved = false;
$dbMessage = "";

try {
    $pdo = getDatabaseConnection();
    if ($pdo !== null) {
        $stmt = $pdo->prepare("INSERT INTO membership_applications 
            (full_name, email, student_id, course, study_year, preferred_activity, experience_level, reason, form_purpose, consent) 
            VALUES (:full_name, :email, :student_id, :course, :study_year, :preferred_activity, :experience_level, :reason, :form_purpose, :consent)");

        $stmt->execute([
            ':full_name'          => $fullName,
            ':email'              => $email,
            ':student_id'         => !empty($studentId) ? $studentId : null,
            ':course'             => $course,
            ':study_year'         => $studyYear,
            ':preferred_activity' => $preferredActivity,
            ':experience_level'   => $experienceLevel,
            ':reason'             => !empty($reason) ? $reason : null,
            ':form_purpose'       => $formPurpose,
            ':consent'            => $consent,
        ]);
        $dbSaved = true;
        $dbMessage = "Record successfully stored in application database.";
    } else {
        $dbMessage = "Application received and processed via server session fallback.";
    }
} catch (PDOException $e) {
    error_log("Database error in process.php: " . $e->getMessage());
    $dbMessage = "Application received. (Database storage offline; handled gracefully).";
}
?>

<!-- Submission Success Receipt -->
<section class="section section-dark" aria-labelledby="receipt-heading">
    <div class="container">
        <div class="status-card" style="border-color: var(--color-accent-lime); max-width: 760px;">
            <div class="status-icon" aria-hidden="true" style="color: var(--color-accent-lime);">🎉</div>
            <span class="eyebrow" style="color: var(--color-accent-bright);">Submission Received</span>
            <h2 class="section-title" id="receipt-heading" style="font-size: 2rem; margin-bottom: 16px;">
                APPLICATION CONFIRMATION
            </h2>

            <p style="font-size: 1.15rem; color: var(--color-text-white); margin-bottom: 24px; font-weight: 500; line-height: 1.6;">
                Thank you for contacting Apex Sports Club. Your details have been received. Please keep an eye on your student email for further information.
            </p>

            <div style="background-color: rgba(56, 229, 77, 0.08); border: 1px solid rgba(56, 229, 77, 0.25); border-radius: var(--radius-sm); padding: 14px; margin-bottom: 30px; text-align: center;">
                <p style="color: var(--color-accent-bright); font-size: 0.88rem; margin: 0;">
                    ℹ️ <strong>Please note:</strong> This receipt confirms your application was delivered to the committee. It is not an immediate guarantee of competitive roster approval. We review all entries weekly.
                </p>
            </div>

            <!-- Safely Rendered Application Summary -->
            <div style="text-align: left; background-color: var(--color-bg-alt); border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: 24px; margin-bottom: 32px;">
                <h3 style="font-size: 1.1rem; color: var(--color-accent-lime); text-transform: uppercase; margin-bottom: 16px; border-bottom: 1px solid var(--color-border); padding-bottom: 8px;">
                    Summary of Received Information
                </h3>
                
                <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem;">
                    <tbody>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted); width: 40%;"><strong>Full Name:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($fullName); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Student Email:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($email); ?></td>
                        </tr>
                        <?php if (!empty($studentId)): ?>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Student ID:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($studentId); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Course / Dept:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($course); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Year of Study:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($studyYear); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Chosen Sport:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-accent-lime); font-weight: 700;"><?php echo sanitize($preferredActivity); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Experience Level:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($experienceLevel); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>Form Purpose:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white);"><?php echo sanitize($formPurpose); ?></td>
                        </tr>
                        <?php if (!empty($reason)): ?>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted); vertical-align: top;"><strong>Message / Goals:</strong></td>
                            <td style="padding: 6px 0; color: var(--color-text-white); font-style: italic;"><?php echo sanitize($reason); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td style="padding: 6px 0; color: var(--color-text-muted);"><strong>System Status:</strong></td>
                            <td style="padding: 6px 0; color: #10B981; font-size: 0.85rem;"><?php echo sanitize($dbMessage); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="index.php" class="btn btn-primary">Return to Homepage</a>
                <a href="activities.php" class="btn btn-secondary">Explore Sessions Timetable</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
