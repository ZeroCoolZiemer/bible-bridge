<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'demo'])) {
    header("Location: unauthorized");
    exit;
}

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/articles-db.php');
include_once('slug-functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SESSION['role'] === 'demo') {
        header("Location: unauthorized");
        exit;
    }

    $title = $_POST['title'];
    $excerpt = $_POST['excerpt'];
    $content = $_POST['content'];
    $meta_description = $_POST['meta_description'];
    $date = $_POST['date'];

    $slug = generateSlug($title);

    $content = str_replace('<p><br></p>', '', $content);

    if (!empty($title) && !empty($excerpt) && !empty($content) && !empty($date)) {
        try {
            $query = "INSERT INTO articles (title, slug, excerpt, content, meta_description, date) 
                      VALUES (:title, :slug, :excerpt, :content, :meta_description, :date)";
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':slug', $slug);
            $stmt->bindParam(':excerpt', $excerpt);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':meta_description', $meta_description);
            $stmt->bindParam(':date', $date);

            $stmt->execute();

            $smarty->assign('message', '<div class="alert alert-success d-inline-block" role="alert">Article added successfully!</div>');
        } catch (PDOException $e) {
            $smarty->assign('message', 'Error: ' . $e->getMessage());
        }
    } else {
        $smarty->assign('message', '<div class="alert alert-danger d-inline-block" role="alert">Please fill in all fields.</div>');
    }
}

$smarty->assign('website', $website);
$smarty->assign('activePage', 'admin');

$smarty->display('create-article.tpl');
?>