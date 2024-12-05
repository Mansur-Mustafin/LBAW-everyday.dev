<aside class="border-r border-solid border-gray-700 hidden laptop:h-full laptop:flex laptop:flex-col laptop:min-w-48 laptop:items-center">
    <a href="{{ route('news.my') }}" class="block p-2 rounded-md hover:bg-gray-700 mt-3">Your News</a>
    <a href="{{ route('news.top') }}" class="block p-2 rounded-md hover:bg-gray-700">Top News</a>
    <a href="{{ route('news.recent') }}" class="block p-2 rounded-md hover:bg-gray-700">Recent News</a>

    <div class="fixed bottom-3 laptop:flex laptop:flex-col laptop:items-center">
        <a href="{{ route('contacts') }}" class="block p-2 rounded-md hover:bg-gray-700">Contacts</a>
        <a href="{{ route('about') }}" class="block p-2 rounded-md hover:bg-gray-700">About Us</a>
        <a href="{{ route('features') }}" class="block p-2 rounded-md hover:bg-gray-700">Main Features</a>
    </div>
</aside>

<aside class="min-w-16 border-r border-solid border-gray-700 laptop:hidden h-full flex flex-col items-center gap-2">
    <a href="{{ route('news.my') }}" class="block rounded-md p-2 hover:bg-gray-700 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></a>
    <a href="{{ route('news.top') }}" class="block rounded-md p-2 hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></a>
    <a href="{{ route('news.recent') }}" class="block p-2 rounded-md hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg></a>
    <div class="fixed bottom-3 flex flex-col items-center gap-2">
        <a href="{{ route('contacts') }}" class="block rounded-md p-2 hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16" fill="none" stroke="currentColor" class="bi bi-person-lines-fill"><path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/></svg></a>
        <a href="{{ route('about') }}" class="block rounded-md p-2 hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10" /><line x1="12" y1="16" x2="12" y2="12" /><line x1="12" y1="8" x2="12.01" y2="8" /></svg></a>
        <a href="{{ route('features') }}" class="block p-2 rounded-md hover:bg-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16" fill="none" stroke="currentColor" class="bi bi-clipboard2"><path d="M3.5 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H12a.5.5 0 0 1 0-1h.5A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1H4a.5.5 0 0 1 0 1z"/><path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/></svg></a>
    </div>    
</aside>
