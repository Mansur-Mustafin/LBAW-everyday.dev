@extends('layouts.body.default')

@section('content')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <section class="flex flex-col w-full laptop:w-[50.5rem] px-10 py-12 border-x border-gray-700">

        <h2 class="text-4xl font-bold  mb-4">About Us</h2>
        <p class="mt-7 text-gray-400 leading-relaxed">
            <span class="font-bold">everyday.dev</span> is a community-driven platform designed to revolutionize how developers and tech enthusiasts share, discuss, and curate industry news. It will empower developers to stay updated with industry trends, enhance their skills, and streamline their learning.
        </p>

        <div class="flex flex-col laptop:flex-row items-center gap-6 mt-12">
            <div class="laptop:w-1/2">
                <blockquote class="mt-6 p-4 border-l-4 border-purple-500 text-gray-300 italic bg-gray-800 rounded-md">
                    "Empowering developers to build the future, one line of code at a time."
                </blockquote>
            </div>

            <div class="laptop:w-1/2">
                <img src="{{ asset('assets/aboutUsImage.jpg') }}" alt="Teamwork" class="rounded-md shadow-md">
            </div>
        </div>

        <h2 class="mt-10 text-2xl font-bold text-purple-500">Team Members</h2>

                <div class="flex flex-col tablet:flex-row items-center space-between mt-5">
            <div class="flex flex-col items-center grow">
                <img src="{{ asset('assets/Afonso.jpg') }}" alt="Team Member 2" class="w-20 h-20 rounded-full shadow-md mb-5">
                <p>
                    Afonso Moura
                </p>
            </div>
            <div class="flex flex-col items-center grow">
                <img src="{{ asset('assets/Goiana.jpg') }}" alt="Team Member 2" class="w-20 h-20 rounded-full shadow-md mb-5">
                <p>
                    Diogo Goiana
                </p>
            </div>
            <div class="flex flex-col items-center grow">
                <img src="{{ asset('assets/Mansur.jpg') }}" alt="Team Member 3" class="w-20 h-20 rounded-full shadow-md mb-5">
                <p>
                    Mansur Mustafin
                </p>
            </div>
            <div class="flex flex-col items-center grow">
                <img src="{{ asset('assets/Rubem.png') }}" alt="Team Member 4" class="w-20 h-20 rounded-full shadow-md mb-5">
                <p>
                    Rubem Neto
                </p>
            </div>
        </div>

    </section>
</section>

@include('layouts.footer')

@endsection