-- Database Schema for Apex Sports Club (ISE 2102: Web Technologies)
-- Table: membership_applications

CREATE TABLE IF NOT EXISTS membership_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    student_id VARCHAR(50) DEFAULT NULL,
    course VARCHAR(150) NOT NULL,
    study_year VARCHAR(20) NOT NULL,
    preferred_activity VARCHAR(50) NOT NULL,
    experience_level VARCHAR(30) NOT NULL,
    reason TEXT DEFAULT NULL,
    form_purpose VARCHAR(50) NOT NULL,
    consent TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
