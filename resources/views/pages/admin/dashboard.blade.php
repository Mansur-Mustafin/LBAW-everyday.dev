@extends('layouts.body.admin')

@section('title','Administrator Dashboard')

@section('content')

@include('partials.success-popup')
<section>
    <div
        class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full p-5">
        <div class="flex flex-col gap-5">
            <div class="flex flex-wrap gap-8" id='statistics' data-url='{{url('')}}'>
            </div>
            <div class="flex flex-col gap-2">
                <p class="flex w-full items-center justify-center text-lg">User Registration by Month</p>
                <div class="bg-input">
                    <x-chartjs-component :chart="$users" />
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <p class="flex w-full items-center justify-center text-lg">News Posts by Month</p>
                <div class="bg-input">
                    <x-chartjs-component :chart="$news_posts" />
                </div>
            </div>
        </div>
    </div>
</section>

@endsection