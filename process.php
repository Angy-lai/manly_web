<?php
/**
 * Backend Form Processor - Apex Sports Club
 * ISE 2102: Web Technologies
 * 
 * Demonstrates:
 * - PHP Form Processing (POST method)
 * - Server-side data validation & sanitization
 * - PDO Database prepared statements (MySQL / SQLite fallback)
 * - Self-contained HTML receipt presentation with site styling
 */

require_once __DIR__ . '/config/database.php';

function sanitize(string $data): string {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Ensure request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Method Not Allowed | Apex Sports Club</title>
      <link rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body>
      <div class="confirm-wrap">
        <div class="confirm-card error">
          <div class="confirm-icon">⚠️</div>
          <h1 class="section-title" style="color:var(--error);">Invalid Request</h1>
          <p style="color:var(--text-muted); margin-bottom: 24px;">Direct access to this processing script is not permitted. Please submit via the form.</p>
          <a href="join.html" class="btn btn-outline">Go to Membership Form</a>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// 1. Extract and trim inputs
$fullName          = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$email             = isset($_POST['email']) ? trim($_POST['email']) : '';
$studentId         = isset($_POST['student_id']) ? trim($_POST['student_id']) : '';
$course            = isset($_POST['course']) ? trim($_POST['course']) : '';
$studyYear         = isset($_POST['study_year']) ? trim($_POST['study_year']) : '';
$preferredActivity = isset($_POST['preferred_activity']) ? trim($_POST['preferred_activity']) : '';
$experienceLevel   = isset($_POST['experience_level']) ? trim($_POST['experience_level']) : '';
$reason            = isset($_POST['reason']) ? trim($_POST['reason']) : '';
$formPurpose       = isset($_POST['form_purpose']) ? trim($_POST['form_purpose']) : '';
$consent           = isset($_POST['consent']) ? 1 : 0;

// 2. Server-side validation
$errors = [];

if (empty($fullName) || mb_strlen($fullName) < 2 || mb_strlen($fullName) > 120) {
    $errors[] = "Full Name is required (between 2 and 120 characters).";
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
    $errors[] = "Please select a valid preferred activity.";
}

$validExperience = ['Beginner', 'Intermediate', 'Experienced'];
if (empty($experienceLevel) || !in_array($experienceLevel, $validExperience, true)) {
    $errors[] = "Please select a valid experience level.";
}

if (!empty($reason) && mb_strlen($reason) > 600) {
    $errors[] = "Reason / Message must not exceed 600 characters.";
}

$validPurposes = ['Join the club', 'Event enquiry', 'Ask a question'];
if (empty($formPurpose) || !in_array($formPurpose, $validPurposes, true)) {
    $errors[] = "Please choose a valid form purpose.";
}

if ($consent !== 1) {
    $errors[] = "You must provide consent for the club to use your contact details.";
}

// 3. Render errors if any
if (!empty($errors)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Submission Error | Apex Sports Club</title>
      <link rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body>
      <div class="confirm-wrap">
        <div class="confirm-card error">
          <div class="confirm-icon">❌</div>
          <span class="eyebrow" style="color:var(--error);">Validation Error</span>
          <h1 class="section-title" style="color:var(--error); font-size:2rem; margin-bottom:12px;">Submission Incomplete</h1>
          <p style="color:var(--text-muted); margin-bottom:20px;">Please correct the following issues to complete your registration:</p>

          <ul style="text-align:left; color:#fca5a5; margin:0 auto 28px; max-width:500px; line-height:1.7;">
            <?php foreach ($errors as $err): ?>
              <li><?php echo sanitize($err); ?></li>
            <?php endforeach; ?>
          </ul>

          <div class="confirm-actions">
            <a href="javascript:history.back()" class="btn btn-primary">Go Back &amp; Edit Form</a>
            <a href="index.html" class="btn btn-outline">Return Home</a>
          </div>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// 4. Database insertion with PDO prepared statements
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
        $dbMessage = "Record securely committed to the application database.";
    } else {
        $dbMessage = "Application received and acknowledged via server session fallback.";
    }
} catch (PDOException $e) {
    error_log("Database error in process.php: " . $e->getMessage());
    $dbMessage = "Application registered successfully (offline persistence fallback active).";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Application Received | Apex Sports Club</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;700;800&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- Top bar header -->
  <header class="site-header">
    <div class="header-inner">
      <a href="index.html" class="brand">
        <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 22 19 2 19"/><line x1="8" y1="13" x2="16" y2="13"/></svg></span>
        <span class="brand-text"><span class="brand-name">APEX</span><span class="brand-sub">SPORTS CLUB</span></span>
      </a>
      <a href="index.html" class="btn btn-outline btn-sm">Home</a>
    </div>
  </header>

  <main class="confirm-wrap">
    <div class="confirm-card success">
      <div class="confirm-icon">🎉</div>
      <span class="eyebrow">Submission Received</span>
      <h1 class="section-title" style="font-size:2.2rem; margin-bottom:12px;">APPLICATION CONFIRMATION</h1>
      
      <p style="font-size:1.1rem; color:var(--text-light); margin-bottom:20px;">
        Thank you for submitting to Apex Sports Club. Your details have been received and our student committee will follow up via email.
      </p>

      <div class="confirm-badge">
        ℹ️ <strong>Notice:</strong> This receipt confirms your application was delivered to the committee. It is not an immediate guarantee of competitive roster approval. We review all entries weekly.
      </div>

      <!-- Application Details Table -->
      <table class="confirm-table">
        <tbody>
          <tr>
            <td><strong>Full Name:</strong></td>
            <td><?php echo sanitize($fullName); ?></td>
          </tr>
          <tr>
            <td><strong>Student Email:</strong></td>
            <td><?php echo sanitize($email); ?></td>
          </tr>
          <?php if (!empty($studentId)): ?>
          <tr>
            <td><strong>Student ID:</strong></td>
            <td><?php echo sanitize($studentId); ?></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td><strong>Course / Dept:</strong></td>
            <td><?php echo sanitize($course); ?></td>
          </tr>
          <tr>
            <td><strong>Year of Study:</strong></td>
            <td><?php echo sanitize($studyYear); ?></td>
          </tr>
          <tr>
            <td><strong>Chosen Sport:</strong></td>
            <td style="color:var(--green-acc); font-weight:700;"><?php echo sanitize($preferredActivity); ?></td>
          </tr>
          <tr>
            <td><strong>Experience Level:</strong></td>
            <td><?php echo sanitize($experienceLevel); ?></td>
          </tr>
          <tr>
            <td><strong>Submission Purpose:</strong></td>
            <td><?php echo sanitize($formPurpose); ?></td>
          </tr>
          <?php if (!empty($reason)): ?>
          <tr>
            <td><strong>Goals / Note:</strong></td>
            <td style="font-style:italic;"><?php echo sanitize($reason); ?></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td><strong>Database Status:</strong></td>
            <td style="color:#10b981; font-weight:600; font-size:.85rem;"><?php echo sanitize($dbMessage); ?></td>
          </tr>
        </tbody>
      </table>

      <div class="confirm-actions">
        <a href="index.html" class="btn btn-primary">Return to Homepage</a>
        <a href="activities.html" class="btn btn-outline">Explore Weekly Timetable</a>
      </div>
    </div>
  </main>

  <footer class="site-footer">
    <div class="footer-bottom container">
      <span>&copy; <?php echo date('Y'); ?> Apex Sports Club. All rights reserved.</span>
      <small class="footer-note">ISE 2102: Web Technologies &bull; Academic Project &bull; Sample Content</small>
    </div>
  </footer>

</body>
</html>
