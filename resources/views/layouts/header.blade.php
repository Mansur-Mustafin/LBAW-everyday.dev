<header
    class="fixed h-20 bg-background py-3 px-5 flex items-center justify-between border-b border-1 border-gray-700 w-full z-50">
    <div>
        <h1 class="hidden tablet:block text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
        <a href="{{ url('/') }}"><img src="{{ asset('favicon.ico') }}" class="w-8 tablet:hidden" alt="Search Icon"></a>
    </div>

    <div>
        <div id="search-container" class="rounded-2xl bg-input p-3 hidden tablet:flex laptop:w-80 desktop:w-96 w-52">
            @include('partials.svg.search')
            <input data-url="{{ url('') }}" data-auth="{{ Auth::check() }}" id="search-bar" type="text"
                class="bg-input outline-none w-full" placeholder="Type to search...">
        </div>
        <div id="search-results" class="bg-input z-20 absolute laptop:w-80 desktop:w-96 w-80 rounded-b-xl"></div>
    </div>

    <div class="flex gap-2">
        @if (Auth::check())
            {{-- Notifications --}}
            <a class="bg-white text-black rounded-xl p-2 font-bold" href="{{ route('notifications.index') }}"
                title="notifications">
                <div class="w-6 h-6 rounded-md relative">
                    @include('partials.svg.header.notifications')
                    @if (Auth::user()->hasUnseenNotifications())
                        <div class="related bg-red-400 rounded-full w-3 h-3 absolute bottom-4 left-4"></div>
                    @endif
                </div>
            </a>
            @if (Auth::user()->isAdmin())
                <a class="bg-white text-black rounded-xl px-6 py-2 font-bold hidden laptop:block" href="{{ url('/admin') }}">
                    Dashboard
                </a>
                <a class="bg-white text-black rounded-xl p-2 font-bold laptop:hidden" href="{{ url('/admin') }}">
                    @include('partials.svg.header.admin')
                </a>
            @endif
            <a class="bg-white text-black rounded-xl px-6 py-2 font-bold hidden laptop:block"
                href="{{ route('news.create') }}">
                New post
            </a>
            <a class="bg-white text-black rounded-xl p-2 laptop:hidden " href="{{ route('news.create') }}">
                @include('partials.svg.header.create')
            </a>
            <a class="bg-white text-black rounded-xl p-2 font-bold" href="{{ route('user.posts', Auth::id()) }}">
                <img class="w-6 h-6 rounded-md" src="{{ Auth::user()->profileImage->url }}" alt="Profile Image">
            </a>
        @else
            <a class="button bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ route('login') }}">Login</a>
            <a class="button bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ route('register') }}">Register</a>
        @endif
    </div>
</header>