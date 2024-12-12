/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      'tablet': '640px',

      'laptop': '1024px',

      'desktop': '1280px',
    },
    extend: {
      colors: {
        input: '#1b1f24',
        background: '#0f1217',
      }
    },
  },
  plugins: [
    require("@tailwindcss/forms")({
      strategy: 'class', 
    }),
  ],
}
