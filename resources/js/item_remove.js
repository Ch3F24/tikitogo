
var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').value;
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
