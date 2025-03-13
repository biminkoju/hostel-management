<?php
// Database configuration
$sname = "localhost";
$uname = "bimin";
$password = "1234";
$dbname = "test";

// Enable strict error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish connection
    $conn = mysqli_connect($sname, $uname, $password, $dbname);

    // Set character set to UTF-8
    mysqli_set_charset($conn, 'utf8mb4');

} catch (mysqli_sql_exception $e) {
    // Log the error (in a production environment)
    error_log("Database connection failed: " . $e->getMessage());

    // User-friendly error message (doesn't reveal sensitive information)
    die("Database connection error. Please try again later or contact support.");
}