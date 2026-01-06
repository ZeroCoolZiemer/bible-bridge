<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{if isset($bookname[$key])}{$bookname[$key]}{/if} {if isset($chapter)}{$chapter}: Scripture{/if} - BibleBridge</title>
    <meta name="description" content="{$description = $jesus[0].$verseTextColumn|strip_tags|cat:' '|cat:$jesus[1].$verseTextColumn|strip_tags}{$description|truncate:158}">
    {if !empty($key) AND $key < 40} <meta name="keywords" content="Old Testament, Bible, Scripture, Covenant, Prophecy, Wisdom, Faith, Redemption, Holiness, Creation, Kingship, Deliverance, Exile, Restoration, Mercy, Love, Judgment">
        {elseif !empty($key) AND $key > 39}
        {/if}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="/css/footer.css" rel="stylesheet">
        {include file="fonts.tpl"}
        {include file="favicon.tpl"}
</head>

<body lang="en" class="body-text">
    {include file="menu.tpl"}
    <div style="padding-top: 0.5rem;" class="container-fluid">
        <div class="row">
            <div class="col-md-12 ms-2 mt-2">
                <nav class="d-print-none">
                    <ol class="breadcrumb" style="margin-bottom:0">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Home</a></li>
                        {if empty($Error)}
                        <li class="breadcrumb-item">
                            {if !empty($key) AND $key < 40} <a class="text-decoration-none" href="/bible/{$selectedVersion}/old-testament">OT</a>
                                {/if}
                                {if !empty($key) AND $key > 39}
                                <a class="text-decoration-none" href="/bible/{$selectedVersion}/new-testament">NT</a>
                                {/if}
                        </li>
                        <li class="breadcrumb-item">
                            {if $max_chapters[$key] > 1}
                            <a class="text-decoration-none" href="{$website}book-search.php?book={$foreign|lower|replace:' ':'+'}&max={$max_chapters[$key]}&key={$key}">
                                {$book|capitalize|truncate_special} {$chapter} <i>of {$max_chapters[$key]}</i>
                            </a>
                            {else}
                            <span class="text-black">{$book|capitalize|truncate_special} {$chapter} <i>of {$max_chapters[$key]}</i></span>
                            {/if}
                        </li>
                        {/if}
                        {if empty($Error)}
                        {include file="share-url.tpl"}
                        {/if}
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-center mt-3 mb-3 d-print-none">
            <form id="babel" action="{$website}search-process.php" class="d-flex">
                <button type="button" onclick="startDictation()" class="btn btn-light rounded-end-0"><i class="bi bi-mic-fill"></i></button>
                <input autocomplete="off" name="searchTerm" id="word" class="form-control rounded-start-0 rounded-end-0" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                <input type="hidden" name="previous_search" value="{$bookname[$key]}">
                <input type="hidden" id="userId" value="{$smarty.session.user|default:''}">
                <button type="submit" class="btn btn-light rounded-start-0"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="p-3">
                    {foreach from=$jesus item=row}
                    {assign var=foreign value=$row[$bookColumn]}
                    {if $row@first}
		    {include file="notes.tpl"}
                    <div id="topBar" class="d-flex justify-content-between flex-fill p-1 border rounded bg-light d-print-none">
                        <div class="p-1">
                            {if $chapter eq 1}
                            <a style="{if ($bookname[$key]|lower) == "genesis"}visibility:hidden;{/if}" href="{if ($bookname[$key]|lower) neq "genesis"}{$website}bible/{$selectedVersion}/{$bookname[$key-1]|lower|replace:" ":"+"}/{$max_chapters[$key-1]}{/if}" class="btn btn-dark btn-sm text-nowrap">PREV</a>
                            {/if}
                            {if $chapter != 1}
                            <a href="{$website}bible/{$selectedVersion}/{$bookname[$key]|lower|replace:" ":"+"}/{$chapter-1}" class="btn btn-dark btn-sm text-nowrap">PREV</a>
                            {/if}
                        </div>
			<div class="p-1 d-flex align-items-center">
			    <a data-bs-placement="bottom" id="myBookmark" href="javascript:void(0)"><i style="color:#aa002b;" class="bi bi-bookmark-fill"></i></a>
                        </div>
                        <div class="p-1">
                            {if $chapter != $max}
                            <a href="{$website}bible/{$selectedVersion}/{$bookname[$key]|lower|replace:" ":"+"}/{$chapter+1}" class="btn btn-dark btn-sm text-nowrap">NEXT</a>
                            {/if}
                            {if $chapter eq $max}
                            <a style="{if ($bookname[$key]|lower) == "revelation"}visibility:hidden;{/if}" href="{if ($book|lower) neq "revelation"}{$website}bible/{$selectedVersion}/{$bookname[$key+1]|lower|replace:" ":"+"}/1{/if}" class="btn btn-dark btn-sm text-nowrap">NEXT</a>
                            {/if}
                        </div>
                    </div>
                    <div class="page-header text-center pb-2 mt-4 mb-2">
                        <h1><span id="bookName" class="book-name">{$row[$bookNameColumn]}</span> <span id="chapterNumber">{$chapter}</span>{if isset($verse) AND $verse != ""}:{$verse}{/if}</h1>
                    </div>
                    {/if}
                    <p class="verses"><span class="verseNumber">{$row[$verseColumn]}</span> {$row[$verseTextColumn]}</p>
                    {if $row@last}
                    <div class="text-center mb-3">
                        {if $verse != ""}
                        <a class="btn btn-dark btn-sm d-print-none" href="{$website}bible/{$selectedVersion}/{if isset($bookname[$key])}{$bookname[$key]|lower|replace:" ":"+"}{/if}/{if isset($chapter)}{$chapter}{/if}"> <i class="bi bi-list"></i> Context
                        </a>
                        {/if}
                    </div>
                    <div id="bottomBar" class="d-flex justify-content-between flex-fill p-1 border rounded bg-light d-print-none">
                        <div class="p-1">
                            {if $chapter eq 1 AND ($bookname[$key]|lower) != "genesis"}
                            <a href="{$website}bible/{$selectedVersion}/{$bookname[$key-1]|lower|replace:" ":"+"}/{$max_chapters[$key-1]}" class="btn btn-dark btn-sm text-nowrap">PREV</a>
                            {/if}
                            {if $chapter != 1}
                            <a href="{$website}bible/{$selectedVersion}/{$bookname[$key]|lower|replace:" ":"+"}/{$chapter-1}" class="btn btn-dark btn-sm text-nowrap">PREV</a>
                            {/if}
                        </div>
			<div class="p-1 d-flex align-items-center">
			<div class="dropdown">
			<a id="settings" href="javascript:void(0)" class="btn btn-sm btn-dark me-2" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-gear"></i></a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="javascript:void(0)" onclick="changeFontSize(1)"><i class="bi bi-type"></i><i class="bi bi-plus"></i></a></li>
    				<li><a class="dropdown-item" href="javascript:void(0)" onclick="changeFontSize(-1)"><i class="bi bi-type"></i><i class="bi bi-dash"></i></a></li>
					<li><hr class="dropdown-divider"></li>
    				<li><a class="dropdown-item" href="javascript:void(0)" data-color="#8A4B3A">Burnt Umber</a></li>
    				<li><a class="dropdown-item" href="javascript:void(0)" data-color="#003366">Midnight Blue</a></li>
    				<li><a class="dropdown-item" href="javascript:void(0)" data-color="#444444">Charcoal Gray</a></li>
    				<li><a class="dropdown-item" href="javascript:void(0)" data-color="#2C6E3F">Deep Forest Green</a></li>
    				<li><a class="dropdown-item" href="javascript:void(0)" data-color="#000000">Black</a></li>
			</ul>
			</div>
			{if isset($smarty.session.user)}
			<a href="#" class="btn btn-sm btn-dark chapter-link" data-bs-toggle="modal" data-bs-target="#notesModal"><i class="bi bi-journal-text"></i></a>                     
			{/if}
			</div>
                        <div class="p-1">
                            {if $chapter != $max}
                            <a href="{$website}bible/{$selectedVersion}/{$bookname[$key]|lower|replace:" ":"+"}/{$chapter+1}" class="btn btn-dark btn-sm text-nowrap">NEXT</a>
                            {/if}
                            {if $chapter eq $max AND ($bookname[$key]|lower) neq "revelation"}
                            <a href="{$website}bible/{$selectedVersion}/{$bookname[$key+1]|lower|replace:" ":"+"}/1" class="btn btn-dark btn-sm text-nowrap">NEXT</a>
                            {/if}
                        </div>
                    </div>
                    {/if}
                    {foreachelse}
                    {if !empty($Error)}
                    <div class="row justify-content-center">
                        <div class="col-md-4 text-center">
                            <div class="alert alert-danger text-center d-inline-block" role="alert">{if isset($Error)}{$Error}{/if}</div>
                        </div>
                    </div>
                    {/if}
                    {/foreach}
                </div>
            </div>
        </div>
        {if empty($Error)}
        <p class="text-center text-muted d-print-none"><small>The Holy Bible, King James Version.</small> <i class="fab fa-creative-commons-pd-alt"></i></p>
        {/if}
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/speech.js"></script>
    <script src="/js/share-url.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
    {include file="jquery.tpl"}
    <script src="/js/notes.js"></script>
    <script src="/js/textCustomizer.js"></script>
</body>

</html>