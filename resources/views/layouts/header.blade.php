<header
    class="fixed h-20 bg-background py-3 px-5 flex items-center justify-between border-b border-1 border-gray-700 w-full z-50">
    <div>
        <h1 class="hidden tablet:block text-2xl h1"><a href="{{ url('/') }}">everyday.dev</a></h1>
        <a href="{{ url('/') }}"><img src="{{ asset('favicon.ico') }}" class="w-8 tablet:hidden" alt="Search Icon"></a>
    </div>

    <div>
        <div id="search-container" class="rounded-2xl bg-input p-3 hidden tablet:flex laptop:w-80 desktop:w-96 w-52">
            <svg class="h-8 w-8 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                        stroke="#e0e0e0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
            <input data-url="{{ url('') }}" data-auth="{{ Auth::check() }}" id="search-bar" type="text"
                class="bg-input outline-none w-full" placeholder="Type to search...">
        </div>
        <div id="search-results" class="bg-input z-20 absolute laptop:w-80 desktop:w-96 w-80 rounded-b-xl"></div>
    </div>

    <div class="flex gap-2">
        @if (Auth::check())
            {{-- Notifications --}}
            <a type="button" class="bg-white text-black rounded-xl p-2 font-bold" href="{{ route('notifications.index') }}"
                title="notifications">
                <div class="w-6 h-6 rounded-md relative">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M19.3399 14.49L18.3399 12.83C18.1299 12.46 17.9399 11.76 17.9399 11.35V8.82C17.9399 6.47 16.5599 4.44 14.5699 3.49C14.0499 2.57 13.0899 2 11.9899 2C10.8999 2 9.91994 2.59 9.39994 3.52C7.44994 4.49 6.09994 6.5 6.09994 8.82V11.35C6.09994 11.76 5.90994 12.46 5.69994 12.82L4.68994 14.49C4.28994 15.16 4.19994 15.9 4.44994 16.58C4.68994 17.25 5.25994 17.77 5.99994 18.02C7.93994 18.68 9.97994 19 12.0199 19C14.0599 19 16.0999 18.68 18.0399 18.03C18.7399 17.8 19.2799 17.27 19.5399 16.58C19.7999 15.89 19.7299 15.13 19.3399 14.49Z"
                                fill="#292D32"></path>
                            <path
                                d="M14.8297 20.01C14.4097 21.17 13.2997 22 11.9997 22C11.2097 22 10.4297 21.68 9.87969 21.11C9.55969 20.81 9.31969 20.41 9.17969 20C9.30969 20.02 9.43969 20.03 9.57969 20.05C9.80969 20.08 10.0497 20.11 10.2897 20.13C10.8597 20.18 11.4397 20.21 12.0197 20.21C12.5897 20.21 13.1597 20.18 13.7197 20.13C13.9297 20.11 14.1397 20.1 14.3397 20.07C14.4997 20.05 14.6597 20.03 14.8297 20.01Z"
                                fill="#292D32"></path>
                        </g>
                    </svg>
                    @if (Auth::user()->hasUnseenNotifications())
                        <div class="related bg-red-400 rounded-full w-3 h-3 absolute bottom-4 left-4"></div>
                    @endif
                </div>
            </a>
            @if (Auth::user()->isAdmin())
                <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold hidden laptop:block"
                    href="{{ url('/admin') }}">
                    Dashboard
                </a>
                <a type="button" class="bg-white text-black rounded-xl p-2 font-bold laptop:hidden" href="{{ url('/admin') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-shield">
                        <path
                            d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                    </svg>
                </a>
            @endif
            <a type="button" class="bg-white text-black rounded-xl px-6 py-2 font-bold hidden laptop:block"
                href="{{ route('news.create') }}">
                New post
            </a>
            <a type="button" class="bg-white text-black rounded-xl p-2 laptop:hidden " href="{{ route('news.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </a>
            <a type="button" class="bg-white text-black rounded-xl p-2 font-bold"
                href="{{ route('user.posts', Auth::id()) }}">
                <img class="w-6 h-6 rounded-md" src="{{ Auth::user()->profileImage->url }}" alt="Profile Image">
            </a>
        @else
            <a class="button bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ route('login') }}">Login</a>
            <a class="button bg-white text-black rounded-xl px-6 py-2 font-bold" href="{{ route('register') }}">Register</a>
        @endif
    </div>
</header>