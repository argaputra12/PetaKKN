const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {

        extend: {
            colors : {
                primary : {
                    textdark : '#100F0F',
                    textgray : '#B7B7B7',
                    textlight : '#F1F1F1',
                    blue : '#006EA4',
                    red : '#F66951',
                    cream : '#FFC5A3'
                }
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
