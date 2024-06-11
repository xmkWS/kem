ymaps.ready(init);

function init() {
  var suggestView1 = new ymaps.SuggestView('suggest1', { results: 5 });
  const addressInput = document.querySelector('#suggest1');
  const orderBtn = document.querySelector('#orderBtn');
  const orderBtnSubmit = document.querySelector('#orderBtnSubmit');
  const orderForm = document.querySelector('#orderForm');
  orderBtn.addEventListener('click', () => {
    orderBtnSubmit.click();
  })
}
