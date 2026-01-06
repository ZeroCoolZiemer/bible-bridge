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
require_once('verses.php');

$articles_per_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $articles_per_page;

include($db_path . '/articles-db.php');
$query = "SELECT * FROM articles ORDER BY date DESC LIMIT :offset, :limit";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $articles_per_page, PDO::PARAM_INT);
$stmt->execute();

$articles = $stmt->fetchAll();

$total_query = "SELECT COUNT(*) FROM articles";
$total_result = $pdo->query($total_query);
$total_articles = $total_result->fetchColumn();
$total_pages = ceil($total_articles / $articles_per_page);

$smarty->assign('articles', $articles);
$smarty->assign('total_pages', $total_pages);
$smarty->assign('current_page', $page);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'admin');

$smarty->display('admin-dashboard.tpl');
?>