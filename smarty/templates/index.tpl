<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BibleBridge 1.6</title>

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
            <h1>BibleBridge: The Universal Bible Engine</h1>
            <p class="verse-of-day">
                Our schema-agnostic framework maps to your existing database structure instantly.
            </p>
            <p class="verse-of-day">
                No SQL rewriting, no code changes - just configure your map and launch.
            </p>
        </div>
    </div>

    <div class="container text-center mt-4">
        <div class="nav-links">
            <a class="btn btn-dark" href="/bible/{$selectedVersion}/old-testament">Old Testament</a>
            <a class="btn btn-dark" href="/bible/{$selectedVersion}/new-testament">New Testament</a>
            <a class="btn btn-dark" href="/get-started">Get Started</a>
        </div>
    </div>

    {include file="footer.tpl"}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{$website}js/back-button.js"></script>

    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}

</body>
</html>