<?php
require_once('init.php');

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin'])) {
    header("Location: unauthorized");
    exit;
}

include($db_path . '/articles-db.php');
include_once('slug-functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = $_POST['id'];
    $title = $_POST['title'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $meta_description = $_POST['meta_description'];
    $date = $_POST['date'];

    $slug = generateSlug($title);

    $content = str_replace("<p><br></p>", "", $content);

    $query = "UPDATE articles SET title = :title, slug = :slug, excerpt = :excerpt, content = :content, meta_description = :meta_description, date = :date WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':excerpt', $excerpt);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':meta_description', $meta_description);
    $stmt->bindParam(':date', $date);

    if ($stmt->execute()) {
        header("Location: /article/" . urlencode($slug));
        exit();
    } else {
        echo "Error updating article.";
    }
}
?>
