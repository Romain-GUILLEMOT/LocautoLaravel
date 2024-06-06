import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'dark-violet': '#0f002d',
                'light-violet': '#7149d8',
                'button-violet': '#5736ac',
                'box-violet': '#240a47',
                'secondary-box-violet': '#5f34a7',
                'secondary-button-violet': '#52309d',
                'black-bg': '#010023',
                'text-violet': '#502382',
                'light-text-violet': '#502382',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
