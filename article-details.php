<?php
require_once('init.php');

$page = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1;

include($db_path . '/articles-db.php');
require_once('plugins/modifier.trim.php');

$slug = $_GET['slug'];

$sql = "SELECT * FROM articles WHERE slug = :slug";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);

$smarty->assign('article', $article);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'articles');
$smarty->assign('page', $page);

$smarty->registerPlugin('modifier', 'trim', 'smarty_modifier_trim');

$smarty->display('article-details.tpl');
?>