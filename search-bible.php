<?php
require_once('init.php');
require_once('functions.php');
require_once('plugins/modifier.truncate_special.php');
require_once('bible-books.php');

$_SESSION['previous_url'] = $_SERVER['REQUEST_URI'];
$_SESSION['page'] = $_SERVER['REQUEST_URI'];

$book = isset($_GET['book']) ? htmlentities(trim($_GET['book']), ENT_QUOTES, 'UTF-8') : '';
$chapter = isset($_GET['chapter']) ? preg_replace("/[^0-9]/", "", $_GET['chapter']) : '1';
$chapter = htmlentities($chapter, ENT_QUOTES, 'UTF-8');
$verse = isset($_GET['verse']) ? htmlentities(trim($_GET['verse']), ENT_QUOTES, 'UTF-8') : '';

$holy_book = str_replace(' ', '', $book);

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