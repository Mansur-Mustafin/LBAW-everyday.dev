<div id="filter" class="w-64 flex flex-col gap-3 absolute z-50 right-4 top-10 bg-input p-4 rounded-lg opacity-100 transition ease-out">
    
    <div class="flex flex-row">
        <h3 class="font-semibold text-md grow">Filter</h3>
        <button id="clear-all-button" class="font-semibold text-sm hover:underline text-violet-400">Clear All</button>
    </div>
    
    @php
        $tags = ['hello','machine','learining','4','5','6','7','8','9','10','11','12'];
        $limit = 6;
    @endphp

    <div class="filter-section">
        <h4 class="filter-header mb-2 flex flex-row cursor-pointer">
            <span class="text-gray-400 text-sm grow">Tags</span>
            <svg class="transition ease-out" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up"><path d="m18 15-6-6-6 6"/></svg>
        </h4>
        
        
        <div class="filter-list flex flex-col gap-1.5 pl-2 overflow-hidden transition-[max-height] duration-300 ease-in-out max-h-0">
            @if (count($tags) > 6)
                <div class="rounded-md px-2 py-1 mb-2 flex flex-row items-center">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input class="w-44 bg-inherit outline-none text-sm" type="text" placeholder="Search...">
                </div>
            @endif
            
            
            @foreach ($tags as $key => $tag)
                @if ($key < $limit)
                    <div class="list-element flex items-center">
                        <label class="text-sm font-medium text-gray-300 hover:text-white transition">
                            <input type="checkbox" value="" class="form-checkbox w-4 h-4 text-violet-600 rounded ring-offset-gray-800 bg-gray-700 border-gray-600"/>
                            &nbsp;Apple {{$tag}}
                        </label>
                    </div>
                @endif
            @endforeach
            
            @if (count($tags) > 6)
                <div class="filter-list-limit flex flex-col gap-1.5 overflow-hidden transition-[max-height] duration-300 ease-in-out max-h-0">
                    @foreach ($tags as $key => $tag)
                        @if ($key >= $limit)
                            <div class="list-element flex items-center">
                                <label class="text-sm font-medium text-gray-300 hover:text-white transition">
                                    <input type="checkbox" value="" class="form-checkbox w-4 h-4 text-violet-600 rounded ring-offset-gray-800 bg-gray-700 border-gray-600"/>
                                    &nbsp;Apple {{$tag}}
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="show-more-item">
                    <button class="show-all-button ml-2 text-sm text-violet-400 hover:underline" data-value="show-all">
                        Show All
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>


