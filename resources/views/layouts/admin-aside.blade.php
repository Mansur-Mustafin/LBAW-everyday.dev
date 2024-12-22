<?php
$urlParts = explode('/', url()->current());
$page = end($urlParts);
?>
<aside class="p-3 tablet:p-5 border-r border-solid border-gray-700 h-full w-16 laptop:min-w-56">
    <div class="sticky top-[6rem] flex flex-col items-center laptop:items-start gap-1">
        <a href="{{ route('admin.dashboard') }}"
            class="laptop:flex p-2 w-full rounded-md hover:bg-gray-700 items-center {{ $page == 'admin' ? 'bg-gray-800' : '' }} gap-2">
            @include('partials.svg.admin.dashboard')
            <span class="hidden laptop:block">Dashboard</span>
        </a>
        <a href="{{ route('admin.users') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 items-center {{ $page == 'users' ? 'bg-gray-800' : '' }} gap-2">
            @include('partials.svg.admin.users')
            <span class="hidden laptop:block">Users</span>
        </a>
        <a href="{{ route('admin.tags') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'tags' ? 'bg-gray-800' : '' }}">
            @include('partials.svg.admin.tags')
            <span class="hidden laptop:block">Tags</span>
        </a>
        <a href="{{ route('admin.tag_proposals') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'tag_proposals' ? 'bg-gray-800' : '' }}">
            @include('partials.svg.admin.tag-proposals')
            <span class="hidden laptop:block">Tag Proposals</span>
        </a>
        <a href="{{ route('admin.unblock_appeals') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'unblock_appeals' ? 'bg-gray-800' : '' }}">
            @include('partials.svg.admin.unblocks')
            <span class="hidden laptop:block">Unblock Appeals</span>
        </a>
        <a href="{{ route('admin.omitted_posts') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'omitted_posts' ? 'bg-gray-800' : '' }}">
            @include('partials.svg.admin.hidden-posts')
            <span class="hidden laptop:block">Hidden Posts</span>
        </a>
        <a href="{{ route('admin.omitted_comments') }}"
            class="laptop:flex block p-2 w-full rounded-md hover:bg-gray-700 gap-2 items-center {{ $page == 'omitted_comments' ? 'bg-gray-800' : '' }}">
            @include('partials.svg.admin.hidden-comments')
            <span class="hidden laptop:block">Hidden Comments</span>
        </a>
    </div>
</aside>