/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
      ],
  theme: {
    extend: {
        colors: {
            custom_blue: '#0A74DA',
            custom_red: '#f56558'
        },
    },
  },
  plugins: [
    require('flowbite/plugin')
],
}

