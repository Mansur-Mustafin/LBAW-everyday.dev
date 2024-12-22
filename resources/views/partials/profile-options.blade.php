<div id='profile-options-popup' class="bg-input w-48 absolute top-11 right-0 flex flex-col opacity-0 rounded-xl transition ease-out">
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
      <button type="submit" data-url='{{url('')}}' data-user={{$user->id}} class="delete-account-button text-red-400 rounded-lg px-4 py-2 text-sm w-full text-start hover:bg-gray-700">
        Delete My Account
      </button>
   @endif
   @if (Auth::check() and (Auth::id() == $user->id))
      <a href="{{ url('/logout') }}" class="text-gray-400 rounded-xl px-4 py-2 text-sm hover:bg-gray-700">Logout</a>
   @endif
</div>
<div id="confirm-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
  <div class="bg-input p-6 rounded-lg w-96 text-black">
    <h3 class="text-lg font-semibold text-white mb-4">Are you sure?</h3>
    <p class="text-gray-300 mb-6">This action <span class="font-bold">DELETES</span> your account and it cannot be
      undone.</p>
    <div class="flex justify-end gap-2">
      <a id="cancel-button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400" href="">Cancel</a>
      <a id="confirm-button" class="px-4 py-2 bg-purple-900 text-white rounded-lg hover:bg-purple-700"
        href="">Confirm</a>
    </div>
  </div>
</div>