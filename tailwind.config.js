import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
// tailwind.config.js

// tailwind.config.js
// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#000000",       // Fundo geral (rosinha super claro)
                sidebar: "#373739",       // Menu lateral (rosa claro pastel)
                card: "#373739",          // Cartões / boxes (rosa médio claro)
                accent: "#ec4899",        // Botões ativos (rosa pink)
                accentHover: "#db2777",   // Hover dos botões (rosa pink escuro)
                textPrimary: "#3f3f46",   // Texto escuro neutro
            },
        },
    },
    plugins: [],
}
