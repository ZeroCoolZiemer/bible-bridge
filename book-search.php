<?php
session_start();

require_once('smarty_loader.php');
require_once('functions.php');
require_once('settings.php');
require_once($path . '/config.php');
require_once('plugins/modifier.truncate_special.php');

$book = isset($_GET['book']) ? trim($_GET['book']) : 'Genesis';
$max = isset($_GET['max']) ? trim($_GET['max']) : '50';
$key = isset($_GET['key']) ? trim($_GET['key']) : '1';
$i = "1";
?>

<?php
$bookname = array(1=>'Genesis','Exodus','Leviticus','Numbers','Deuteronomy','Joshua','Judges','Ruth','1 Samuel','2 Samuel','1 Kings','2 Kings','1 Chronicles','2 Chronicles','Ezra','Nehemiah','Esther','Job','Psalm','Proverbs','Ecclesiastes','Song of Solomon','Isaiah','Jeremiah','Lamentations','Ezekiel','Daniel','Hosea','Joel','Amos','Obadiah','Jonah','Micah','Nahum','Habakkuk','Zephaniah','Haggai','Zechariah','Malachi','Matthew','Mark','Luke','John','Acts','Romans','1 Corinthians','2 Corinthians','Galatians','Ephesians','Philippians','Colossians','1 Thessalonians','2 Thessalonians','1 Timothy','2 Timothy','Titus','Philemon','Hebrews','James','1 Peter','2 Peter','1 John','2 John','3 John','Jude','Revelation');

$abbrev_bookname = array(1=>'Gen.','Ex.','Lev.','Num.','Deut.','Josh.','Judg.','Ruth','1 Sam.','2 Sam.','1 Kings','2 Kings','1 Chron.','2 Chron.','Ezra','Neh.','Est.','Job','Ps.','Prov','Eccles.','Song','Isa.','Jer.','Lam.','Ezek.','Dan.','Hos.','Joel','Amos','Obad.','Jonah','Mic.','Nah.','Hab.','Zeph.','Hag.','Zech.','Mal.','Matt','Mark','Luke','John','Acts','Rom.','1 Cor.','2 Cor.','Gal.','Eph.','Phil.','Col.','1 Thess.','2 Thess.','1 Tim.','2 Tim.','Titus','Philem.','Heb.','James','1 Pet.','2 Pet.','1 John','2 John','3 John','Jude','Rev');
?>

<?php
$smarty->registerPlugin('modifier', 'truncate_special', 'smarty_modifier_truncate_special');
$smarty->assign('book', $book);
$smarty->assign('max', $max);
$smarty->assign('i', $i);
$smarty->assign('key', $key);
$smarty->assign('bookname', $bookname);
$smarty->assign('abbrev_bookname', $abbrev_bookname);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'bible');

echo $smarty->fetch('book-search.tpl');
?>