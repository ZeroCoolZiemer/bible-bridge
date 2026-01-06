<?php
$activeKey = $selectedVersion ?? ($default_bible ?? array_key_first($bibles));

if (!isset($bibles[$activeKey])) {
    die("Error: Bible version '$activeKey' not found in configuration.");
}

$activeConfig = $bibles[$activeKey];

try {
    $db = new PDO(
        "mysql:host=" . $activeConfig['dbHost'] . 
        ";dbname=" . $activeConfig['dbName'] . 
        ";charset=utf8mb4", 
        $activeConfig['dbUser'], 
        $activeConfig['dbPass']
    );
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $map = $activeConfig['mappings'];
    $tableName = $activeConfig['tableName'];
    $website = $activeConfig['website'];

} catch (PDOException $e) {
    error_log('Bible Database connection failed: ' . $e->getMessage());
    echo 'Bible database connection failed. Please try again later.';
    exit;
}
?>