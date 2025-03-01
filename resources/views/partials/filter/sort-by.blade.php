<div id="sort-popup"
    class="w-36 pointer-events-none absolute z-40 right-4 top-10 bg-input p-4 rounded-lg opacity-0 transition ease-out">
    <input name="order_by" type="hidden" value="Sort by">

    <ul class="flex flex-col text-sm text-gray-200 gap-1">
        <li data-header="Top News" class="text-start w-full hover:bg-[#2A2B2E] px-3 py-1.5 rounded-md cursor-pointer">
            Most upvoted</li>
        <li data-header="Recent News"
            class="text-start w-full hover:bg-[#2A2B2E] px-3 py-1.5 rounded-md cursor-pointer">Most recent</li>
    </ul>
</div>