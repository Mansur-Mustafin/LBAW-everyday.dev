@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">User Profile</h1>
        <div class="text-black grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Name</h2>
                <p>{{ $user->username }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Public name</h2>
                <p>{{ $user->public_name }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Email</h2>
                <p>{{ $user->email }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Registration date</h2>
                <p>{{ $user->created_at->format('d.m.Y') }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Rank</h2>
                <p>{{ $user->rank }}</p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold">Reputation</h2>
                <p>{{ $user->reputation }}</p>
            </div>
        </div>
    </div>
@endsection