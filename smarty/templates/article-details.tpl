<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$article.title} - BibleBridge</title>
    <meta name="description" content="{if $article.meta_description}{$article.meta_description}{else}{if isset($article.content)}{$article.content|strip_tags|trim|truncate:158}{/if}{/if}">
    {include file="bootstrap-head.tpl"}
    <link href="/css/footer.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
    .ql-editor p {
        margin-bottom: 1em;
    }
    </style>
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div style="padding-top: 0.5rem;" class="container-fluid">
        <div class="row">
            <div class="col-md-12 ms-2 mt-2">
                <nav>
                    <ol class="breadcrumb d-print-none" style="margin-bottom:0">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="/articles{if isset($page) && $page != 1}/{$page}{/if}">Articles</a></li>
                        {include file="share-url.tpl"}
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container mt-4 px-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-9">
                <h1 class="text-center">{$article.title}</h1>
                <p class="text-start"><small>Published on: {$article.date|date_format:"%B %e, %Y"}</small></p>
                <div class="article-content">
                    <div class="ql-editor">{$article.content|unescape:"html"}</div>
                </div>
                <div class="text-center">
                    <a href="/articles{if isset($page) && $page != 1}/{$page}{/if}" class="btn btn-sm btn-dark d-print-none">Back to Articles</a>
                </div>
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/share-url.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>