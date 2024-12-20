<div id='profile-options-popup' class="bg-input w-48 absolute top-11 right-0 flex flex-col opacity-0 rounded-xl">
   @if (Auth::check() and (Auth::id() == $user->id))
      <a href="{{ url('/tag_proposal/create') }}"
        class="text-gray-400 rounded-lg px-4 py-2 text-sm hover:bg-gray-700">Propose new tag</a>
   @endif
   @if (Auth::user()->id === $user->id)
      <a href="{{url('/users/' . $user->id . '/edit')}}"
        class="text-gray-400 rounded-lg px-4 py-2 text-sm hover:bg-gray-700">Edit
        Profile</a>
   @elseif (Auth::user()->is_admin)
      <a href="{{url('/admin/users/' . $user->id . '/edit')}}"
        class="text-gray-400 rounded-lg px-4 py-2 text-sm hover:bg-gray-700">Edit
        Profile</a>
   @endif
   @if (Auth::check() and (Auth::id() == $user->id))
      <form action="{{ url('/users/' . $user->id . '/anonymize') }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="text-gray-400 rounded-lg px-4 py-2 text-sm w-full text-start hover:bg-gray-700">
          Delete My Account
        </button>
      </form>
   @endif
   @if (Auth::check() and (Auth::id() == $user->id))
      <a href="{{ url('/logout') }}" class="text-gray-400 rounded-lg px-4 py-2 text-sm hover:bg-gray-700">Logout</a>
   @endif
</div>