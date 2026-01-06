<?php
require_once('init.php');

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}

include($db_path . '/articles-db.php');

$notes_per_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $notes_per_page;

$user_id = $_SESSION['user'];

$query = "SELECT id, bible_reference, note, created_at 
          FROM bible_notes 
          WHERE user_id = :user_id 
          ORDER BY created_at DESC
          LIMIT :offset, :limit";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $notes_per_page, PDO::PARAM_INT);
$stmt->execute();

$notes = $stmt->fetchAll();

$total_query = "SELECT COUNT(*) FROM bible_notes WHERE user_id = :user_id";
$total_stmt = $pdo->prepare($total_query);
$total_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$total_stmt->execute();
$total_notes = $total_stmt->fetchColumn();

$total_pages = ceil($total_notes / $notes_per_page);

$smarty->assign('notes', $notes);
$smarty->assign('total_pages', $total_pages);
$smarty->assign('current_page', $page);
$smarty->assign('activePage', 'user');
$smarty->assign('website', $website);

$smarty->display('user-dashboard.tpl');
?>
