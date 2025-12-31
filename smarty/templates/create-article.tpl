<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Article</title>
    {include file="bootstrap-head.tpl"}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div class="container mt-4">
        <h2 class="text-center">Create New Article</h2>
        <div class="row justify-content-center">
            <div class="col-auto text-center mt-3">
                {if isset($message)}
                {$message}
                {/if}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/create-article" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <div id="content" class="form-control" style="height: 300px;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description (optional)</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description" value="{$article.meta_description}" maxlength="160">
                        <small id="char_count" class="form-text text-danger">0/160 characters</small>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark">Submit Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
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

    document.querySelector('form').onsubmit = function() {

        var content = quill.root.innerHTML;

        var hiddenContentInput = document.createElement('input');
        hiddenContentInput.setAttribute('type', 'hidden');
        hiddenContentInput.setAttribute('name', 'content');
        hiddenContentInput.setAttribute('value', content);

        this.appendChild(hiddenContentInput);
    };
    </script>
    <script src="/js/character-count.js"></script>
    {include file="bookmark.tpl"}
</body>

</html>