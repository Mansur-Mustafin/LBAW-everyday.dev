<header class="py-3 px-5 flex items-center border-b border-1 border-gray-700">
    <div class="flex-1">
        <div>
            <h1 class="text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
            @if (!Auth::check())
                <a class="button" href="{{ route('login') }}">Login</a>
                <a class="button" href="{{ route('register') }}">Register</a>
            @endif
        </div>
    </div>

    <div class="flex gap-2">
    @if (Auth::check())
        @if(Auth::user()->isAdmin())
            <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ url('/admin') }}">
                Dashboard
            </a>
        @endif
        <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ url('/news/create-post') }}">
            New post
        </a>
        <a type="button" class="bg-white text-black rounded-xl px-2 py-2 font-bold" href="{{ url('/users/' . Auth::id()) . '/posts' }}">
            <img class="w-6 h-6" src="{{Auth::user()->profile_image_path}}" alt="">
        </a>
    @endif

    </div>
</header>