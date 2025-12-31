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

        // Get the book name dynamically from the current page
        const bookNameElement = document.getElementById("bookName"); 
        const bookName = bookNameElement ? bookNameElement.textContent : "Unknown Book";

        // Check if bookmark already exists
        if (!bookmarks.some(bookmark => bookmark.url === currentUrl)) {
            if (bookmarks.length >= maxBookmarks) {
                bookmarks.pop(); // Remove the oldest bookmark
            }
            bookmarks.unshift({ url: currentUrl, bookName }); // Store both URL and book name
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

                const match = url.match(/bible\/([^\/]+)\/(\d+)(?:\/(\d+)(?:-(\d+))?)?/);
                if (match) {
                    const chapter = match[2];
                    const verseStart = match[3];
                    const verseEnd = match[4];

                    if (verseStart && verseEnd) {
                        link.textContent = `${capitalizeWords(bookName)} ${chapter}:${verseStart}-${verseEnd}`;
                    } else if (verseStart) {
                        link.textContent = `${capitalizeWords(bookName)} ${chapter}:${verseStart}`;
                    } else {
                        link.textContent = `${capitalizeWords(bookName)} ${chapter}`;
                    }
                } else {
                    link.textContent = bookName || url;
                }

                listItem.appendChild(link);
                bookmarksMenu.appendChild(listItem);
            });
        }
    }

function capitalizeWords(str) {
    return str.replace(/\b\p{L}+\b/gu, function (word, index, fullString) {
        // Only treat "of" as an exception and keep it lowercase unless it's the first or last word
        if (word.toLowerCase() === 'of' && index !== 0 && index !== fullString.length - word.length) {
            return word.toLowerCase();
        }
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
    });
}

    updateMenu();
});
