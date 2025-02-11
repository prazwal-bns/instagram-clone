import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/wire-elements/modal/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    safelist: [
        "sm:max-w-sm",
        "sm:max-w-md",

        "md:max-w-lg",
        "md:max-w-xl",

        "lg:max-w-2xl",
        "lg:max-w-3xl",

        "xl:max-w-4xl",
        "xl:max-w-5xl",

        "2xl:max-w-6xl",
        "2xl:max-w-7xl",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    // daisyui: {
    //     themes: ['light']
    // },
    daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#FF3040",
                    "primary-content": "#ffffff",

                    "secondary": "#FF9800",
                    "secondary-content": "#ffffff",

                    "accent": "#833AB4",
                    "accent-content": "#ffffff",

                    "neutral": "#f3f4f6",
                    "neutral-content": "#262626",

                    "base-100": "#ffffff",
                    "base-200": "#f2f2f2",
                    "base-300": "#dbdbdb",
                    "base-content": "#262626",

                    "info": "#0095f6",
                    "info-content": "#ffffff",

                    "success": "#1DB954",
                    "success-content": "#ffffff",

                    "warning": "#FFAD33",
                    "warning-content": "#ffffff",

                    "error": "#ED4956",
                    "error-content": "#ffffff",
                },
            },
        ],
    },

    plugins: [forms, require("daisyui"), require("tailwind-scrollbar-hide")],
};
