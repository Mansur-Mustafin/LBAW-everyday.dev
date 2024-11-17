<header class="py-3 px-5 flex justify-between items-center border-b border-1 border-gray-700">
    <div>
        <div>
            <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
            @if (!Auth::check())
                <a class="button" href="{{ route('login') }}">Login</a>
                <a class="button" href="{{ route('register') }}">Register</a>
            @endif
        </div>

        @if (Auth::check())
            <a class="button" href="{{ url('/logout') }}"> Logout </a>
            <a class="button" href="{{ url('/me') }}"> {{ Auth::user()->username }} </a>
        @endif
    </div>

    <div class="" relative>
        <div class="flex text-black bg-white rounded-t p-1 w-96">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"  viewBox="0 0 30 30" class="">
                <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
            </svg>                
            <input id="search-bar" type="text" class=" h-full p-2 outline-none rounded-t w-full">
        </div>
        <div id="search-results" class=" text-black bg-white divide-y z-20 absolute w-96"></div>
    </div>

    @if (Auth::check())
        <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ url('/news/create-post') }}">
            New post
        </a>
    @endif
</header>

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