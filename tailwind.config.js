/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            boxShadow: {
                "outer-glow": "0 0 5px rgb(0 0 0 / 0.05)",
            },
            maxHeight: {
                "4/5-screen": "80vh",
                "1/5-screen": "20vh",
            },
            height: {
                "10vh": "10vh",
                "20vh": "20vh",
                "30vh": "30vh",
                "40vh": "40vh",
                "50vh": "50vh",
                "60vh": "60vh",
                "70vh": "70vh",
                "80vh": "80vh",
                "90vh": "90vh",
            },
        },
    },
    plugins: [],
};
