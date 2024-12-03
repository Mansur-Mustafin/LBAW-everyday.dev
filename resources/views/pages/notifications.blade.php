@extends('layouts.app')

@include('partials.success-popup')

@section('content')
<div class="container mx-auto flex flex-col gap-2 mt-4 laptop:m-auto laptop:max-w-[42.5rem]">
    <p>Todo isso eu vou mover para um modal, para nao ir a outra pagina.</p>
    <h1 class="text-2xl font-semibold my-4">Notifications</h1>
    <div data-url="{{ route('notifications.get') }}" id="notifications-list"
        class="laptop:flex laptop:flex-col laptop:gap-2">
    </div>

    <div id="loading-icon" class="hidden my-6">
        <img class="w-12 h-12 mx-auto" src="{{ url('/assets/loading-icon.gif') }}" alt="Loading...">
    </div>
</div>
@endsection