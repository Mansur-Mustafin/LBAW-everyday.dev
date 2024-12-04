@extends('layouts.app')

@include('partials.success-popup')

@section('content')
    <section
        class="flex flex-col tablet:flex-row laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">

        <main class="order-2 tablet:order-none flex-1 px-4">
            <h2 class="text-2xl font-semibold my-4">Notifications</h2>
            <div data-url="{{ route('notifications.get') }}" id="notifications-list"
                class="laptop:flex laptop:flex-col laptop:gap-2">
            </div>

            <div id="loading-icon" class="hidden my-6">
                <img class="w-12 h-12 mx-auto" src="{{ url('/assets/loading-icon.gif') }}" alt="Loading...">
            </div>
        </main>

        <aside class="order-1 tablet:order-none border-l border-gray-700 px-4">
            <h2 class="text-2xl font-semibold my-4">Notification Settings</h2>
            <div>
                <div class="toggleTwo mb-2" data-name="Vote Notification" data-initialvalue="false">
                    <input class="hidden hiddenToggle" type="text" name="vote" value='false'>
                </div>
                <div class="toggleTwo mb-2" data-name="Comment Notification" data-initialvalue="false">
                    <input class="hidden hiddenToggle" type="text" name="comment" value='false'>
                </div>
                <div class="toggleTwo mb-2" data-name="Following Post Notification" data-initialvalue="false">
                    <input class="hidden hiddenToggle" type="text" name="post" value='false'>
                </div>
                <div class="toggleTwo mb-2" data-name="Follow Notification" data-initialvalue="false">
                    <input class="hidden hiddenToggle" type="text" name="for_followers" value='false'>
                </div>
            </div>
        </aside>

    </section>
@endsection
