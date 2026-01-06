<?php
session_start();

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');

$bibles = array_change_key_case($bibles, CASE_LOWER);

$requestedVersion = '';
if (!empty($_GET['v'])) {
    $requestedVersion = strtolower(trim($_GET['v']));
} elseif (!empty($_COOKIE['bible_version'])) {
    $requestedVersion = strtolower(trim($_COOKIE['bible_version']));
}

if (!empty($requestedVersion) && isset($bibles[$requestedVersion])) {
    $selectedVersion = $requestedVersion;
} else {
    $selectedVersion = array_key_first($bibles);
}

$_SESSION['active_bible'] = $selectedVersion;
setcookie('bible_version', $selectedVersion, time() + (86400 * 30), '/');

$activeConfig = $bibles[$selectedVersion];

require_once($db_path . '/connect.php');

$map             = $activeConfig['mappings'];
$bookIDColumn    = $map['bookIDColumn'];
$bookColumn      = $map['bookColumn'];
$chapterColumn   = $map['chapterColumn'];
$verseColumn     = $map['verseColumn'];
$verseTextColumn = $map['verseTextColumn'];

$smarty->assign('bibles', $bibles);
$smarty->assign('selectedVersion', $selectedVersion);
$smarty->assign('activeConfig', $activeConfig);
$smarty->assign('website', $activeConfig['website']);

$smarty->assign('tableName', $activeConfig['tableName']);
$smarty->assign('map', $map);
$smarty->assign('bookIDColumn', $bookIDColumn);
$smarty->assign('bookColumn', $bookColumn);
$smarty->assign('chapterColumn', $chapterColumn);
$smarty->assign('verseColumn', $verseColumn);
$smarty->assign('verseTextColumn', $verseTextColumn);

$smarty->assign('bookNameColumn', $bookColumn);
?>