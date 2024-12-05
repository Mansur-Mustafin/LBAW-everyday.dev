@extends('layouts.app')

@section('content')

<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[45rem] px-10 py-12 border-x border-gray-700">
        <div class="container">
            <h1 class="text-2xl font-bold">Contact Us</h1>
            <p class="text-lg mt-2">We'd love to hear from you!</p>
        </div>
        <h2 class="text-2xl font-semibold text-purple-700 mt-10 mb-4">Get in Touch</h2>
        <p class="text-gray-400 leading-relaxed mb-6">
            If you have any questions, feedback, or need support, feel free to reach out to us through the contact details below.
        </p>
        <ul class="text-gray-400 space-y-4">
            <li class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-700 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l4-4m0 0l4 4m-4-4v12m8-8h6M3 14h6m-6 4h6m4 0v4m0-4h2m-2-4h6m-6 0v4m0-4h2m-2 0h6m-6-8V4"/>
                </svg>
                <strong class="mr-2">Phone:</strong> +351 225 624 600
            </li>
            <li class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-700 mt-2 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                </svg>
                <strong class="mr-2">Email:</strong> <a href="mailto:support@everyday.dev" class="text-purple-700 hover:underline">support@everyday.dev</a>
            </li>
            <li class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-700 mr-2" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <strong class="mr-2">Address:</strong> Rua da Tecnologia, 42, Lisboa, Portugal
            </li>
        </ul>
    </section>
</section>

@endsection