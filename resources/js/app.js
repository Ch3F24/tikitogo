require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
// const shippingCheckbox = document.getElementById('same_as_shipping');
window.addEventListener('load', (event) => {
    if (document.getElementById('menu')) {
        document.getElementById('menu').style.display = null
        document.getElementById('loading').style.display = 'none'
        const menuDays = document.querySelectorAll('input[name="menu"]');

        if (document.querySelectorAll('input[name="menu"]')) {
                const menuContainer = document.getElementById('menu');
                menuDays.forEach(e => {
                    if(window.matchMedia("(min-width: 640px)").matches) {
                        if (e.checked) {
                            setContainerHeight(e,menuContainer)
                        }
                        e.addEventListener('change', (event) => {
                            setContainerHeight(event.target,menuContainer)
                        })
                    } else {
                        e.addEventListener('click', (event) => {
                            document.querySelector(`label[for="${event.target.getAttribute('id')}"]`).scrollIntoView(true)
                        })
                    }
                })
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

        const currentWeekBtn = document.getElementById('currentWeek');
        const nextWeekBtn = document.getElementById('nextWeek');
        const menuBtn = document.getElementById('menuBtn');
        const alacarteBtn = document.getElementById('alacarteBtn');


        currentWeekBtn.addEventListener('click',function (event) {
            if(currentWeekBtn.classList.contains('selected')) {
                // currentWeekBtn.classList.remove('selected')
            } else {
                switchWeekTab(event,'nextWeek')
                currentWeekBtn.classList.add('selected')
                nextWeekBtn.classList.remove('selected')
            }
        })
        nextWeekBtn.addEventListener('click',function (event) {

            if(nextWeekBtn.classList.contains('selected')) {
                // nextWeekBtn.classList.remove('selected')
            } else {
                switchWeekTab(event,'currentWeek',true)
                nextWeekBtn.classList.add('selected')
                currentWeekBtn.classList.remove('selected')
            }
        })

        menuBtn.addEventListener('click',function (event) {
            if(menuBtn.classList.contains('selected')) {
                // currentWeekBtn.classList.remove('selected')
            } else {
                document.querySelectorAll('div.menu').forEach(e => {
                    e.classList.remove('hidden')
                })
                document.querySelectorAll('div.alacarte').forEach(e => {
                    e.classList.add('hidden')
                })

                menuBtn.classList.add('selected')
                alacarteBtn.classList.remove('selected')
            }
        })
        alacarteBtn.addEventListener('click',function (event) {

            if(alacarteBtn.classList.contains('selected')) {
                // nextWeekBtn.classList.remove('selected')
            } else {
                document.querySelectorAll('div.menu').forEach(e => {
                    e.classList.add('hidden')
                })
                document.querySelectorAll('div.alacarte').forEach(e => {
                    e.classList.remove('hidden')
                })
                alacarteBtn.classList.add('selected')
                menuBtn.classList.remove('selected')
                if(window.matchMedia("(min-width: 640px)").matches) {
                    const menuContainer = document.getElementById('menu');
                    setContainerHeight(document.querySelector("input[name='menu']:checked"),menuContainer)
                }
            }
        })
    }



    function switchWeekTab(event,parent,isNext = null) {
        let week = event.target.getAttribute('id')
        let weekContainer = document.querySelector(`div[data-week="${week}"]`)
        let parentContainer = document.querySelector(`div[data-week="${parent}"]`)

        if (weekContainer.classList.contains('active')) {
            weekContainer.classList.remove('active')
            weekContainer.classList.add('hidden')
            parentContainer.classList.remove('hidden')
            parentContainer.classList.add('active')
        } else {
            weekContainer.classList.add('active')
            weekContainer.classList.remove('hidden')
            parentContainer.classList.remove('active')
            parentContainer.classList.add('hidden')
            if (isNext) {
                weekContainer.firstChild.nextSibling.firstChild.nextSibling.checked = true
            } else {
                weekContainer.querySelector("input[name='menu']:not([disabled])").checked = true
            }
        }
    }

});
if (document.getElementById('same_as_shipping')) {
    // const shippingCheckbox = document.getElementById('same_as_shipping');
    // const shippingContainer = document.getElementById('shipping-container');
    // shippingCheckbox.addEventListener('change', (event) => {
    //     if (event.target.checked) {
    //         // console   .log(shippingContainer)
    //         shippingContainer.style.display = 'none';
    //     } else {
    //         shippingContainer.style.display = 'grid';
    //     }
    // })
}
    require('./item_remove');
