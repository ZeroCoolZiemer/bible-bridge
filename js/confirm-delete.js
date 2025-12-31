    function confirmDelete(articleId) {
        if (confirm("Are you sure you want to delete this article?")) {
            window.location.href = "delete-article.php?id=" + articleId;
        }
    }