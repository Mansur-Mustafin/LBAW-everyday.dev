import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/auth.js',
                'resources/js/edit-profile.js',
                'resources/js/infinite-page.js',
                'resources/js/search.js',
                'resources/js/utils.js',
                'resources/js/vote.js', 
                'resources/js/admin.js',
                'resources/js/follow.js',
                'resources/js/post.js',
            ],
            refresh: true,
        }),
    ],
});
