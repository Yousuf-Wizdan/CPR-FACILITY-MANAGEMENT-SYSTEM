// tailwind.config.js
module.exports = {
  content: [
    './*.{html,php}',           // root level files
    './**/*.{html,php}',        // nested files
    './components/**/*.{html,php}',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
