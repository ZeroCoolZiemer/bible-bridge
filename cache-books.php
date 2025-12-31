<?php
if (function_exists('apcu_store')) {
    $cacheKey = 'book_titles_cache';
    $bookTitleList = apcu_fetch($cacheKey);

    if ($bookTitleList === false) {
        $searchBooksQuery = $db->prepare("SELECT DISTINCT $bookColumn FROM $tableName
         WHERE $bookIDColumn BETWEEN 1 AND 66
         ORDER BY $bookIDColumn");

        $searchBooksQuery->execute();

        $bookRecords = $searchBooksQuery->fetchAll(PDO::FETCH_ASSOC);

        $bookTitleList = [];
        $index = 1;
        foreach ($bookRecords as $bookRecord) {
            $bookTitleList[$index] = $bookRecord[$bookColumn];
            $index++;
        }

        apcu_store($cacheKey, $bookTitleList, 2592000);
    }
} else {
    $searchBooksQuery = $db->prepare("SELECT DISTINCT $bookColumn FROM $tableName
         WHERE $bookIDColumn BETWEEN 1 AND 66
         ORDER BY $bookIDColumn");

    $searchBooksQuery->execute();

    $bookRecords = $searchBooksQuery->fetchAll(PDO::FETCH_ASSOC);

    $bookTitleList = [];
    $index = 1;
    foreach ($bookRecords as $bookRecord) {
        $bookTitleList[$index] = $bookRecord[$bookColumn];
        $index++;
    }
}
?>