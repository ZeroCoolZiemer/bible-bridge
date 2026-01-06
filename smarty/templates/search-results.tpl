<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bible Search Results</title>
    <meta name="description" content="">
    {include file="bootstrap-head.tpl"}
    <link href="/css/footer.css" rel="stylesheet">
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
    <style>
        #bookFilter:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div style="padding-top: 0.5rem;" class="container-fluid">
        <div class="row">
            <div class="col-md-12 ms-2 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="margin-bottom:0">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search Results...</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container-fluid d-flex justify-content-center mt-2 mb-3">
            <form id="babel" action="{$website}search-process.php" class="d-flex">
                <button type="button" onclick="startDictation()" class="btn btn-light rounded-end-0">
                    <i class="bi bi-mic-fill"></i>
                </button>
                <input autocomplete="off" name="searchTerm" id="word" class="form-control rounded-start-0 rounded-end-0" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                <button type="submit" class="btn btn-light rounded-start-0"><i class="bi bi-search"></i></button>
            </form>
        </div>
        {if $results}
        <div class="container-fluid d-flex justify-content-center mb-3">
            <select class="form-select w-auto" id="filter" name="filter" onchange="bookFilter()">
                <option value="">The Holy Bible</option>
                {foreach from=$bookname item=row}
                <option value="{$row[$bookColumn]|lower}" {if $filter==$row[$bookColumn]|lower}selected{/if}> {if $bookType==="numbers" } {$row.$bookColumn} ({$row.c}) {else} {$row[$bookColumn]} ({$row.c}) {/if} </option> {/foreach} </select> </div> {/if} {if $results} <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Reference</th>
                                <th class="text-center">{if count($results) == 1}Verse{else}Verses{/if}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $results as $row}
                            <tr>
                                <td class="text-nowrap">{$row.$bookColumn} {$row[$chapterColumn]}:{$row[$verseColumn]}</td>
                                <td class="verses">{$row[$verseTextColumn]|highlight:$searchTerm}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
        </div>
        {* Pagination Links *}
        <nav>
            <ul class="pagination justify-content-center">
                {if $currentPage > 1}
                <li class="page-item">
                    <a class="page-link" href="?searchTerm={$searchTerm}&filter={$filter}&page={$currentPage-1}">Previous</a>
                </li>
                {/if}
                {if $totalPages > 1}
                <li class="page-item disabled">
                    <span class="page-link">Page {$currentPage} of {$totalPages}</span>
                </li>
                {/if}
                {if $currentPage < $totalPages} <li class="page-item">
                    <a class="page-link" href="?searchTerm={$searchTerm}&filter={$filter}&page={$currentPage+1}">Next</a>
                    </li>
                    {/if}
            </ul>
        </nav>
        {else}
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <div class="alert alert-danger text-center d-inline-block" role="alert">No results found!</div>
            </div>
        </div>
        {/if}
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {include file="jquery.tpl"}
    <script src="{$website}js/speech.js"></script>
    <script>
    function bookFilter() {
        var websiteFilter = "{$website}search-results.php?searchTerm={$searchTerm|replace:' ':'+'}&page=1&filter=";
        var index = document.getElementById("filter").selectedIndex;
        var e = document.getElementById("filter");
        var filter = e.options[e.selectedIndex].value.toLowerCase();

        if (index > 0) {
            window.location.href = websiteFilter + filter.replace(/ /g, '+');
        } else {
            window.location.href = websiteFilter + filter;
        }
    }
    </script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
    <script src="{$website}js/textCustomizer.js"></script>
</body>

</html>