<?php
session_start();

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include_once($db_path . '/articles-db.php');

$smarty->assign('activePage', 'home');

$sql = "SELECT * FROM articles ORDER BY date DESC LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$smarty->assign('website', $website);
$smarty->assign('articles', $articles);
$smarty->display('index.tpl');
?>

