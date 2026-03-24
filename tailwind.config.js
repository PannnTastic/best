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
        'primary': '#0F172A', // Example dark blue
        'secondary': '#F97316', // Example orange
        'accent': '#334155',
      }
    },
  },
  plugins: [],
}
