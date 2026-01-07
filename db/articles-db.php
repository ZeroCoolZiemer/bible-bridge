<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=holy_bible_articles;charset=utf8mb4", //DO NOT edit dbname
        "", //username
        "", //password
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    error_log('Article Database connection failed: ' . $e->getMessage());
}
?>
