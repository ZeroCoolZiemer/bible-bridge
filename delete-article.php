<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin'])) {
    header("Location: unauthorized");
    exit;
}

require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/articles-db.php');

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];

    $query = "DELETE FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header('Location: admin-dashboard');
        exit;
    } else {
        echo "Error: Could not delete the article.";
    }
} else {
    echo "No article ID provided.";
}
?>