<?php
require_once('init.php');

$cacheKey = 'book_titles_cache_' . strtolower($selectedVersion);

if (function_exists('apcu_fetch')) {
    $bookTitleList = apcu_fetch($cacheKey);
    if ($bookTitleList === false) {
        $stmt = $db->prepare("SELECT DISTINCT $bookColumn FROM $tableName
            WHERE $bookIDColumn BETWEEN 1 AND 66
            ORDER BY $bookIDColumn");
        $stmt->execute();
        $bookRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bookTitleList = [];
        $index = 1;
        foreach ($bookRecords as $row) {
            $bookTitleList[$index++] = $row[$bookColumn];
        }

        apcu_store($cacheKey, $bookTitleList, 2592000);
    }
} else {
    $stmt = $db->prepare("SELECT DISTINCT $bookColumn FROM $tableName
        WHERE $bookIDColumn BETWEEN 1 AND 66
        ORDER BY $bookIDColumn");
    $stmt->execute();
    $bookRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $bookTitleList = [];
    $index = 1;
    foreach ($bookRecords as $row) {
        $bookTitleList[$index++] = $row[$bookColumn];
    }
}
?>