/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.html", "./*.html", "./src/**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        inter: ["Inter", "sans-serif"],
        poppins: ["Poppins", "sans-serif"],
      },

      colors: {
        primary: "#54CCFF",
        secondary: "#FFF0CE",
        textPrimary: "#1e293b",
        textSecondary: "#FFFCF5",
        backgroundPrimary: "#EBCB90",
        backgroundSecondary: "#FFF4DD",
        danger: "#DC2626",
      },

      spacing: {
        18: "4.5rem",
        22: "5.5rem",
      },

      borderRadius: {
        xl2: "1rem",
      },
    },
  },
  plugins: [],
};
