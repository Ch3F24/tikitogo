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
            const menuContainer = document.getElementById('menu');

        if (document.querySelectorAll('input[name="menu"]')) {
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
                            setTimeout(function () {
                                document.querySelector(`label[for="${event.target.getAttribute('id')}"]`).scrollIntoView(true)
                            }, 5);
                        })
                    }
                })
        }
        function setContainerHeight(event,menuContainer) {
            let day = event.getAttribute('id');
            if (!day) {
                var container = event
            } else {
                var container = document.querySelector(`div[data-date='${day}']`)
            }
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
        const menuType = document.getElementById('menu-type-container');


        currentWeekBtn.addEventListener('click',function (event) {
            if(!currentWeekBtn.classList.contains('selected')) {
                // switchWeekTab(event,'nextWeek')
                currentWeekBtn.classList.add('selected')
                nextWeekBtn.classList.remove('selected')
                changeWeek()
                showMenu()

            }
        })
        nextWeekBtn.addEventListener('click',function (event) {

            if(!nextWeekBtn.classList.contains('selected')) {
                // switchWeekTab(event,'currentWeek',true)
                nextWeekBtn.classList.add('selected')
                currentWeekBtn.classList.remove('selected')
                changeWeek()
                showMenu()
            }
        })

        menuBtn.addEventListener('click',function (event) {
            if(!menuBtn.classList.contains('selected')) {
                document.querySelectorAll('div.menu').forEach(e => {
                    e.classList.remove('hidden')
                })
                let week = document.querySelector('button.week-btn.selected').getAttribute('id');
                let weekDaysContainer = document.querySelector(`div[data-week="${week}"]`);
                weekDaysContainer.classList.remove('hidden')
                weekDaysContainer.classList.add('active')

                let alacarteContainer = document.querySelector(`div[data-alacarte-week="${week}"].alacarte-container`);
                alacarteContainer.classList.add('hidden')

                menuBtn.classList.add('selected')
                alacarteBtn.classList.remove('selected')
            }
        })
        alacarteBtn.addEventListener('click',function (event) {

            if(!alacarteBtn.classList.contains('selected')) {
                let week = document.querySelector('button.week-btn.selected').getAttribute('id');
                let weekDaysContainer = document.querySelector(`div[data-week="${week}"]`);
                let alacarteContainer = document.querySelector(`div[data-alacarte-week="${week}"].alacarte-container`);

                document.querySelectorAll('div.menu').forEach(e => {
                    e.classList.add('hidden')
                })

                menuDays.forEach(e => {
                    if (e.checked) {
                        e.checked = false
                    }
                } )
                alacarteContainer.classList.remove('hidden')
                weekDaysContainer.classList.remove('active')
                weekDaysContainer.classList.add('hidden')

                alacarteBtn.classList.add('selected')
                menuBtn.classList.remove('selected')

                if(window.matchMedia("(min-width: 640px)").matches) {
                    const menuContainer = document.getElementById('menu');
                    setContainerHeight(alacarteContainer,menuContainer)
                }
            }
        })
        function showMenu() {
            if (menuType.classList.contains('hidden')) {
                menuType.classList.remove('hidden')
            }
        }
        function changeWeek() {
            let weekDaysContainer = document.querySelectorAll(`div[data-week]`);
            let alacarteContainer = document.querySelectorAll(`div[data-alacarte-week].alacarte-container`);

            weekDaysContainer.forEach(e => {
                e.classList.add('hidden')
                e.classList.remove('active')
            })
            menuBtn.classList.remove('selected')
            alacarteBtn.classList.remove('selected')
            alacarteContainer.forEach(e => e.classList.add('hidden'))
            menuContainer.style.minHeight = null
        }
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
    require('./item_remove');
