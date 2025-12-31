<?php
$dbname = 'holy_bible_articles'; //DO NOT EDIT THIS LINE
$username = ''; //user
$password = ''; //pass

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    error_log('Article Database connection failed: ' . $e->getMessage());
    echo 'Article Database connection failed. Please try again later.';
}
?>