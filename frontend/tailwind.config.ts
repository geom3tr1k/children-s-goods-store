/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#FF8FAB",
        secondary: "#6EC1E4",
        accent: "#FFE082",
      },
    },
  },
  plugins: [],
}
