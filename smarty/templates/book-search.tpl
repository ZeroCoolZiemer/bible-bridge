<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book of {if isset($bookname[$key])}{$bookname[$key]}{/if} | Holy Bible Chapters</title>
    <meta name="description" content="Explore the book of {$bookname[$key]} with {$max} insightful chapters. Discover spiritual guidance and profound insights in this sacred text.">
    {include file="bootstrap-head.tpl"}
    <link href="/css/footer.css" rel="stylesheet">
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
                        <li class="breadcrumb-item">{$book|capitalize}</li>
                        {include file="share-url.tpl"}
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container mt-4">
            <h1 class="text-center">{$book|capitalize}</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12">
                    <ul class="list-group d-flex flex-row flex-wrap">
                        {assign var="v" value="1"}
                        {section name=book loop=$max}
                        <li class="list-group-item w-50 text-nowrap d-flex justify-content-center border-0" style="background:whitesmoke;">
                            <a class="text-decoration-none" href="{$website}bible/{$bookname[$key]|lower|replace:' ':'+'}/{$v++}">
                                {$book|capitalize|truncate_special} Ch. {$i++}
                            </a>
                        </li>
                        {/section}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{$website}/js/share-url.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>