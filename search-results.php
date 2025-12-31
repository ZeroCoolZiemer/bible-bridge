<?php
session_start();

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/connect.php');
require_once('plugins/modifier.highlight.php');

$filter  = isset($_GET['filter']) ? trim($_GET['filter']) : '';

$bookArray = array(1=>'Genesis','Exodus','Leviticus','Numbers','Deuteronomy','Joshua','Judges','Ruth','1 Samuel','2 Samuel','1 Kings','2 Kings','1 Chronicles','2 Chronicles','Ezra','Nehemiah','Esther','Job','Psalm','Proverbs','Ecclesiastes','Song of Solomon','Isaiah','Jeremiah','Lamentations','Ezekiel','Daniel','Hosea','Joel','Amos','Obadiah','Jonah','Micah','Nahum','Habakkuk','Zephaniah','Haggai','Zechariah','Malachi','Matthew','Mark','Luke','John','Acts','Romans','1 Corinthians','2 Corinthians','Galatians','Ephesians','Philippians','Colossians','1 Thessalonians','2 Thessalonians','1 Timothy','2 Timothy','Titus','Philemon','Hebrews','James','1 Peter','2 Peter','1 John','2 John','3 John','Jude','Revelation');

try {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $resultsPerPage = 10;
    $offset = ($page - 1) * $resultsPerPage;
    $limit = $resultsPerPage;

    $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
    $searchTermWithWildcards = "%".$searchTerm."%";

    $bookFilter = isset($_GET['filter']) ? $_GET['filter'] : '';

    $countQuery = "SELECT COUNT(*) FROM $tableName WHERE $verseTextColumn LIKE :searchTerm";
    if (!empty($bookFilter)) {
        $countQuery .= " AND $bookColumn = :book";
    }

    $countStmt = $db->prepare($countQuery);
    $countStmt->bindParam(':searchTerm', $searchTermWithWildcards, PDO::PARAM_STR);
    if (!empty($bookFilter)) {
        $countStmt->bindParam(':book', $bookFilter, PDO::PARAM_STR);
    }
    $countStmt->execute();
    $totalRows = $countStmt->fetchColumn();
    $totalPages = ceil($totalRows / $resultsPerPage);
} catch (PDOException $e) {
    die("Database Error (Count Query): " . $e->getMessage());
}

try {
    $getRows_english = "SELECT * FROM $tableName WHERE $verseTextColumn LIKE :searchTerm";

    if (!empty($bookFilter)) {
        $getRows_english .= " AND $bookColumn = :book";
    }

    $getRows_english .= " LIMIT :offset, :limit";

    $stmt = $db->prepare($getRows_english);
    $stmt->bindParam(':searchTerm', $searchTermWithWildcards, PDO::PARAM_STR);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    if (!empty($bookFilter)) {
        $stmt->bindParam(':book', $bookFilter, PDO::PARAM_STR);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Error (Query Execution): " . $e->getMessage());
}

if (!empty($searchTerm)) {
$bookStmt = $db->prepare("SELECT $bookColumn, COUNT(*) as c FROM $tableName
 WHERE $verseTextColumn LIKE :searchTerm GROUP BY $bookColumn ORDER BY $bookIDColumn");
$bookStmt->bindParam(':searchTerm', $searchTermWithWildcards, PDO::PARAM_STR);
$bookStmt->execute();
$bookname = $bookStmt->fetchAll(PDO::FETCH_ASSOC);
}

$smarty->assign('filter', $filter);
$smarty->assign('results', $results);
$smarty->assign('bookname', $bookname);
$smarty->assign('bookArray', $bookArray);
$smarty->assign('bookColumn', $bookColumn);
$smarty->assign('chapterColumn', $chapterColumn);
$smarty->assign('verseColumn', $verseColumn);
$smarty->assign('totalPages', $totalPages);
$smarty->assign('currentPage', $page);
$smarty->assign('searchTerm', $searchTerm);
$smarty->assign('website', $website);
$smarty->assign('verseTextColumn', $verseTextColumn);
$smarty->assign('bookType', $bookType);
$smarty->assign('activePage', 'bible');

$smarty->registerPlugin('modifier', 'highlight', 'smarty_modifier_highlight');

$smarty->display('search-results.tpl');
?>