<header class="py-3 px-5 flex items-center justify-between border-b border-1 border-gray-700 ">
    <div>
        <div>
            <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
            @if (!Auth::check())
                <a class="button" href="{{ route('login') }}">Login</a>
                <a class="button" href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>

    <div>
        <div id="search-container" class="rounded-2xl bg-input p-3 hidden tablet:flex laptop:w-96 desktop:w-96 w-80">
            <svg class="h-8 w-8 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                        stroke="#e0e0e0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
            <input data-url="{{ url('') }}" id="search-bar" type="text" class="bg-input outline-none w-full"
                placeholder="Type to search...">
        </div>
        <div id="search-results" class="bg-input z-20 absolute laptop:w-96 desktop:w-96 w-80"></div>
    </div>

    <div class="flex gap-2">
        @if (Auth::check())
            @if(Auth::user()->isAdmin())
                <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ url('/admin') }}">
                    Dashboard
                </a>
            @endif
            <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold hidden laptop:block"
                href="{{ url('/news/create-post') }}">
                New post
            </a>
            <a type="button" class="bg-white text-black rounded-xl p-2 laptop:hidden "
                href="{{ url('/news/create-post') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </a>
            <a type="button" class="bg-white text-black rounded-xl p-2 font-bold"
                href="{{ url('/users/' . Auth::id()) . '/posts' }}">
                <img class="w-6 h-6 rounded-md" src="{{Auth::user()->profile_image_path}}" alt="">
            </a>
        @endif
    </div>
</header>