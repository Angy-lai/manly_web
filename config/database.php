<?php
/**
 * Database Connection Configuration for Apex Sports Club
 * ISE 2102: Web Technologies
 * 
 * Supports MySQL (via PDO) with seamless fallback to SQLite
 * to guarantee functionality across local development and cloud hosts (e.g., Render).
 */

function getDatabaseConnection(): ?PDO {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    // Check for MySQL credentials in environment variables or default settings
    $dbHost = getenv('DB_HOST') ?: getenv('MYSQL_HOST');
    $dbName = getenv('DB_NAME') ?: getenv('MYSQL_DATABASE');
    $dbUser = getenv('DB_USER') ?: getenv('MYSQL_USER');
    $dbPass = getenv('DB_PASS') ?: getenv('MYSQL_PASSWORD');
    $dbPort = getenv('DB_PORT') ?: (getenv('MYSQL_PORT') ?: '3306');

    // If MySQL environment variables exist, attempt MySQL connection
    if ($dbHost && $dbName && $dbUser) {
        try {
            $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
            return $pdo;
        } catch (PDOException $e) {
            error_log("MySQL connection failed: " . $e->getMessage() . ". Falling back to SQLite.");
        }
    }

    // Fallback: Local SQLite database for zero-config running
    try {
        $dataDir = __DIR__ . '/../data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }
        $sqliteFile = $dataDir . '/database.sqlite';
        $dsn = "sqlite:" . $sqliteFile;
        $pdo = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // Auto-create table if not exists in SQLite
        $createTableSql = "CREATE TABLE IF NOT EXISTS membership_applications (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            full_name TEXT NOT NULL,
            email TEXT NOT NULL,
            student_id TEXT,
            course TEXT NOT NULL,
            study_year TEXT NOT NULL,
            preferred_activity TEXT NOT NULL,
            experience_level TEXT NOT NULL,
            reason TEXT,
            form_purpose TEXT NOT NULL,
            consent INTEGER NOT NULL DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($createTableSql);

        return $pdo;
    } catch (PDOException $e) {
        error_log("SQLite connection failed: " . $e->getMessage());
        return null;
    }
}
