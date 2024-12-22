<div class="filter-section">
    <h4 class="filter-header mb-2 flex flex-row cursor-pointer">
        <span class="text-gray-400 text-sm grow">{{$title}}</span>
        @include('partials.svg.sort')
    </h4>

    <div
        class="filter-list flex flex-col gap-1.5 pl-2 overflow-hidden transition-[max-height] duration-300 ease-in-out max-h-0">
        @if (count($items) > 6)
            <div class="rounded-md px-2 py-1 mb-2 flex flex-row items-center">
                @include('partials.svg.filters.search')
                <input class="w-44 bg-inherit outline-none text-sm" type="text" placeholder="Search...">
            </div>
        @endif

        <h2 class="hidden text-sm" id="no-tags">No tags matched your search</h2>

        @foreach ($items as $key => $item)
            @if ($key < 6)
                <div class="ml-1 list-element flex items-center">
                    <label class="text-sm font-medium text-gray-300 hover:text-white transition">
                        <input type="checkbox" value="{{$item}}" name="{{$name}}"
                            class="form-checkbox w-4 h-4 text-purple rounded ring-offset-gray-800 bg-gray-700 border-gray-600   " />
                        &nbsp;{{$item}}
                    </label>
                </div>
            @endif
        @endforeach

        @if (count($items) > 6)
            <div
                class="filter-list-limit flex flex-col gap-1.5 overflow-hidden transition-[max-height] duration-300 ease-in-out max-h-0">
                @foreach ($items as $key => $item)
                    @if ($key >= 6)
                        <div class="ml-1 list-element flex items-center">
                            <label class="text-sm font-medium text-gray-300 hover:text-white transition">
                                <input type="checkbox" value="{{$item}}" name="{{$name}}"
                                    class="form-checkbox w-4 h-4 text-purple rounded ring-offset-gray-800 bg-gray-700 border-gray-600" />
                                &nbsp;{{$item}}
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