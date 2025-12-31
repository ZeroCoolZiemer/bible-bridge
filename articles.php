<?php
session_start();

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$_SESSION['currentPage'] = $currentPage;

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/articles-db.php');

$articlesPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $articlesPerPage;

$totalQuery = "SELECT COUNT(*) FROM articles";
$totalStmt = $pdo->prepare($totalQuery);
$totalStmt->execute();
$totalArticles = $totalStmt->fetchColumn();

$totalPages = ceil($totalArticles / $articlesPerPage);

$query = "SELECT * FROM articles ORDER BY date DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':limit', $articlesPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$smarty->assign('articles', $articles);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'articles');
$smarty->assign('currentPage', $page);
$smarty->assign('totalPages', $totalPages);

$smarty->display('articles.tpl');
?>
