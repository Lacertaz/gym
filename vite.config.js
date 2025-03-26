import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
// import tailwindcssAnimated from "tailwindcss-animated";
export default defineConfig({
    content: ["./node_modules/flyonui/dist/js/*.js"],
    plugins: [
        laravel({
            input: [
                "resources/css/landing.css",
                "resources/css/tiptap.css",
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/tiptap.js",
            ],
            refresh: [`resources/views/**/*`],
        }),
        tailwindcss(),
        // tailwindcssAnimated(),
    ],
    server: {
        cors: true,
    },
});
