window.addEventListener('load', () => {
    if (document.getElementById('menu')) {
        document.getElementById('menu').style.display = null
        const loading = document.getElementById('loading')
        loading.style.display = 'none'

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

        //Add to Cart
        window.addToCart = function(event) {
            loading.style.display = null

            let options = [];
            let menu = null;

            if(event.target.querySelector('input[type=checkbox]')) {
                event.target.querySelectorAll('input[type=checkbox]:checked').forEach(e => {
                    options.push(e.value)
                });
            }

            if (event.target.querySelector('#menu_date')) {
                menu = event.target.querySelector('#menu_date').value
            } else {
                menu = event.target.querySelector('input[name="menu_date"]').value
            }

            axios.post('/',{
                _token: CSRF_TOKEN,
                name:       event.target.querySelector('input[name="name"]').value,
                product:    event.target.querySelector('input[name="product"]').value,
                price:      event.target.querySelector('input[name="price"]').value,
                menu_date:  menu,
                option:     options,
            }).then(e => {
                document.getElementById('itemsInCart').innerHTML = e.data.itemsInCart
                loading.style.display = 'none'
            }).catch(error => {
                loading.style.display = 'none'
                console.log(error)
            })

            event.preventDefault();
        }
    }
});
