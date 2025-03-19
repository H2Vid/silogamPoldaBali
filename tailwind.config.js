/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            screens: {
                'custom': '1400px' // Custom breakpoint dari 1160px ke atas
              },
              fontFamily: {
                horta: ['Horta'], // Sesuaikan dengan nama font di @font-face
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
