import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    presets: [
        require('./vendor/tallstackui/tallstackui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#2C8CCF',
                'primary-100': '#80bae2',
                'primary-200': '#6bafdd',
                'primary-300': '#56a3d9',
                'primary-400': '#4198d4',
                'primary-500': '#2C8CCF',
                'primary-600': '#287eba',
                'primary-700': '#2370a6',
                'primary-800': '#1f6291',
                'primary-900': '#1a547c',

            },
        },
    },

    plugins: [forms],
};
