<div id='post-options-popup'
   class="pointer-events-none transition ease-out bg-input w-48 absolute top-11 right-0 flex flex-col opacity-0 rounded-xl post-popup">

   @can('update', $post)
      <button onclick="toggleEdit()"
        class="text-gray-400 px-3 py-2 rounded-xl w-full flex items-center gap-2 text-sm hover:bg-gray-700">
        @include('partials.svg.comment.edit')
        Edit post
      </button>
   @endcan

   <form method="POST" action="/news/{{ $post->id }}">
      @csrf
      @method('DELETE')
      <button type="submit" @class([
   'delete-post-button px-3 py-2 rounded-xl w-full text-sm flex items-center hover:bg-gray-700 text-gray-400 gap-2',
   'hidden' => Gate::denies('delete', $post)
])>
         @include('partials.svg.comment.delete')
         Delete post
      </button>
   </form>

   @if (Auth::check() && Auth::user()->isAdmin())
      <div id="omit-section" data-url='{{ url('') }}' data-post={{ $post->id }}>
        <button
          class="omit-post-button text-gray-400 px-3 py-2 rounded-xl w-full flex items-center gap-2 text-sm hover:bg-gray-700 {{ $post->is_omitted ? 'hidden' : '' }}"
          type="submit">
          @include('partials.svg.comment.omit')
          Omit post</button>
        <button
          class="unomit-post-button text-gray-400 text-sm px-3 py-2 rounded-xl w-full flex items-center gap-2 hover:bg-gray-700 {{ $post->is_omitted ? '' : 'hidden' }}"
          type="submit">
          @include('partials.svg.comment.unomit')
          Un-Omit post</button>
      </div>
   @endif

</div>