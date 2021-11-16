require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.data('tab', () => ({
    open: false,

    toggle() {
        this.open = ! this.open
    }
}))

Alpine.start();
// const shippingCheckbox = document.getElementById('same_as_shipping');
if (document.querySelectorAll('input[name="menu"]')) {
    if(window.matchMedia("(min-width: 640px)").matches) {
        const menuDays = document.querySelectorAll('input[name="menu"]');
        const menuContainer = document.getElementById('menu');
        menuDays.forEach(e => {
            if (e.checked) {
                setContainerHeight(e,menuContainer)
            }
            e.addEventListener('change', (event) => {
                setContainerHeight(event.target,menuContainer)
            })
        })
    }
}
function setContainerHeight(event,menuContainer) {
    let day = event.getAttribute('id');
    let container = document.querySelector(`div[data-date='${day}']`)
    menuContainer.style.minHeight = null
    if(container) {
        menuContainer.style.minHeight = `${container.clientHeight + menuContainer.clientHeight}px`
    } else {
        menuContainer.style.minHeight = null
    }
}

if (document.getElementById('same_as_shipping')) {
    // const shippingCheckbox = document.getElementById('same_as_shipping');
    // const shippingContainer = document.getElementById('shipping-container');
    // shippingCheckbox.addEventListener('change', (event) => {
    //     if (event.target.checked) {
    //         // console.log(shippingContainer)
    //         shippingContainer.style.display = 'none';
    //     } else {
    //         shippingContainer.style.display = 'grid';
    //     }
    // })
    require('./item_remove');
}

