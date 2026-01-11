<?php
require_once('init.php');
require_once('plugins/modifier.truncate_special.php');
require_once('bible-books.php');

$book = isset($_GET['book']) ? trim($_GET['book']) : 'Genesis';
$max = isset($_GET['max']) ? trim($_GET['max']) : '50';
$key = isset($_GET['key']) ? trim($_GET['key']) : '1';
$i = "1";

$smarty->registerPlugin('modifier', 'truncate_special', 'smarty_modifier_truncate_special');
$smarty->assign('book', $book);
$smarty->assign('max', $max);
$smarty->assign('i', $i);
$smarty->assign('key', $key);
$smarty->assign('bookname', $bookname);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'bible');

echo $smarty->fetch('book-search.tpl');
?>