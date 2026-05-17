import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                kriya: {
                    cream: {
                        DEFAULT: '#fdf6e3',
                        light: '#fff9f0',
                        dark: '#f5e6c8',
                    },
                    parchment: '#e8d5a3',
                    brown: {
                        DEFAULT: '#5c3317',
                        mid: '#7a4520',
                        deep: '#3d1d0d',
                        darkest: '#2a1008',
                    },
                    terracotta: '#8b4513',
                    rust: '#a0522d',
                    orange: '#c8611a',
                    sienna: '#b5451b',
                    gold: {
                        DEFAULT: '#c9a227',
                        deep: '#a67c00',
                        soft: '#e8c96a',
                        pale: '#f5e4a8',
                    },
                    indigo: {
                        DEFAULT: '#2c3e6b',
                        soft: '#4a5fa0',
                    },
                },
            },
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                'serif-display': ['Cinzel', ...defaultTheme.fontFamily.serif],
                'body-serif': ['Lora', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
