<?php
require_once('init.php');
require_once('functions.php');
include('cache-books.php');

$searchTerm = isset($_GET['searchTerm']) ? urldecode($_GET['searchTerm']) : '';

if (preg_match('/\d/', $searchTerm)) {
$searchTerm = str_replace(' ', '', $searchTerm);
}
$searchTerm = str_replace(['1st', '2nd', '3rd'], ['1', '2', '3'], $searchTerm);

$previous_search = isset($_GET['previous_search']) ? trim(htmlspecialchars($_GET['previous_search'], ENT_QUOTES, 'UTF-8')) : '';
$previous_search = str_replace(" ","", $previous_search);

$old_testament = [
    1 => 'Genesis',
    'Exodus',
    'Leviticus',
    'Numbers',
    'Deuteronomy',
    'Joshua',
    'Judges',
    'Ruth',
    '1 Samuel',
    '2 Samuel',
    '1 Kings',
    '2 Kings',
    '1 Chronicles',
    '2 Chronicles',
    'Ezra',
    'Nehemiah',
    'Esther',
    'Job',
    'Psalm',
    'Proverbs',
    'Ecclesiastes',
    'Song of Solomon',
    'Isaiah',
    'Jeremiah',
    'Lamentations',
    'Ezekiel',
    'Daniel',
    'Hosea',
    'Joel',
    'Amos',
    'Obadiah',
    'Jonah',
    'Micah',
    'Nahum',
    'Habakkuk',
    'Zephaniah',
    'Haggai',
    'Zechariah',
    'Malachi'
];

$new_testament = [
    40 => 'Matthew',
    'Mark',
    'Luke',
    'John',
    'Acts',
    'Romans',
    '1 Corinthians',
    '2 Corinthians',
    'Galatians',
    'Ephesians',
    'Philippians',
    'Colossians',
    '1 Thessalonians',
    '2 Thessalonians',
    '1 Timothy',
    '2 Timothy',
    'Titus',
    'Philemon',
    'Hebrews',
    'James',
    '1 Peter',
    '2 Peter',
    '1 John',
    '2 John',
    '3 John',
    'Jude',
    'Revelation'
];

$bookname = $old_testament + $new_testament;

$bookname_nospaces = str_replace(" ", "", $bookname);

$bookTitleList_nospaces = str_replace(" ", "", $bookTitleList);
 

if ($_GET) {
    $parts = preg_split('/\s*:\s*/', trim($searchTerm, " ;"));
    
    $book = [
        'name' => "",
        'chapter' => "",
        'verses' => []
    ];
    
    if (isset($parts[0])) {
        preg_match('/(\d+)\s*$/', $parts[0], $out);
        $book['chapter'] = rtrim($out[1] ?? "");
        $book['name'] = trim(preg_replace('/\d+\s*$/', "", $parts[0]));
    }
    
    if (isset($parts[1])) {
        $book['verses'] = preg_split('/\s*,\s*/', $parts[1]);
    }
}

if (isset($chapter_ext)) {
    preg_match('/(\d+)(?::\s*(\d+)(?:-(\d+))?)?/', $chapter_ext, $matches);

    if (isset($matches[1])) {
        $book['chapter'] = $matches[1];
    }

    if (isset($matches[2])) {
        $start_verse = intval($matches[2]);
        $end_verse = isset($matches[3]) ? intval($matches[3]) : $start_verse;

        // Use a simple verse or verse range format
        $verse_format = ($start_verse === $end_verse) ? $start_verse : $start_verse . '-' . $end_verse;
        $book['verses'][] = $verse_format;
    }
}

$holyBook = isset($book['name']) ? $book['name'] : "";
$chapter = isset($book['chapter']) ? $book['chapter'] : "";
$verses = isset($book['verses'][0]) ? $book['verses'][0] : "";

        //Remembers book that you're currently searching.
        if (isset($previous_search) && $holyBook == "") {
            $holyBook = $previous_search;
        }

if (empty($chapter)) {
    $chapter = "1";
}

if (array_find($holyBook, $bookname_nospaces)) {
    
    $key = array_find($holyBook, $bookname_nospaces);
    $find_book = $bookname[$key];
    
} 
elseif (array_find($holyBook, $bookTitleList_nospaces)) {
    
    $key = array_find($holyBook, $bookTitleList_nospaces);
    $find_book = $bookname[$key];

} else {
    header('Location: ' . $website . 'search-results.php?searchTerm=' . urlencode($searchTerm) . '&page=1');
    exit();
}

$find_book = preg_replace('/\s+/', '+', $find_book);
$find_book = strtolower($find_book);

if (empty($book['verses'])) {
    header('Location: ' . $website . 'bible/' . $selectedVersion .'/' . $find_book . '/' . $chapter);
    exit();
} else {
    header('Location: ' . $website . 'bible/' . $selectedVersion .'/' . $find_book . '/' . $chapter . '/' . $verses);
    exit();
}
?>

