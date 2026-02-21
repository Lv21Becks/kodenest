import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
                heading: ["Montserrat", "sans-serif"],
            },
            colors: {
                "brand-black": "#000000",
                "brand-purple": "#6F1D7A", // Deep Purple (Main)
                "brand-purple-dark": "#5A1A66", // Dark Purple (Secondary)
                "brand-magenta": "#A01B7E", // Magenta (Accent)
                "brand-indigo": "#2D2A73", // Indigo (Arrow)
                "brand-blue": "#0A6FB8", // Bright Blue (#1)
                "brand-teal": "#1AA6A6", // Teal (#0)
                "brand-yellow": "#F6C445", // Yellow (Warning/Callout)
                "brand-orange": "#F28C2A", // Orange (Callout)
                "brand-red": "#D7261E", // Red (Error)
                "brand-green": "#7CCB8E", // Mint Green (Success)
                "brand-coral": "#FF6B5A", // Coral (Down Arrow)
                "brand-dark": "#000000", // Mapping generic dark to black
                "brand-action": "#FF6B5A", // Mapping action to Coral/Salmon for now, or maybe Yellow? Let's use Coral for CTAs as requested "sparingly" or Yellow. User said CTAs: Coral or Yellow.
            },
            keyframes: {
                fadeInUp: {
                    "0%": { opacity: "0", transform: "translateY(20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                slideDown: {
                    "0%": { transform: "translateY(-100%)" },
                    "100%": { transform: "translateY(0)" },
                },
                float: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-20px)" },
                },
                scaleIn: {
                    "0%": { opacity: "0", transform: "scale(0.9)" },
                    "100%": { opacity: "1", transform: "scale(1)" },
                },
                slideInLeft: {
                    "0%": { opacity: "0", transform: "translateX(-20px)" },
                    "100%": { opacity: "1", transform: "translateX(0)" },
                },
                slideInRight: {
                    "0%": { opacity: "0", transform: "translateX(20px)" },
                    "100%": { opacity: "1", transform: "translateX(0)" },
                },
                shimmer: {
                    "0%": { backgroundPosition: "200% 0" },
                    "100%": { backgroundPosition: "-200% 0" },
                },
            },
            animation: {
                fadeInUp: "fadeInUp 0.8s ease-out forwards",
                slideDown: "slideDown 0.5s ease-out forwards",
                float: "float 6s ease-in-out infinite",
                scaleIn: "scaleIn 0.6s ease-out forwards",
                slideInLeft: "slideInLeft 0.6s ease-out forwards",
                slideInRight: "slideInRight 0.6s ease-out forwards",
                shimmer: "shimmer 8s linear infinite",
                "pulse-slow": "pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite",
            },
        },
    },

    plugins: [forms],
};
