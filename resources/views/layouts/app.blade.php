<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
        const pusherAppKey = "{{ env('PUSHER_APP_KEY') }}";
        const pusherCluster = "{{ env('PUSHER_APP_CLUSTER') }}";
        const userId = "{{ Auth::id() }}"
    </script>

    <script src="https://js.pusher.com/7.0/pusher.min.js" defer></script>
    @vite('resources/css/app.css')
    @vite('resources/js/vote.js')
    @vite('resources/js/post.js')
    @vite('resources/js/comment.js')
    @vite('resources/js/search.js')
    @vite('resources/js/infinite-page.js')
    @vite('resources/js/auth.js')
    @vite('resources/js/edit-image.js')
    @vite('resources/js/follow.js')
    @vite('resources/js/toggle-two.js')
    @vite('resources/js/feed.js')
    @vite('resources/js/notification.js')
    @vite('resources/js/bookmark.js')
    @vite('resources/js/admin.js')


    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

@yield('body')

</html>
