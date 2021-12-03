require('./bootstrap');

import Alpine from 'alpinejs';
window.CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').value;
window.Alpine = Alpine;

Alpine.start();
