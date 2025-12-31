<?php
session_start();

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');

$smarty->assign('website', $website);
$smarty->assign('activePage', 'about');

$smarty->display('about.tpl');
?>

