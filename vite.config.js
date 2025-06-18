import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';




export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/scss/custom.scss'],
            refresh: true,
        }),
    ],
    resolve: {
    alias: {
      '~': '/node_modules/',
    },
  },
   optimizeDeps: {
    include: ['toastr']
  }
});


