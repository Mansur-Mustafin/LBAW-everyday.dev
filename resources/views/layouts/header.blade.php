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
            <a class="button" href="{{ url('/users/' . Auth::id()) . '/posts' }}"> {{ Auth::user()->username }} </a>
        @endif
    </div>

    @if (Auth::check())
        <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ url('/news/create-post') }}">
            New post
        </a>
    @endif
</header>