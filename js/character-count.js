    const metaDescriptionInput = document.getElementById('meta_description');
    const charCountDisplay = document.getElementById('char_count');

    metaDescriptionInput.addEventListener('input', function() {
        const currentLength = metaDescriptionInput.value.length;
        charCountDisplay.textContent = `${currentLength}/160 characters`;
    });