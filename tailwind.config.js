/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",],
  theme: {
    extend: {
      colors: {
        input: '#1b1f24',
        background: '#0f1217',
      }
    },
  },
  plugins: [],
}

