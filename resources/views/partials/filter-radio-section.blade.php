<div class="filter-section">
    <h4 class="filter-header mb-2 flex flex-row cursor-pointer">
        <span class="text-gray-400 text-sm grow">{{$title}}</span>
        <svg class="transition ease-out rotate-180" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="lucide lucide-chevron-up">
            <path d="m18 15-6-6-6 6" />
        </svg>
    </h4>

    <div
        class="filter-list flex flex-col gap-1.5 pl-2 overflow-hidden transition-[max-height] duration-300 ease-in-out max-h-0">
        @foreach ($options as $key => $option)
            <div class="list-element flex items-center">
                <label class="text-sm font-medium text-gray-300 hover:text-white transition">
                    <input type="radio" name="{{$name}}" value="{{$option}}" {{$key == 0 ? 'checked' : ''}}
                        class="form-radio w-4 h-4 text-purple ring-offset-gray-800 bg-gray-700 border-gray-600" />
                    &nbsp;{{$option}}
                </label>
            </div>
        @endforeach
    </div>
</div>