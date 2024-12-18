<?php
$urlParts = explode('/', url()->current());
$page = end($urlParts);
?>
<aside class="p-5 border-r border-solid border-gray-700 hidden laptop:h-full laptop:flex laptop:flex-col">
    <div class="sticky top-[6rem] mt-3 laptop:flex laptop:flex-col laptop:gap-1">
        <a href="{{ route('admin.dashboard') }}"
            class="flex p-2 rounded-md hover:bg-gray-700 {{ $page == 'dashboard' ? 'bg-gray-800' : '' }} mt-4 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-gauge">
                <path d="M15.6 2.7a10 10 0 1 0 5.7 5.7" />
                <circle cx="12" cy="12" r="2" />
                <path d="M13.4 10.6 19 5" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}"
            class="flex p-2 rounded-md hover:bg-gray-700 {{ $page == 'users' ? 'bg-gray-800' : '' }} gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Users
        </a>
        <a href="{{ route('admin.tags') }}"
            class="flex p-2 rounded-md hover:bg-gray-700 gap-2 {{ $page == 'tags' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-tags">
                <path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19" />
                <path
                    d="M9.586 5.586A2 2 0 0 0 8.172 5H3a1 1 0 0 0-1 1v5.172a2 2 0 0 0 .586 1.414L8.29 18.29a2.426 2.426 0 0 0 3.42 0l3.58-3.58a2.426 2.426 0 0 0 0-3.42z" />
                <circle cx="6.5" cy="9.5" r=".5" fill="currentColor" />
            </svg>
            Tags
        </a>
        <a href="{{ route('admin.tag_proposals') }}"
            class="flex p-2 rounded-md hover:bg-gray-700 gap-2 {{ $page == 'tag_proposals' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-hand-helping">
                <path d="M11 12h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 14" />
                <path d="m7 18 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                <path d="m2 13 6 6" />
            </svg>
            Tag Proposals
        </a>
        <a href="{{ route('admin.unblock_appeals') }}"
            class="flex p-2 rounded-md hover:bg-gray-700 gap-2 {{ $page == 'unblock_appeals' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-message-square-lock">
                <path d="M19 15v-2a2 2 0 1 0-4 0v2" />
                <path d="M9 17H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3.5" />
                <rect x="13" y="15" width="8" height="5" rx="1" />
            </svg>
            Unblock Appeals
        </a>
    </div>
</aside>

<aside class="min-w-16 border-r border-solid border-gray-700 laptop:hidden h-full flex flex-col items-center gap-2">
    <div class="sticky top-[6rem] mt-3 laptop:flex laptop:flex-col laptop:items-center">
        <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded-md hover:bg-gray-700 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-gauge">
                <path d="M15.6 2.7a10 10 0 1 0 5.7 5.7" />
                <circle cx="12" cy="12" r="2" />
                <path d="M13.4 10.6 19 5" />
            </svg>
        </a>
        <a href="{{ route('admin.users') }}" class="block p-2 rounded-md hover:bg-gray-700 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
        </a>
        <a href="{{ route('admin.tags') }}" class="block p-2 rounded-md hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-tags">
                <path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19" />
                <path
                    d="M9.586 5.586A2 2 0 0 0 8.172 5H3a1 1 0 0 0-1 1v5.172a2 2 0 0 0 .586 1.414L8.29 18.29a2.426 2.426 0 0 0 3.42 0l3.58-3.58a2.426 2.426 0 0 0 0-3.42z" />
                <circle cx="6.5" cy="9.5" r=".5" fill="currentColor" />
            </svg>
        </a>
        <a href="{{ route('admin.tag_proposals') }}" class="block p-2 rounded-md hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-hand-helping">
                <path d="M11 12h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 14" />
                <path d="m7 18 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                <path d="m2 13 6 6" />
            </svg>
        </a>
        <a href="{{ route('admin.unblock_appeals') }}" class="block p-2 rounded-md hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-message-square-lock">
                <path d="M19 15v-2a2 2 0 1 0-4 0v2" />
                <path d="M9 17H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3.5" />
                <rect x="13" y="15" width="8" height="5" rx="1" />
            </svg>
        </a>
    </div>
</aside>
