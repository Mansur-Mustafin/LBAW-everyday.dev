@extends('layouts.body.default')

@section('title','Create Tag')

@section('content')

@include('partials.success-popup')

<section
    class="flex flex-col laptop:border-x p-5 laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <form method="POST" action="{{ url('/tag_proposals/create') }}" enctype="multipart/form-data"
        class="flex flex-col gap-4" id="admin-edit-profile">
        @csrf

        <h3 class="font-bold text-lg flex-1">Tag Proposal Information</h3>

        <div class="flex flex-col">
            <label class="font-bold text-sm mb-2" for="name">Tag</label>
            <input name="name" id="name" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Name*" value="">
            @error('name')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col">
            <label class="font-bold text-sm mb-2" for="description">Why this tag?</label>
            <input name="description" id="description" class="rounded-2xl bg-input outline-none p-3 text-sm" placeholder="Description*"
                value="">
            @error('description')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="flex gap-2 self-end">
            <a href="{{ url('/admin/tags') }}" class="text-input bg-white font-bold rounded-xl px-6 py-2">Cancel</a>
            <button class="text-input bg-white font-bold rounded-xl px-6 py-2" type="submit">Create</button>
        </div>

    </form>
</section>

@endsection