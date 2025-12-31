<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article - {$article.title}</title>
    {include file="bootstrap-head.tpl"}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
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
    <div class="container mt-4">
        <h2 class="text-center">Edit Article: {$article.title}</h2>
        {if isset($message)}
        <div class="alert alert-info text-center" style="display: inline-block; max-width: 100%; margin:0 auto;">
            {$message}
        </div>
        {/if}
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Edit Article Form -->
                <form action="/update-article.php" method="POST">
                    <input type="hidden" name="id" value="{$article.id}">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{$article.title}" required>
                    </div>
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" required>{$article.excerpt}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <!-- Quill Editor -->
                        <div id="content" class="form-control" style="height: 300px;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description (optional)</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{$article.meta_description}" maxlength="160">
                        <small id="char_count" class="form-text text-danger">{$article.meta_description|strlen}/160 characters</small>
                    </div>
                    <!-- Hidden input to store Quill's content -->
                    <input type="hidden" id="hiddenContent" name="content">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{$article.date|date_format:'%Y-%m-%d'}" required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark">Update Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
    var quill = new Quill('#content', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['bold', 'italic', 'underline'],
                [{ 'align': [] }],
                ['link'],
                [{ 'color': [] }, { 'background': [] }],
                ['blockquote']
            ]
        }
    });

    var content = document.createElement('div');
    content.innerHTML = `{$article.content|unescape:"html"}`; // Unescape HTML content from Smarty
    quill.setContents(quill.clipboard.convert(content.innerHTML)); // Convert and set content in Quill

    document.querySelector('form').onsubmit = function() {
        document.getElementById('hiddenContent').value = quill.root.innerHTML;
    };
    </script>
    <script src="/js/character-count.js"></script>
    {include file="bookmark.tpl"}
</body>

</html>