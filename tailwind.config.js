/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.{php,js}", "./*.php", "./src/**/*.{php,js}"],
  theme: {
    extend: {
      fontFamily: {
        inter: ["Inter", "sans-serif"],
        poppins: ["Poppins", "sans-serif"],
      },

      colors: {
        // primary: "#42A6F9",
        // secondary: "#FFF0CE",
        // textPrimary: "#1e293b",
        // textSecondary: "#FFFCF5",
        // backgroundPrimary: "#EBCB90",
        // backgroundSecondary: "#FFF4DD",
        // danger: "#DC2626",
        primary: {
          50: "#eff6ff",
          100: "#dbeafe",
          200: "#bfdbfe",
          300: "#93c5fd",
          400: "#60a5fa",
          500: "#3b82f6",
          600: "#2563eb",
          700: "#1d4ed8",
          800: "#1e40af",
          900: "#1e3a8a",
        },
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
