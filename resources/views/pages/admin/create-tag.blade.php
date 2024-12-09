@extends('layouts.body.admin')

@section('content')

@include('partials.success-popup')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <form method="POST" action="{{ url('/admin/tags/create') }}" enctype="multipart/form-data"
        class="px-3 flex flex-col gap-4 mt-4" id="admin-edit-profile">
        @csrf

        <h3 class="font-bold text-lg flex-1">Tag Information</h3>

        <div class="flex flex-col">
            <label class="font-bold text-sm">Tag</label>
            <input name="name" class="rounded-2xl bg-input outline-none p-3" placeholder="Name*" value="">
            @error('name')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex gap-2 self-end">
            <a href="{{ url('/admin/tags') }}" class="text-input bg-white font-bold rounded-xl px-6 py-2">Cancel</a>
            <button class="text-input bg-white font-bold rounded-xl px-6 py-2" type="submit">Create Tag</button>
        </div>

    </form>
</section>

@endsection