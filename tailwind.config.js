import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'transparent': 'transparent',

                'primary': '#15db95',
                'secondary': '#2d5f5d',
                'accent': '#0d19a3',
                'stress': '#f7882f',
                'background': '#d9d9d9',
                'dark': '#1d2731',     
            },
        },
    },

    /**Classes that shouldnt be purged because the use props to build class names dynamically */
    safelist: [
        'w-1/3',
        'w-1/2',
        'w-2/3',
        'w-3/4',
        'w-4/5',
        'w-5/6',
    ],

    plugins: [forms],
};
