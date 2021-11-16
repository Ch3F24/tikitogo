const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'tiki-blue': '#67C7CC',
                'tiki-green': '#91BB3E',
                'tiki-yellow': '#F7D64A',
                'tiki-orange': '#F26922',
                'tiki-magenta': '#CD4C7D',
                'tiki-celeste': '#71c7b5'
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
