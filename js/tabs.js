function openTab(tabBtns, tabPane, tabPanes, e) {
  if (!e.classList.contains('tab-btn-active')) {
    tabBtns.forEach(e => {
      if (e.classList.contains('tab-btn-active')) e.classList.toggle('tab-btn-active');
    })
    tabPanes.forEach(e => {
      if (e.classList.contains('tab-pane-show')) e.classList.toggle('tab-pane-show');
    })
    e.classList.toggle('tab-btn-active');
    tabPane.classList.toggle('tab-pane-show');
    let currentUrl = window.location.href;
    let lastSlashIndex = currentUrl.lastIndexOf("/");
    let path = currentUrl.substring(lastSlashIndex + 1);
    path = path.split('?')[0];
    window.history.pushState({}, '', `/${path}?tab=${e.dataset.tabName}`);
  }
}

const tabBtns = document.querySelectorAll('.tab-btn');
const urlParams = new URLSearchParams(window.location.search);
tabBtns.forEach((e) => {
  const tabPane = document.querySelector(`.tab-pane[data-tab-name="${e.dataset.tabName}"]`);
  const tabPanes = document.querySelectorAll(`.tab-pane`);
  if (urlParams.get('tab') == e.dataset.tabName)
    openTab(tabBtns, tabPane, tabPanes, e);
  e.addEventListener('click', () => {
    openTab(tabBtns, tabPane, tabPanes, e);
  })
});