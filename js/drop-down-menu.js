const menuLi = document.querySelectorAll('.header-menu-item');
menuLi.forEach(element => {
    element.addEventListener('mouseover', () => {
        const sub_menu = element.querySelector('.sub-menu');
        sub_menu.style.display = 'block'
    })
});

menuLi.forEach(element => {
    element.addEventListener('mouseout',()=> {
        const sub_menu = element.querySelector('.sub-menu');
        sub_menu.style.display = 'none';
    })
});