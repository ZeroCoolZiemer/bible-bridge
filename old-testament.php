<?php
require_once('init.php');
include('cache-books.php');

$oldTestamentBooks = [ 1=>
    'Genesis', 'Exodus', 'Leviticus', 'Numbers', 'Deuteronomy',
    'Joshua', 'Judges', 'Ruth', '1 Samuel', '2 Samuel',
    '1 Kings', '2 Kings', '1 Chronicles', '2 Chronicles', 'Ezra',
    'Nehemiah', 'Esther', 'Job', 'Psalms', 'Proverbs',
    'Ecclesiastes', 'Song of Solomon', 'Isaiah', 'Jeremiah', 'Lamentations',
    'Ezekiel', 'Daniel', 'Hosea', 'Joel', 'Amos',
    'Obadiah', 'Jonah', 'Micah', 'Nahum', 'Habakkuk',
    'Zephaniah', 'Haggai', 'Zechariah', 'Malachi'
];

$max_chapters = array( 1=> '50','40','27','36','34','24','21','4','31','24','22','25','29','36','10','13','10','42','150','31','12','8','66','52','5','48','12','14','3','9','1','4','7','3','3','3','2','14','4');

$smarty->assign('oldTestamentBooks', $oldTestamentBooks);
$smarty->assign('bookTitleList', $bookTitleList);
$smarty->assign('max_chapters', $max_chapters);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'bible');

$smarty->display('old-testament.tpl');
?>
