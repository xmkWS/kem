const productCardNames = document.querySelectorAll('.catalog-mini-text');
if (productCardNames) {
  productCardNames.forEach(e => {
    const originalText = e.innerHTML;
    const textBlockHeight = parseInt(getComputedStyle(e).height);
    if (e.scrollHeight > textBlockHeight) {
      let newText = originalText.substr(0, Math.floor(originalText.length * (textBlockHeight * 1.2) / e.scrollHeight) - 3) + '...';
      e.innerHTML = newText;
    }
  })
}