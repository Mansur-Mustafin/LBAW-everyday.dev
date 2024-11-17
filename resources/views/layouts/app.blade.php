<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
<<<<<<< HEAD
    @vite('resources/js/vote.js')
=======
    @vite('resources/js/search.js')
>>>>>>> 5d26d59 (feat:search bar)

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
</head>

<body class="bg-background text-white">
    <main class="flex flex-col h-screen">
        
        @include('layouts.header')

        <div class="flex flex-grow">
            
            @include('layouts.aside')

            <section id="content" class="w-full h-full">
                @yield('content')
            </section>
        </div>

        @if (Auth::check())
            <a class="button" href="{{ url('/logout') }}"> Logout </a>
            <a class="button" href="{{ url('/me') }}"> {{ Auth::user()->username }} </a> 
            <a class="button" href="{{ url('/news/create-post') }}">New Post</a>
        @endif

        <div class="divide-y" relative>
            <div class="flex text-black bg-white rounded-t p-1">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"  viewBox="0 0 30 30" class="">
                    <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
                </svg>                
                <input id="search-bar" type="text" class="w-full h-full p-2 outline-none rounded-t">
            </div>
            <div id="search-results" class=" text-black bg-white divide-y ">
        </div>

    </header>
    <section id="content">
        @yield('content')
    </section>
</main>
</body>
</html>

<script>
    const searchBarDiv = document.getElementById('search-bar')
    const resultsDiv = document.getElementById('search-results')
    const resultsDivTags = document.getElementById('search-results-tags')
    const resultsDivUsers = document.getElementById('search-results-users')
    const searchURL = "{{ url('search') }}/"


    const showPosts = (posts) => {
        posts.forEach(element => {
            const postResult = document.createElement("div");
            const url = `{{ url('/news/') }}/${element.id}`
            postResult.innerHTML = `
                <div class="p-2">
                    <a href="${url}" class="">
                        <p>
                            ${element.title}
                        </p>
                        <p class="text-sm text-gray-600 text-nowrap text-ellipsis overflow-hidden">
                            ${element.content}
                        </p>
                    </a>
                    
                </div>
            `
            resultsDiv.appendChild(postResult)
        });
    }

    const showTags = (tags) => {
        tags.forEach(element => {
            const postResult = document.createElement("div");
            console.log(element.name)
            postResult.innerHTML = `
                <div class="p-2">
                    <p>
                        ${element.name}
                    </p>
                </div>
            `
            resultsDiv.appendChild(postResult)
        });
    }

    const showUsers = (users) => {
        console.log(users)
        users.forEach(element => {
            const postResult = document.createElement("div");
            const url = `{{ url('/users/') }}/${element.id}`
            postResult.innerHTML = `
                <div class="p-2">
                    <a href="${url}" class="">
                        <div class="flex gap-1">
                            <p class="align-middle">
                                ${element.public_name}
                                <span class="text-sm text-gray-600 text-nowrap text-ellipsis overflow-hidden align-middle">
                                    ${element.username}
                                </span>
                            </p>
                        </div>
                        <p class="text-sm text-gray-600 text-nowrap text-ellipsis overflow-hidden">
                            ${element.email}
                        </p>
                    </a>
                    
                </div>
            `
            resultsDiv.appendChild(postResult)
        });
    }
    searchBarDiv.onkeyup = async () => {
        resultsDiv.innerHTML = ''
        const searchQuery = searchURL+searchBarDiv.value
        const response = await fetch(searchQuery)
        const data = await response.json()
        showTags(data["tags"])
        showPosts(data["newsPosts"])
        showUsers(data["users"])
    }
</script>