<?php
$host = 'localhost';
$db = 'bcp_sms3_ems'; 
$user = 'root';  
$pass = '';  
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
    // Test connection
    $conn->query("SELECT 1");
    // echo "Connection successful!"; // Commented out for production
} catch (\PDOException $e) {
    error_log($e->getMessage()); // Log errors to file
    die("Database connection failed."); // User-friendly message
}
?>
