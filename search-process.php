<?php
require_once('init.php');
require_once('functions.php');
include('cache-books.php');
require_once('bible-books.php');

$searchTerm = isset($_GET['searchTerm']) ? urldecode($_GET['searchTerm']) : '';

if (preg_match('/\d/', $searchTerm)) {
$searchTerm = str_replace(' ', '', $searchTerm);
}

$searchTerm = str_ireplace(['first', 'second', 'third'], ['1', '2', '3'], $searchTerm);

$searchTerm = str_replace(['1st', '2nd', '3rd'], ['1', '2', '3'], $searchTerm);

$previous_search = isset($_GET['previous_search']) ? trim(htmlspecialchars($_GET['previous_search'], ENT_QUOTES, 'UTF-8')) : '';
$previous_search = str_replace(" ","", $previous_search);

$bookname_nospaces = str_replace(" ", "", $bookname);

$bookTitleList_nospaces = str_replace(" ", "", $bookTitleList);

$aliases_nospaces = str_replace(" ", "", $aliases);

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

}
elseif (array_find($holyBook, $aliases_nospaces)) {
    $key = array_find($holyBook, $aliases_nospaces);
    $find_book = $bookname[$key];
} else {
    header('Location: ' . $website . 'search-results.php?searchTerm=' . urlencode($searchTerm) . '&page=1');
    exit();
}

$find_book = strtolower($find_book);

$urlEncodedVersion = urlencode($selectedVersion);
$urlEncodedBook    = urlencode($find_book);
$chapterInt        = (int) $chapter;
$urlEncodedVerses  = urlencode($verses);

if (empty($book['verses'])) {
    header('Location: ' . $website . 'bible/' . $urlEncodedVersion .'/' . $urlEncodedBook . '/' . $chapterInt);
    exit();
} else {
    header('Location: ' . $website . 'bible/' . $urlEncodedVersion .'/' . $urlEncodedBook . '/' . $chapterInt . '/' . $urlEncodedVerses);
    exit();
}
?>
