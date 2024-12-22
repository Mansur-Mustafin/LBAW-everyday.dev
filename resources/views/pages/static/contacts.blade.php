@extends('layouts.body.default')

@section('title', 'Contacts')

@section('content')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <section class="flex flex-col w-full laptop:w-[50.5rem] px-10 py-12">

        <div class="container">
            <h2 class="text-4xl font-bold  mb-4">Contact Us</h2>
            <p class="text-lg mt-2">We'd love to hear from you!</p>
        </div>
        <h2 class="text-2xl font-semibold mt-10 mb-4">Get in Touch</h2>
        <p class="text-gray-400 leading-relaxed mb-6">
            If you have any questions, feedback, or need support, feel free to reach out to us through the contact
            details below.
        </p>
        <ul class="text-gray-400 space-y-4">
            <li class="flex items-center">
                @include('partials.svg.contacts.phone')
                <strong class="mr-2">Phone:</strong> +351 936 827 450
            </li>
            <li class="flex items-center">
                @include('partials.svg.contacts.email')
                <strong class="mr-2">Email:</strong> <a href="mailto:support@everyday.dev"
                    class="hover:underline">support@everyday.dev</a>
            </li>
            <li class="flex items-center">
                @include('partials.svg.contacts.address')
                <strong class="mr-2">Address:</strong> Rua da FEUP, 302, Porto, Portugal
            </li>
        </ul>
    </section>
</section>

@include('layouts.footer')

@endsection