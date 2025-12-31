<?php
session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin'])) {
    header("Location: unauthorized");
    exit;
}

if (function_exists('apcu_enabled') && apcu_enabled()) {
    echo "APCu is enabled!<br>";

    // Check if the cache key exists
    $cacheKey = 'book_titles_cache';
    $cachedData = apcu_fetch($cacheKey);

    if ($cachedData === false) {
        echo "Cache for '$cacheKey' does not exist or has expired.<br>";
    } else {
        echo "Cache for '$cacheKey' exists and is still valid.<br>";
        // Optionally, output the cached data
        print_r($cachedData);
    }
} else {
    echo "APCu is NOT enabled!";
}
?>