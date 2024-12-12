/** @type {import('tailwindcss').Config} */
export default {
  content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
  theme: {
    screens: {
      tablet: '640px',

      laptop: '1024px',

      desktop: '1280px',
    },
    extend: {
      colors: {
        input: '#1b1f24',
        background: '#0f1217',
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            margin: '0',
            padding: '0',
            color: 'inherit',
            background: 'none',
            h1: {
              margin: '0',
              color: 'inherit',
            },
            h2: {
              margin: '0',
              color: 'inherit',
            },
            h3: {
              margin: '0',
              color: 'inherit',
            },
            p: {
              margin: '0',
              color: 'inherit',
            },
            span: {
              backgroundColor: 'transparent',
            },
            img: {
              margin: '0',
            },
          },
        },
      }),
    },
  },
  plugins: [
    require('@tailwindcss/forms')({
      strategy: 'class',
    }),
    require('@tailwindcss/typography'),
  ],
};
