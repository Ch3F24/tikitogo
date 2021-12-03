window.addEventListener('load', (event) => {
    //Remove shipping and set take away
    if (document.getElementById('take_away')) {
        let priceContainer = document.getElementById('totalWithShipping');

        document.getElementById('take_away').addEventListener('click', function (e) {
            let container = document.getElementById('pickup_date');
            if (e.target.checked) {
                container.style.display = 'block';
                container.querySelector('input').disabled = false;
                priceContainer.classList.add('hidden')
            } else {
                container.style.display = 'none';
                container.querySelector('input').disabled = true;
                priceContainer.classList.remove('hidden')
            }
        })
        if (document.getElementById('take_away').checked) {
            let container = document.getElementById('pickup_date');
            container.style.display = 'block';
            container.querySelector('input').disabled = false;
            priceContainer.classList.add('hidden')

        }
    }

    var buttons = document.querySelectorAll('.remove-cart-item');

    buttons.forEach(b => {
        b.addEventListener('click',function (e)  {
            let item = parseInt(b.parentNode.querySelector('input').value);
            axios.post('/cart',{
                _token: CSRF_TOKEN,
                item: item
            }).then(e => {
                location.reload();
            }).catch(error => {
                console.log(error)
            })
            e.preventDefault();
        })
    })

});
