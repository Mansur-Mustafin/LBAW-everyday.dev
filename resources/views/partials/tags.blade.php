<div class="flex flex-wrap gap-2 mb-2 mt-1">
    @foreach ($tags as $tag)
        <span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm">{{$tag}}</span>
    @endforeach
</div>