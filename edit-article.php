<?php
require_once('init.php');

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'demo'])) {
    header("Location: unauthorized");
    exit;
}

include($db_path . '/articles-db.php');

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    $query = "SELECT * FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->execute();

    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$article) {
        die("Article not found!");
    }

    $smarty->assign('article', $article);
} else {
    die("No article ID provided.");
}

$smarty->assign('website', $website);
$smarty->assign('activePage', 'admin');

$smarty->display('edit-article.tpl');
?>