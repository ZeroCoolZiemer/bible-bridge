<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christian Articles</title>
    <meta name="description" content="">
    {include file="bootstrap-head.tpl"}
    <link href="/css/footer.css" rel="stylesheet">
    <link href="/css/columns.css" rel="stylesheet">
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div style="padding-top: 0.5rem;" class="container-fluid pt-2">
        <div class="row">
            <div class="col-md-12 ms-2 mt-2">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Articles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Articles Section -->
    <div class="container mt-4">
        <h1 class="text-center mb-4">All Articles</h1>
        <!-- Table for Articles -->
        <div class="article-list table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th class="d-none d-sm-table-cell" scope="col">Published</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$articles item=article}
                    <tr>
                        <td>
                            <a class="text-decoration-none" href="/article/{$article.slug|escape}">
                                {$article.title}
                            </a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {$article.date|date_format:"%B %e, %Y"}
                        </td>
                        <td>{$article.excerpt}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
            <!-- Pagination -->
            {if $totalPages > 1}
            <nav>
                <ul class="pagination justify-content-center">
                    {if $currentPage > 1}
                    <li class="page-item">
                        <a class="page-link" href="{if $currentPage > 2}/articles/{$currentPage-1}{else}/articles{/if}">Previous</a>
                    </li>
                    {/if}
                    <li class="page-item disabled">
                        <span class="page-link">Page {$currentPage} of {$totalPages}</span>
                    </li>
                    {if $currentPage < $totalPages} <li class="page-item">
                        <a class="page-link" href="/articles/{$currentPage+1}">Next</a>
                        </li>
                        {/if}
                </ul>
            </nav>
            {/if}
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>