<div id='post-options-popup'
   class="pointer-events-none transition ease-out bg-input w-48 absolute top-11 right-0 flex flex-col opacity-0 rounded-xl post-popup">

   @can('update', $post)
      <button onclick="toggleEdit()"
        class="text-gray-400 px-3 py-2 rounded-xl w-full flex items-center gap-2 text-sm hover:bg-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-pencil">
          <path
            d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
          <path d="m15 5 4 4" />
        </svg>
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
         <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-trash">
            <path d="M3 6h18" />
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
         </svg>
         Delete post
      </button>
   </form>

   @if (Auth::check() && Auth::user()->isAdmin())
      <div id="omit-section" data-url='{{ url('') }}' data-post={{ $post->id }}>
        <button
          class="omit-post-button text-gray-400 px-3 py-2 rounded-xl w-full flex items-center gap-2 text-sm hover:bg-gray-700 {{ $post->is_omitted ? 'hidden' : '' }}"
          type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-eye-off">
            <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
            <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
            <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
            <path d="m2 2 20 20" />
          </svg>
          Omit post</button>
        <button
          class="unomit-post-button text-gray-400 text-sm px-3 py-2 rounded-xl w-full flex items-center gap-2 hover:bg-gray-700 {{ $post->is_omitted ? '' : 'hidden' }}"
          type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-eye">
            <path
               d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
            <circle cx="12" cy="12" r="3" />
          </svg>
          Un-Omit post</button>
      </div>
   @endif

</div>