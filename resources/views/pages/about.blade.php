@extends('layouts.body.default')

@section('content')

<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[45rem] px-10 py-12 border-x border-gray-700">
        <h1 class="text-2xl font-bold text-purple-700">About Us</h1>
        <p class="mt-7 text-gray-400 leading-relaxed">
            Everyday.dev is a platform dedicated to developers, providing a comprehensive suite of tools, resources, and learning opportunities to help you excel in your career. From insightful articles to in-depth tutorials, we are committed to making your journey as a developer productive and enjoyable.
        </p>

        <div class="flex flex-col laptop:flex-row items-center gap-6 mt-12">
            <div class="laptop:w-1/2">
                <blockquote class="mt-6 p-4 border-l-4 border-purple-700 text-gray-300 italic bg-gray-800 rounded-md">
                    "Empowering developers to build the future, one line of code at a time."
                </blockquote>
            </div>

            <div class="laptop:w-1/2">
                <img src="{{ asset('assets/aboutUsImage.jpg') }}" alt="Teamwork" class="rounded-md shadow-md">
            </div>
        </div>

        <h2 class="mt-10 text-2xl font-bold text-purple-700">Team Members</h2>

        <div class="flex gap-6 mt-10 ml-2">
            <img src="{{ asset('assets/Afonso.jpg') }}" alt="Team Member 1" class="w-16 h-16 rounded-full shadow-md">
            <img src="{{ asset('assets/Goiana.jpg') }}" alt="Team Member 2" class="w-16 h-16 rounded-full shadow-md">
            <img src="{{ asset('assets/Mansur.jpg') }}" alt="Team Member 3" class="w-16 h-16 rounded-full shadow-md">
            <img src="{{ asset('assets/Rubem.png') }}" alt="Team Member 4" class="w-16 h-16 rounded-full shadow-md">
        </div>
    </section>
</section>

@include('layouts.footer')

@endsection