<?php
try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Bible Database connection failed: ' . $e->getMessage());
    echo 'Bible database connection failed. Please try again later.';
}
?>
