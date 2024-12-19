/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                // Primary
                'primary': '#ff5400',
                'primary-hover': '#ffa700',
                'fire-hover': '#ff2020',
                // Neutrals
                'very-light': '#b7b7b7',
                'light': '#999',
                'medium-light': '#6d6d6d',
                'medium': '#3d3d3d',
                'medium-dark': '#323232',
                'dark': '#272727',
                'very-dark': '#1d1d1d',
                'ultra-dark': '#101010',
                // Others
                'opaque': 'rgba(0,0,0,0.75)',
            },
            fontFamily: {
                'barlow': [
                    'Barlow',
                    'arial',
                    'sans-serif'
                ],
                'audio': [
                    'AudioWide',
                    'Barlow',
                    'arial',
                    'sans-serif'
                ],
            },
        },
    },
    plugins: [],
}
