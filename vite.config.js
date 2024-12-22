import { defineConfig } from 'vite';
import { nodePolyfills } from 'vite-plugin-node-polyfills';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    nodePolyfills(),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/auth.js',
        'resources/js/edit-image.js',
        'resources/js/infinite-page.js',
        'resources/js/search.js',
        'resources/js/utils.js',
        'resources/js/vote.js',
        'resources/js/follow.js',
        'resources/js/post.js',
        'resources/js/comment.js',
        'resources/js/toggle-two.js',
        'resources/js/editor.js',
        'resources/js/feed.js',
        'resources/js/bookmark.js',
        'resources/js/notification.js',
        'resources/js/bookmark.js',
        'resources/js/admin.js',
        'resources/js/filter.js',
        'resources/js/sort-by.js',
        'resources/js/loading-button.js',
        'resources/js/profile.js',
        'resources/js/dashboard.js',
      ],
      refresh: true,
    }),
  ],
});
