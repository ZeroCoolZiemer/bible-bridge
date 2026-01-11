<?php
require_once('init.php');
include('cache-books.php');
require_once('bible-books.php');

$smarty->assign('newTestamentBooks', $new_testament);
$smarty->assign('bookTitleList', $bookTitleList);
$smarty->assign('max_chapters', $max_chapters);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'bible');

$smarty->display('new-testament.tpl');
?>
