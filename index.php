<?php
require_once('init.php');

$smarty->assign('activePage', 'home');

$smarty->assign('website', $website);

$smarty->display('index.tpl');
?>
