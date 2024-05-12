/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    extend: {
      colors: {
        gray:{
          100:"#f2f2f2",
        }
      }, // Extend Tailwind's default colors
    },
  },
  plugins: [],
};

export default config;
