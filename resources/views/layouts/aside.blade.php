<aside class="border-r border-solid border-gray-700 hidden laptop:h-full laptop:flex laptop:flex-col laptop:min-w-48 laptop:items-center">
    
    <a href="{{ route('news.recent') }}" class="block p-2 rounded-md hover:bg-gray-700 mt-4">Recent News</a>
    @if (Auth::check())
        <a href="{{ route('news.my') }}" class="block p-2 rounded-md hover:bg-gray-700">Your News</a>

        <div class="border-2 rounded-xl border-gray-500 w-9/12 my-3"></div>

        <a href="{{ route('news.bookmarks') }}" class="block p-2 rounded-md hover:bg-gray-700">Bookmarks</a>
    @endif
</aside>

<aside class="min-w-16 border-r border-solid border-gray-700 laptop:hidden h-full flex flex-col items-center gap-2">
    <a href="{{ route('news.recent') }}" class="block p-2 rounded-md hover:bg-gray-700 mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg></a>
    @if (Auth::check())
        <a href="{{ route('news.my') }}" class="block rounded-md p-2 hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></a>

        <div class="border-2 rounded-xl border-gray-500 w-9/12 my-3"></div>
        
        <a href="{{ route('news.bookmarks') }}" class="block rounded-md p-2 hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-plus"> <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" /> <line x1="12" x2="12" y1="7" y2="13" /> <line x1="15" x2="9" y1="10" y2="10" /> </svg></a>
    @endif
</aside>
