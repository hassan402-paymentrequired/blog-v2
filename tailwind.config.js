/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Pacifico"],
      },
    },
  },
  plugins: [
    // ...
    require('@tailwindcss/forms'),
    require('tailwind-scrollbar-hide')


  ],}

