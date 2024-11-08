/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/frontend/**/*.{js,jsx,ts,tsx}", // Include the frontend folder
    "./src/admin/**/*.{js,jsx,ts,tsx}", // Include the admin folder
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
