window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.dayReport = function (date) {
    const params = new URLSearchParams(window.location.search);
    params.set('date', date);
    let url = window.history.replaceState({}, "", decodeURIComponent(`${window.location.pathname}?${params}`));

    // window.history.pushState("", "Page Title Here", url);
    location.reload();

    console.log()

    // console.log(urlParams)
    // // alert('semmi');
    // console.log(date)
    // axios.get('/admin/report',{
    //     params: {
    //         date: date
    //     }
    // }).then(e => {
    //     console.log(e)
    //     // location.reload();
    // }).catch(error => {
    //     // console.log(error)
    // })
}
