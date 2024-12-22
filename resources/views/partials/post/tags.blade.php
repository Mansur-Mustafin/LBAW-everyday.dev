<div class="hidden tablet:flex gap-2 mb-2 mt-1 items-center">
    @foreach (array_slice($tags, 0, 2) as $tag)
        <div class="text-sm text-gray-400 font-medium lowercase bg-input px-2 rounded-md flex gap-2">
            #{{ $tag }}
        </div>
    @endforeach

    @if(count($tags) > 2)
        <span class="text-sm">+ {{count($tags) - 2 }}</span>
    @endif
</div>

<div class="flex tablet:hidden gap-2 mb-2 mt-1 items-center">
    @foreach (array_slice($tags, 0, 3) as $tag)
        <div class="text-sm text-gray-400 font-medium lowercase bg-input px-2 rounded-md flex gap-2">
            #{{ $tag }}
        </div>
    @endforeach

    @if(count($tags) > 3)
        <span class="text-sm">+ {{count($tags) - 3 }}</span>
    @endif
</div>