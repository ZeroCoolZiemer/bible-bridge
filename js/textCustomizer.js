  let currentFontSize = localStorage.getItem('fontSize') 
                        ? parseInt(localStorage.getItem('fontSize')) 
                        : 16;
  let currentColor = localStorage.getItem('color') || '#000000';

  document.querySelectorAll('.verses').forEach(el => {
    el.style.fontSize = currentFontSize + 'px';
    el.style.color = currentColor;
  });

  function changeFontSize(change) {
    const minFontSize = 10;
    const maxFontSize = 30;
    currentFontSize += change;

    currentFontSize = Math.min(Math.max(currentFontSize, minFontSize), maxFontSize);

    localStorage.setItem('fontSize', currentFontSize);
    applyStyles();
  }

  function changeTextColor(color) {
    if (color && color !== currentColor) {
      currentColor = color;
      localStorage.setItem('color', color);
      applyStyles();
    }
  }

  function applyStyles() {
    document.querySelectorAll('.verses').forEach(el => {
      el.style.fontSize = currentFontSize + 'px';
      el.style.color = currentColor;
    });
  }

  document.querySelectorAll('.dropdown-item').forEach(option => {
    option.addEventListener('click', (event) => {
      const color = event.currentTarget.getAttribute('data-color');
      if (color) {
        changeTextColor(color);
      }
    });
  });