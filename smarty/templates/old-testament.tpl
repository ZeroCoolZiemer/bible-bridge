<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Testament</title>
    <meta name="description" content="">
    {include file="bootstrap-head.tpl"}
    <link href="/css/footer.css" rel="stylesheet">
    <link href="/css/columns.css" rel="stylesheet">
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div style="padding-top: 0.5rem;" class="container-fluid">
        <div class="row">
            <div class="col-md-12 ms-2 mt-2">
                <nav>
                    <ol class="breadcrumb" style="margin-bottom:0">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Home</a></li>
                        {if empty($Error)}
                        <li class="breadcrumb-item">
                            OT
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="/new-testament">NT</a>
                        </li>
                        {/if}
                        {include file="share-url.tpl"}
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Old Testament</h1>
        <div class="book-list">
            <div class="row row-cols-2 g-2">
                {foreach $oldTestamentBooks as $key => $book}
                <div class="col">
                    <div class="book-item">
                        <a class="link" href="{$website}bible/{$book|lower|replace:' ':'+'|replace:'psalms':'psalm'}/1" title="{$book}">{$bookTitleList[$key]}</a> <span class="badge bg-dark ms-2 rounded-pill">{$max_chapters[$key]}</span>
                    </div>
                </div>
                {/foreach}
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/share-url.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>