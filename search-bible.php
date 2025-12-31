<?php
session_start();

$_SESSION['previous_url'] = $_SERVER['REQUEST_URI'];
require_once('smarty_loader.php');
require_once('functions.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/connect.php');
require_once('plugins/modifier.truncate_special.php');

$page = $_SERVER["REQUEST_URI"];
$_SESSION['page'] = $page;
?>

<?php
$book = isset($_GET['book']) ? trim($_GET['book']) : '';
$book = htmlentities($book, ENT_QUOTES, 'UTF-8');

//removes spaces from $book string.
$holy_book = str_replace(' ', '', $book);

//Old Testament & New Testament.
$bookname = array(1=>'Genesis','Exodus','Leviticus','Numbers','Deuteronomy','Joshua','Judges','Ruth','1 Samuel','2 Samuel','1 Kings','2 Kings','1 Chronicles','2 Chronicles','Ezra','Nehemiah','Esther','Job','Psalm','Proverbs','Ecclesiastes','Song of Solomon','Isaiah','Jeremiah','Lamentations','Ezekiel','Daniel','Hosea','Joel','Amos','Obadiah','Jonah','Micah','Nahum','Habakkuk','Zephaniah','Haggai','Zechariah','Malachi','Matthew','Mark','Luke','John','Acts','Romans','1 Corinthians','2 Corinthians','Galatians','Ephesians','Philippians','Colossians','1 Thessalonians','2 Thessalonians','1 Timothy','2 Timothy','Titus','Philemon','Hebrews','James','1 Peter','2 Peter','1 John','2 John','3 John','Jude','Revelation');

$bookname_abbrev = array(1=>'Gen.','Ex.','Lev.','Num.','Deut.','Josh.','Judg.','Ruth','1 Sam.','2 Sam.','1 Kings','2 Kings','1 Chron.','2 Chron.','Ezra','Neh.','Est.','Job','Ps.','Prov','Eccles.','Song','Isa.','Jer.','Lam.','Ezek.','Dan.','Hos.','Joel','Amos','Obad.','Jonah','Mic.','Nah.','Hab.','Zeph.','Hag.','Zech.','Mal.','Matt','Mark','Luke','John','Acts','Rom.','1 Cor.','2 Cor.','Gal.','Eph.','Phil.','Col.','1 Thess.','2 Thess.','1 Tim.','2 Tim.','Titus','Philem.','Heb.','James','1 Pet.','2 Pet.','1 John','2 John','3 John','Jude','Rev');

//Max # of Chapters in Bible books.
$max_chapters = array(1=>'50','40','27','36','34','24','21','4','31','24','22','25','29','36','10','13','10','42','150','31','12','8','66','52','5','48','12','14','3','9','1','4','7','3','3','3','2','14','4','28','16','24','21','28','16','16','13','6','6','4','4','5','3','6','4','3','1','13','5','5','3','5','1','1','1','22');

//removes spaces from $bookname.
$holy_bookname = str_replace(" ", "", $bookname);

if ((!empty($holy_book)) AND array_find($holy_book, $holy_bookname)) {
    $key       = array_find($holy_book, $holy_bookname);
    $find_book = $bookname[$key];
    $book      = $find_book;
    
    $smarty->assign('key', $key);
    $smarty->assign('book', $book);
}

$max     = $max_chapters[$key];
$chapter = isset($_GET['chapter']) ? trim($_GET['chapter']) : '1';
$chapter = preg_replace("/[^0-9]/", "", $chapter);
$chapter = htmlentities($chapter, ENT_QUOTES, 'UTF-8');
$verse   = isset($_GET['verse']) ? trim($_GET['verse']) : '';
$verse   = htmlentities($verse, ENT_QUOTES, 'UTF-8');
$jesus   = array();
$Error   = "";

$smarty->assign('chapter', $chapter);
$smarty->assign('verse', $verse);
$smarty->assign('jesus', $jesus);
$smarty->assign('Error', $Error);
$smarty->assign('bookname', $bookname);
$smarty->assign('bookname_abbrev', $bookname_abbrev);
$smarty->assign('max_chapters', $max_chapters);
$smarty->assign('max', $max);
?>

<?php
if (($_GET) AND array_find($holy_book, $holy_bookname)) {
    global $book, $bookname, $chapter, $verse;

    $book_query = "$book%";
    $book_numeric = array_search($book, $bookname);
    
    if ($verse === '') {
        // If no verses are given, TRUE will trick the database 
        // into returning all verses for the given book.
        $verseWhere = 'TRUE';
    } else {
        // Split it on the commas
        $verseRanges     = explode(',', $verse);
        $verseConditions = array();
        
        // Split each value on '-', if any
        foreach ($verseRanges as $verseRange) {
            $verseRange = explode('-', $verseRange);
            // Build a condition
            if (count($verseRange) === 1) {
                $verseConditions[] = "verse = " . (int) $verseRange[0];
            } else {
                $verseConditions[] = "verse BETWEEN " . (int) $verseRange[0] . " AND " . (int) $verseRange[1];
            }
        }
        // Implode the array to build a list of conditions
        $verseWhere = "(" . implode(' OR ', $verseConditions) . ")";
    }
    	$search_chapter = $db->prepare("SELECT * FROM $tableName
        	WHERE $bookIDColumn = :book_numeric
		AND $chapterColumn = :chapter 
        	AND $verseWhere 
        	ORDER BY $verseColumn");
    	$search_chapter->bindParam(':book_numeric', $book_numeric, PDO::PARAM_INT);
	} 	
	$search_chapter->bindParam(':chapter', $chapter, PDO::PARAM_STR);
	$search_chapter->execute();

	$jesus = [];

	while ($row = $search_chapter->fetch(PDO::FETCH_ASSOC)) {
    		$jesus[] = $row; 
    		$book = $row[$bookColumn];
                $foreign = $row[$bookColumn];
	}
	if (empty($jesus)) {
    		
	if (isset($chapter) AND $chapter > $max) {
        	$Error = "The book of " . $book . " contains " . $max . " " . (($max >= 2) ? "chapters." : "chapter.");
    		} else {
		$Error = "Your search did not return any results."; }
}
$smarty->assign('foreign', $foreign);
$smarty->assign('Error', $Error);
$smarty->assign('jesus', $jesus);
$smarty->assign('book', $book);

$search_chapter->closeCursor();
?>

<?php
$db = null;
unset($username, $password, $db_name, $tbl_name);
?>

<?php
$smarty->registerPlugin('modifier', 'truncate_special', 'smarty_modifier_truncate_special');
$smarty->assign('website', $website);
$smarty->assign('bookColumn', $bookColumn);
$smarty->assign('bookIDColumn', $bookIDColumn);
$smarty->assign('verseColumn', $verseColumn);
$smarty->assign('verseTextColumn', $verseTextColumn);
$smarty->assign('activePage', 'bible');
echo $smarty->fetch('search-bible.tpl');
?>