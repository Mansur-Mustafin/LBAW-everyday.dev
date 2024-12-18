<div id="filter"
    class="w-64 pointer-events-none flex flex-col gap-3 absolute z-30 right-4 top-10 bg-input p-4 rounded-lg opacity-0 transition ease-out">

    <div class="flex flex-row mb-3">
        <h3 class="font-semibold text-md grow">Filter</h3>
        <button id="clear-all-button" class="font-semibold text-sm hover:underline text-violet-400">Clear All</button>
    </div>

    @include('partials.filter-checkbox-section', [
    'title' => 'Tags',
    'items' => $tags,
    'name' => 'tags',
])
    @include('partials.filter-checkbox-section', [
    'title' => 'Author Rank',
    'items' => $rankings,
    'name' => 'ranks',
])
    @include('partials.filter-radio-section', [
    'title' => 'Date Range',
    'options' => ['All Time', 'Last Day', 'Last Week', 'Last Month', 'Last Year'],
    'name' => 'date_range',
])
</div>