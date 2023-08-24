import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@cmp": "/resources/js/components",
            "@srv": "/resources/js/services",
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
});
