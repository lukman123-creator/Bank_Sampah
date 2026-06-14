import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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
            keyframes: {
                typing: {
                    '0%': { width: '0%', visibility: 'hidden' },
                    '100%': { width: '100%' },
                },
                blink: {
                    '50%': { borderColor: 'transparent' },
                    '100%': { borderColor: 'white' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                }
            },
            animation: {
                typing: 'typing 2s steps(20) alternate, blink .7s infinite',
                slideUp: 'slideUp 0.6s ease-out forwards',
                fadeIn: 'fadeIn 0.8s ease-out forwards',
            }
        },
    },

    plugins: [forms],
};
