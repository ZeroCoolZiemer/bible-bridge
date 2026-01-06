<?php
require_once('init.php');
include('cache-books.php');

$newTestamentBooks = [ 40 =>
    'Matthew', 'Mark', 'Luke', 'John', 'Acts',
    'Romans', '1 Corinthians', '2 Corinthians', 'Galatians', 'Ephesians',
    'Philippians', 'Colossians', '1 Thessalonians', '2 Thessalonians', '1 Timothy',
    '2 Timothy', 'Titus', 'Philemon', 'Hebrews', 'James',
    '1 Peter', '2 Peter', '1 John', '2 John', '3 John',
    'Jude', 'Revelation'
];

$max_chapters = array(40 => '28','16','24','21','28','16','16','13','6','6','4','4','5','3','6','4','3','1','13','5','5','3','5','1','1','1','22');

$smarty->assign('newTestamentBooks', $newTestamentBooks);
$smarty->assign('bookTitleList', $bookTitleList);
$smarty->assign('max_chapters', $max_chapters);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'bible');

$smarty->display('new-testament.tpl');
?>