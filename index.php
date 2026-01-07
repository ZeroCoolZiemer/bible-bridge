<?php
require_once('init.php');

if (isset($db_path) && file_exists($db_path . '/articles-db.php')) {
    include_once($db_path . '/articles-db.php');
}

$smarty->assign('activePage', 'home');

$articles = [];
$usingJson = false;

if (isset($pdo) && $pdo instanceof PDO) {
    try {
        $stmt = $pdo->query("SHOW TABLES LIKE 'articles'");
        if ($stmt && $stmt->rowCount() > 0) {
            $stmt = $pdo->prepare("SELECT * FROM articles ORDER BY date DESC LIMIT 3");
            $stmt->execute();
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        // silently ignore DB errors
    }
}

if (empty($articles)) {
    $jsonFile = __DIR__ . '/data/articles.json';
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $jsonContent = preg_replace('/^\x{FEFF}/u', '', $jsonContent);
        $jsonContent = mb_convert_encoding($jsonContent, 'UTF-8', 'UTF-8');
        $decoded = json_decode($jsonContent, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $articles = $decoded;
            $usingJson = true;
        } else {
            $articles = [];
        }
    }
}

$smarty->assign('articles', $articles);
$smarty->assign('using_json', $usingJson);
$smarty->assign('website', $website);

$smarty->display('index.tpl');
?>
