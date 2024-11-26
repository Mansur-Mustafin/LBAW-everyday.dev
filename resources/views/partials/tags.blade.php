<div class="hidden tablet:flex gap-2 mb-2 mt-1 items-center">
    @foreach (array_slice($tags, 0, 2) as $tag)
        <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-lg text-sm">{{$tag}}</span>
    @endforeach

    @if(count($tags) > 2)
        <span class="text-sm">+ {{count($tags) - 2 }}</span>
    @endif
</div>

<div class="flex tablet:hidden gap-2 mb-2 mt-1 items-center">
    @foreach (array_slice($tags, 0, 3) as $tag)
        <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-lg text-sm">{{$tag}}</span>
    @endforeach

    @if(count($tags) > 3)
        <span class="text-sm">+ {{count($tags) - 3 }}</span>
    @endif
</div>