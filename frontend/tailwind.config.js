/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,html,ts,jsx,tsx}"
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'base', // only generate global styles
            //strategy: 'class', // only generate classes
        }),
    ],
}

