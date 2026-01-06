<?php
require_once('init.php');
require_once('functions.php');
require_once('plugins/modifier.truncate_special.php');

$_SESSION['previous_url'] = $_SERVER['REQUEST_URI'];
$_SESSION['page'] = $_SERVER['REQUEST_URI'];

$book = isset($_GET['book']) ? htmlentities(trim($_GET['book']), ENT_QUOTES, 'UTF-8') : '';
$chapter = isset($_GET['chapter']) ? preg_replace("/[^0-9]/", "", $_GET['chapter']) : '1';
$chapter = htmlentities($chapter, ENT_QUOTES, 'UTF-8');
$verse = isset($_GET['verse']) ? htmlentities(trim($_GET['verse']), ENT_QUOTES, 'UTF-8') : '';

$holy_book = str_replace(' ', '', $book);

$bookname = array(
    1=>'Genesis','Exodus','Leviticus','Numbers','Deuteronomy','Joshua','Judges','Ruth','1 Samuel','2 Samuel',
    '1 Kings','2 Kings','1 Chronicles','2 Chronicles','Ezra','Nehemiah','Esther','Job','Psalm','Proverbs',
    'Ecclesiastes','Song of Solomon','Isaiah','Jeremiah','Lamentations','Ezekiel','Daniel','Hosea','Joel',
    'Amos','Obadiah','Jonah','Micah','Nahum','Habakkuk','Zephaniah','Haggai','Zechariah','Malachi','Matthew',
    'Mark','Luke','John','Acts','Romans','1 Corinthians','2 Corinthians','Galatians','Ephesians','Philippians',
    'Colossians','1 Thessalonians','2 Thessalonians','1 Timothy','2 Timothy','Titus','Philemon','Hebrews',
    'James','1 Peter','2 Peter','1 John','2 John','3 John','Jude','Revelation'
);

$bookname_abbrev = array(
    1=>'Gen.','Ex.','Lev.','Num.','Deut.','Josh.','Judg.','Ruth','1 Sam.','2 Sam.','1 Kings','2 Kings',
    '1 Chron.','2 Chron.','Ezra','Neh.','Est.','Job','Ps.','Prov','Eccles.','Song','Isa.','Jer.','Lam.',
    'Ezek.','Dan.','Hos.','Joel','Amos','Obad.','Jonah','Mic.','Nah.','Hab.','Zeph.','Hag.','Zech.',
    'Mal.','Matt','Mark','Luke','John','Acts','Rom.','1 Cor.','2 Cor.','Gal.','Eph.','Phil.','Col.',
    '1 Thess.','2 Thess.','1 Tim.','2 Tim.','Titus','Philem.','Heb.','James','1 Pet.','2 Pet.','1 John',
    '2 John','3 John','Jude','Rev'
);

$max_chapters = array(
    1=>'50','40','27','36','34','24','21','4','31','24','22','25','29','36','10','13','10','42','150',
    '31','12','8','66','52','5','48','12','14','3','9','1','4','7','3','3','3','2','14','4','28','16',
    '24','21','28','16','16','13','6','6','4','4','5','3','6','4','3','1','13','5','5','3','5','1','1',
    '1','22'
);

$holy_bookname = str_replace(' ', '', $bookname);

$key = array_find($holy_book, $holy_bookname);
$max = $key !== false ? $max_chapters[$key] : 1;

if ($key !== false) {
    $book = $bookname[$key];
    $smarty->assign([
        'key' => $key,
        'book' => $book,
        'chapter' => $chapter,
        'verse' => $verse,
        'bookname' => $bookname,
        'bookname_abbrev' => $bookname_abbrev,
        'max_chapters' => $max_chapters,
        'max' => $max,
    ]);
} else {
    $smarty->assign('Error', 'Invalid book selection.');
}

if ($key !== false) {
    $book_numeric = $key;
    $verseWhere = 'TRUE';
    if ($verse !== '') {
        $verseConditions = [];
        foreach (explode(',', $verse) as $range) {
            $parts = explode('-', $range);
            $verseConditions[] = count($parts) === 1
                ? "verse = " . (int)$parts[0]
                : "verse BETWEEN " . (int)$parts[0] . " AND " . (int)$parts[1];
        }
        $verseWhere = '(' . implode(' OR ', $verseConditions) . ')';
    }

    $search_chapter = $db->prepare(
        "SELECT * FROM $tableName
         WHERE {$map['bookIDColumn']} = :book_numeric
           AND {$map['chapterColumn']} = :chapter
           AND $verseWhere
         ORDER BY {$map['verseColumn']}"
    );
    $search_chapter->bindParam(':book_numeric', $book_numeric, PDO::PARAM_INT);
    $search_chapter->bindParam(':chapter', $chapter, PDO::PARAM_STR);
    $search_chapter->execute();

    $jesus = [];
    $foreign = '';
    while ($row = $search_chapter->fetch(PDO::FETCH_ASSOC)) {
        $jesus[] = $row;
        $book = $row[$map['bookColumn']];
        $foreign = $row[$map['bookColumn']];
    }

    if (empty($jesus)) {
        $Error = ($chapter > $max)
            ? "The book of $book contains $max " . ($max > 1 ? "chapters." : "chapter.")
            : "Your search did not return any results.";
        $smarty->assign('Error', $Error);
    }

    $smarty->assign([
        'jesus' => $jesus,
        'foreign' => $foreign,
        'book' => $book
    ]);

    $search_chapter->closeCursor();
}

$db = null;
unset($username, $password, $db_name, $tbl_name);

$smarty->registerPlugin('modifier', 'truncate_special', 'smarty_modifier_truncate_special');
$smarty->assign([
    'website' => $website,
    'activePage' => 'bible'
]);

echo $smarty->fetch('search-bible.tpl');
?>