<?php
require_once('init.php');

$smarty->assign('activePage', 'setup');
$smarty->assign('website', $website);
$smarty->display('get-started.tpl');
?>