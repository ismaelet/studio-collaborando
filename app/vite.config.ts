import { defineConfig } from "vite";
import { svelte } from "@sveltejs/vite-plugin-svelte";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import path from "path";

export default defineConfig({
  plugins: [
    laravel({ input: ["resources/css/main.css", "resources/js/app.ts"], refresh: true }),
    svelte(),
    tailwindcss(),
  ],
  server: {
    hmr: {
      host: "localhost",
    },
  },
  resolve: {
    alias: {
      "@": path.resolve(import.meta.dirname, "resources/js"),
      "@directives": path.resolve(import.meta.dirname, "resources/js/directives"),
      "@images": path.resolve(import.meta.dirname, "resources/images"),
      "@layouts": path.resolve(import.meta.dirname, "resources/js/layouts"),
      "@svg": path.resolve(import.meta.dirname, "resources/svg"),
      "@icons": path.resolve(import.meta.dirname, "resources/svg/icons"),
      "@texts": path.resolve(import.meta.dirname, "resources/texts"),
    },
  },
});
