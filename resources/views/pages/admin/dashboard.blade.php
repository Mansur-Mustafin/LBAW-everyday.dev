@extends('layouts.body.admin')

@section('content')

@include('partials.success-popup')
<section>
    <div
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full laptop:p-5">
        <div class="mt-20 flex flex-col gap-5">
            <div class="flex w-full text-3xl">
                Dashboard
            </div>
            <div class="grid grid-cols-3 gap-2" id='statistics' data-url='{{url('')}}'>
            </div>
            <div class="flex flex-col gap-2">
                <p class="flex w-full items-center justify-center text-xl">User Registration by Month</p>
                <div class="bg-white">
                    <x-chartjs-component :chart="$users"/>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <p class="flex w-full items-center justify-center text-xl">News Posts by Month</p>
                <div class="bg-white">
                    <x-chartjs-component :chart="$news_posts" />
                </div>
            </div>
        </div>
    </div>
</section>

@endsection