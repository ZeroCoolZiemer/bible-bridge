<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <meta name="description" content="">
    {include file="bootstrap-head.tpl"}
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div class="hero-section">
        <div class="hero-text text-white">
            <h1>BibleBridge Framework</h1>
            <p class="verse-of-day">Convert your Bible database into a beautiful, functional, and searchable resource.</p>
            <p>Includes an easy-to-use CMS, create, edit, and delete articles with ease.</p>
        </div>
    </div>
    <div class="container text-center mt-4">
        <div class="nav-links">
            <a class="btn btn-dark" href="/bible/{$selectedVersion}/old-testament">Old Testament</a>
            <a class="btn btn-dark" href="/bible/{$selectedVersion}/new-testament">New Testament</a>
            <a class="btn btn-dark" href="/get-started">Get Started</a>
            <a class="btn btn-dark" href="/articles">Articles</a>
        </div>
        <div class="articles mt-5">
            <h2>Latest Articles</h2>
            <p>Insights, devotionals, and Bible studies updated regularly.</p>
            <div class="row">
                {foreach from=$articles item=article}
                <div class="col-md-4">
                    <div class="card text-dark">
                        <div class="card-body">
                            <h5 class="card-title">{$article.title}</h5>
                            <p class="card-text">{$article.excerpt}</p>
                            <a href="/article/{$article.slug|escape}" class="btn btn-dark">Read more</a>
                        </div>
                    </div>
                </div>
                {/foreach}
            </div>
        </div>
	{if $using_json}
	<div style="display: inline-block;" class="alert alert-warning text-start" role="alert">
    		<i style="color: #4F738E;" class="bi bi-database-fill-gear"></i> <strong>System Configuration Required</strong>: Currently operating via <strong>Local-JSON Data</strong>.<br> 
		To enable <strong>Article Management</strong> and <strong>Secure Access</strong>, please <strong>initialize</strong> your <strong>Articles Database</strong>.</div>
	{/if}
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{$website}js/back-button.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>