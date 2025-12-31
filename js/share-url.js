    document.addEventListener('DOMContentLoaded', function () {
        var clipboardButton = document.querySelector('.clipboard');
        var tooltip = new bootstrap.Tooltip(clipboardButton, {
            trigger: 'manual',
            title: 'Copied!'
        });

        clipboardButton.addEventListener('click', function () {
            var currentUrl = window.location.href;
            var urlWithoutProtocol = currentUrl.replace(/^https?:\/\//, '');

            navigator.clipboard.writeText(urlWithoutProtocol).then(function() {
                showTooltip('Copied!');
            }).catch(function() {
                showTooltip('Failed to copy');
            });
        });

        function showTooltip(message) {
            tooltip.setContent({ '.tooltip-inner': message });
            tooltip.show();
            setTimeout(function() {
                tooltip.hide();
            }, 1500);
        }
    });
