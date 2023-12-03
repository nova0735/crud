/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        nova: ['Nova Square', 'sans-serif'],
      }
    },
  },
  plugins: [],
}