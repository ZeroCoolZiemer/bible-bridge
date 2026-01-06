<?php
require_once('init.php');

$smarty->assign('website', $website);
$smarty->display('unauthorized.tpl');
?>