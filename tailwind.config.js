import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import flowbite from "flowbite/plugin";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            colors: {
                ink: 'rgb(var(--color-ink) / <alpha-value>)',
                paper: 'rgb(var(--color-paper) / <alpha-value>)',
                brand: 'rgb(var(--color-brand) / <alpha-value>)',
                blood: 'rgb(var(--color-blood) / <alpha-value>)',
                smoke: 'rgb(var(--color-smoke) / <alpha-value>)',
                mist: 'rgb(var(--color-mist) / <alpha-value>)',
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                display: ["'Unbounded'", "sans-serif"],
                mono: ["'Space Mono'", "monospace"],
                body: ["'DM Sans'", "sans-serif"],
            },
            animation: {
                'spin-slow': 'spin-slow 20s linear infinite',
                'ticker': 'ticker 20s linear infinite',
                'slide-right': 'slide-right 2s ease infinite 1.5s',
            },
            keyframes: {
                'spin-slow': {
                    from: { transform: 'rotate(0deg)' },
                    to: { transform: 'rotate(360deg)' },
                },
                'ticker': {
                    from: { transform: 'translateX(0)' },
                    to: { transform: 'translateX(-50%)' },
                },
                'slide-right': {
                    '0%': { left: '-100%' },
                    '100%': { left: '100%' },
                },
            },
        },
    },

    plugins: [
        forms,
        flowbite
    ],
};