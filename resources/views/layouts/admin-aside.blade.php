<?php
$urlParts = explode('/', url()->current());
$page = end($urlParts);
?>
<aside class="p-3 tablet:p-5 border-r border-solid border-gray-700 h-full w-16 laptop:min-w-56">
    <div class="sticky top-[6rem] flex flex-col items-center laptop:items-start gap-1">
        <a href="{{ route('admin.dashboard') }}"
            class="laptop:flex p-2 w-full rounded-md hover:bg-gray-700 items-center {{ $page == 'admin' ? 'bg-gray-800' : '' }} gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-gauge">
                <path d="M15.6 2.7a10 10 0 1 0 5.7 5.7" />
                <circle cx="12" cy="12" r="2" />
                <path d="M13.4 10.6 19 5" />
            </svg>
            <span class="hidden laptop:block">Dashboard</span>
        </a>
        <a href="{{ route('admin.users') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 items-center {{ $page == 'users' ? 'bg-gray-800' : '' }} gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            <span class="hidden laptop:block">Users</span>
        </a>
        <a href="{{ route('admin.tags') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'tags' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-tags">
                <path d="m15 5 6.3 6.3a2.4 2.4 0 0 1 0 3.4L17 19" />
                <path
                    d="M9.586 5.586A2 2 0 0 0 8.172 5H3a1 1 0 0 0-1 1v5.172a2 2 0 0 0 .586 1.414L8.29 18.29a2.426 2.426 0 0 0 3.42 0l3.58-3.58a2.426 2.426 0 0 0 0-3.42z" />
                <circle cx="6.5" cy="9.5" r=".5" fill="currentColor" />
            </svg>
            <span class="hidden laptop:block">Tags</span>
        </a>
        <a href="{{ route('admin.tag_proposals') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'tag_proposals' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-hand-helping">
                <path d="M11 12h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 14" />
                <path d="m7 18 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                <path d="m2 13 6 6" />
            </svg>
            <span class="hidden laptop:block">Tag Proposals</span>
        </a>
        <a href="{{ route('admin.unblock_appeals') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'unblock_appeals' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-message-square-lock">
                <path d="M19 15v-2a2 2 0 1 0-4 0v2" />
                <path d="M9 17H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3.5" />
                <rect x="13" y="15" width="8" height="5" rx="1" />
            </svg>
            <span class="hidden laptop:block">Unblock Appeals</span>
        </a>
        <a href="{{ route('admin.reports') }}" class="flex p-2 rounded-md hover:bg-gray-700 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-warning"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
                <path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            <span class="hidden laptop:block">Reports</span>
        </a>
        <a href="{{ route('admin.omitted_posts') }}" class="flex p-2 rounded-md hover:bg-gray-700 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-pencil-off">
                <path
                    d="m10 10-6.157 6.162a2 2 0 0 0-.5.833l-1.322 4.36a.5.5 0 0 0 .622.624l4.358-1.323a2 2 0 0 0 .83-.5L14 13.982" />
                <path d="m12.829 7.172 4.359-4.346a1 1 0 1 1 3.986 3.986l-4.353 4.353" />
                <path d="m15 5 4 4" />
                <path d="m2 2 20 20" />
            </svg>
            <span class="hidden laptop:block">Hidden Posts</span>
        </a>
        <a href="{{ route('admin.omitted_comments') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'omitted_comments' ? 'bg-gray-800' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-message-circle-off">
                <path d="M20.5 14.9A9 9 0 0 0 9.1 3.5" />
                <path d="m2 2 20 20" />
                <path d="M5.6 5.6C3 8.3 2.2 12.5 4 16l-2 6 6-2c3.4 1.8 7.6 1.1 10.3-1.7" />
            </svg>
            <span class="hidden laptop:block">Hidden Comments</span>
        </a>
    </div>
</aside>
