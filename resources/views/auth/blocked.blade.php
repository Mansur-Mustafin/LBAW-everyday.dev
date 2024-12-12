@extends('layouts.body.single-form')

@include('partials.success-popup')
@section('content')
<div class="flex items-center justify-center">
    <div class="flex items-center justify-center md:flex-row rounded-2xl shadow-2xl shadow-gray-900 max-w-4xl w-full overflow-hidden">

        @if (Auth::user()->status == 'blocked')
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
                <h2 class="text-3xl font-bold mb-4">You are blocked</h2>
                <p class="mb-6">
                    You have been blocked for going against our guidelines. You can submit a request to be unblocked that will be reviewed by our administrators.
                </p>
            </div>

            <div class="md:w-1/2 p-8 w-full">
                <form method="POST" action="{{ route('unblock.create') }}" id="blockedForm">
                    {{ csrf_field() }}
                    <h2 class="text-2xl font-bold mb-4 text-center">Why should you be unbanned?</h2>
                    <div class="flex flex-col mb-2">
                        <textarea form="blockedForm" id="description" name="description" rows="5" class="text-black outline-none rounded m-1 p-2" autofocus></textarea>
                        @error('description')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mb-4 gap-2">
                        <a href="{{ url('logout') }}"
                            class=" bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200">
                            Logout
                        </a>
                        <button type="submit"
                            class=" bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

        @elseif(Auth::user()->status == 'pending')
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center text-white">
                <h2 class="text-3xl font-bold mb-4">Where developers suffer together</h2>
                <p class="mb-6">
                    We know how hard it is to be a developer. It doesn't have to be. Personalized news feed, dev community,
                    and search, much better than what's out there. Maybe ;)
                </p>
            </div>
            <div class="md:w-1/2 p-8 w-full">
                <h2 class="text-2xl font-bold mb-4 text-center">Your request is pending</h2>
                <p class="flex flex-col mb-2 text-center">
                    Your request is know being analyzed by our administrators.
                </p>
                <a href="{{ url('logout') }}"
                    class=" bg-white hover:bg-gray-300 text-black rounded-xl px-6 py-2 font-bold transition duration-200 flex flex-col items-center">
                    Logout
                </a>
            </div>
        @else
            <script>window.location = "{{route('home')}}"</script>
        @endif
    </div>
</div>
@endsection
