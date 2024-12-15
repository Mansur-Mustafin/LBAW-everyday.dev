<aside
    class="border-r border-solid border-gray-700 hidden laptop:h-full laptop:flex laptop:flex-col laptop:min-w-56 p-5">
    <div class="sticky top-[6rem] mt-3 laptop:flex laptop:flex-col">
        <a href="{{ route('news.recent') }}" class="flex gap-2 p-2 rounded-md hover:bg-gray-700 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-clock">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
            </svg>
            Recent News
        </a>
        @if (Auth::check())
            <a href="{{ route('news.my') }}" class="flex gap-2 p-2 rounded-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-house">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                    <path
                        d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg>
                Your News
            </a>

            {{--         <div class="border-2 rounded-xl border-gray-500 w-9/12 my-3"></div> --}}

            <a href="{{ route('news.bookmark') }}" class="flex gap-2 p-2 rounded-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-bookmark-plus">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                    <line x1="12" x2="12" y1="7" y2="13" />
                    <line x1="15" x2="9" y1="10" y2="10" />
                </svg>
                Bookmarks
            </a>
        @endif
    </div>

    <div class="fixed bottom-3 laptop:flex laptop:flex-col w-44">
        <a href="{{ route('contacts') }}" class="flex p-2 rounded-md hover:bg-gray-700 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-notebook-tabs">
                <path d="M2 6h4" />
                <path d="M2 10h4" />
                <path d="M2 14h4" />
                <path d="M2 18h4" />
                <rect width="16" height="20" x="4" y="2" rx="2" />
                <path d="M15 2v20" />
                <path d="M15 7h5" />
                <path d="M15 12h5" />
                <path d="M15 17h5" />
            </svg>
            Contacts
        </a>
        <a href="{{ route('about') }}" class="flex p-2 rounded-md hover:bg-gray-700 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users-round">
                <path d="M18 21a8 8 0 0 0-16 0" />
                <circle cx="10" cy="8" r="5" />
                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
            </svg>
            About Us
        </a>
        <a href="{{ route('features') }}" class="flex p-2 rounded-md hover:bg-gray-700 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="current"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-star">
                <path
                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
            </svg>
            Main Features
        </a>
    </div>
</aside>

<aside class="min-w-16 border-r border-solid border-gray-700 laptop:hidden h-full flex flex-col items-center gap-2">
    <div class="sticky top-[6rem] mt-3 flex flex-col items-center gap-2">
        <a href="{{ route('news.recent') }}" class="block p-2 rounded-md hover:bg-gray-700 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-user-round">
                <circle cx="12" cy="8" r="5" />
                <path d="M20 21a8 8 0 0 0-16 0" />
            </svg>
        </a>
        @if (Auth::check())
            <a href="{{ route('news.my') }}" class="block rounded-md p-2 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-house">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                    <path
                        d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg>
            </a>

            {{--         <div class="border-2 rounded-xl border-gray-500 w-9/12 my-3"></div> --}}

            <a href="{{ route('news.bookmark') }}" class="block rounded-md p-2 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-bookmark-plus">
                    <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                    <line x1="12" x2="12" y1="7" y2="13" />
                    <line x1="15" x2="9" y1="10" y2="10" />
                </svg>
            </a>
        @endif
    </div>
    <div class="fixed bottom-3 flex flex-col items-center gap-2">
        <a href="{{ route('contacts') }}" class="block rounded-md p-2 hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-notebook-tabs">
                <path d="M2 6h4" />
                <path d="M2 10h4" />
                <path d="M2 14h4" />
                <path d="M2 18h4" />
                <rect width="16" height="20" x="4" y="2" rx="2" />
                <path d="M15 2v20" />
                <path d="M15 7h5" />
                <path d="M15 12h5" />
                <path d="M15 17h5" />
            </svg>
        </a>
        <a href="{{ route('about') }}" class="block rounded-md p-2 hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users-round">
                <path d="M18 21a8 8 0 0 0-16 0" />
                <circle cx="10" cy="8" r="5" />
                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
            </svg>
        </a>
        <a href="{{ route('features') }}" class="block p-2 rounded-md hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="current"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-star">
                <path
                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
            </svg>
        </a>
    </div>
</aside>
