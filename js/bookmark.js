document.addEventListener("DOMContentLoaded", function () {
    const bookmarkButton = document.getElementById("myBookmark");
    const bookmarksMenu = document.getElementById("bookmarksMenu");
    const maxBookmarks = 7;
    const storageKey = "userBookmarks";

    if (bookmarkButton) {
        var tooltip = new bootstrap.Tooltip(bookmarkButton, {
            trigger: 'manual',
            title: 'Bookmark Saved!'
        });
        bookmarkButton.addEventListener("click", saveBookmark);
    }

    function getBookmarks() {
        return JSON.parse(localStorage.getItem(storageKey)) || [];
    }

    function saveBookmark() {
        let bookmarks = getBookmarks();
        const currentUrl = window.location.href;
        const bookNameElement = document.getElementById("bookName"); 
        const bookName = bookNameElement ? bookNameElement.textContent : "Unknown Book";

        if (!bookmarks.some(bookmark => bookmark.url === currentUrl)) {
            if (bookmarks.length >= maxBookmarks) {
                bookmarks.pop();
            }
            bookmarks.unshift({ url: currentUrl, bookName });
            localStorage.setItem(storageKey, JSON.stringify(bookmarks));
            updateMenu();
            showTooltip("Bookmark Saved!");
        } else {
            showTooltip("This page is already bookmarked.");
        }
    }

    function showTooltip(message) {
        if (bookmarkButton) {
            tooltip.setContent({ ".tooltip-inner": message });
            tooltip.show();
            setTimeout(() => tooltip.hide(), 1500);
        }
    }

    function updateMenu() {
        const bookmarks = getBookmarks();
        bookmarksMenu.innerHTML = "";

        if (bookmarks.length === 0) {
            bookmarksMenu.innerHTML = "<li><a class='dropdown-item'>No bookmarks saved</a></li>";
        } else {
            bookmarks.forEach(({ url, bookName }) => {
                const listItem = document.createElement("li");
                const link = document.createElement("a");
                link.href = url;
                link.classList.add("dropdown-item");

                const match = url.match(/bible\/[^\/]+\/([^\/]+)\/(\d+)(?:\/([\d\-]+))?/);

                if (match) {
                    const chapter = match[2];
                    const verse = match[3];
                    link.textContent = `${capitalizeWords(bookName)} ${chapter}${verse ? ':' + verse : ''}`;
                } else {
                    link.textContent = capitalizeWords(bookName);
                }

                listItem.appendChild(link);
                bookmarksMenu.appendChild(listItem);
            });
        }
    }

    function capitalizeWords(str) {
        return str.replace(/\b\p{L}+\b/gu, function (word, index, fullString) {
            if (word.toLowerCase() === 'of' && index !== 0 && index !== fullString.length - word.length) {
                return word.toLowerCase();
            }
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });
    }

    updateMenu();
});
