@extends('layouts.app')

@include('partials.success-popup')

@section('content')
    <section
        class="flex flex-col tablet:flex-row laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">

        <main class="order-2 tablet:order-none flex-1">
            <h2 class="text-2xl font-semibold my-4 px-4">Notifications</h2>
            <div data-url="{{ route('notifications.get') }}" id="notifications-list" class="flex flex-col">

                

            </div>
            <div id="loading-icon" class="hidden my-6">
                <img class="w-12 h-12 mx-auto" src="{{ url('/assets/loading-icon.gif') }}" alt="Loading...">
            </div>
        </main>

        <aside class="order-1 tablet:order-none border-l border-gray-700 px-4">
            <h2 class="text-2xl font-semibold my-4">Notification Settings</h2>
            <div id="notification-settings">
                <div class="toggleTwo mb-2" data-name="Vote Notification"
                    data-initialvalue="{{ $settings->vote_notifications ? 'true' : 'false' }}">
                    <input class="hidden hiddenToggle" type="text" name="vote" value=''>
                </div>
                <div class="toggleTwo mb-2" data-name="Comment Notification"
                    data-initialvalue="{{ $settings->comment_notifications ? 'true' : 'false' }}">
                    <input class="hidden hiddenToggle" type="text" name="comment" value=''>
                </div>
                <div class="toggleTwo mb-2" data-name="New Post Notification"
                    data-initialvalue="{{ $settings->post_notifications ? 'true' : 'false' }}">
                    <input class="hidden hiddenToggle" type="text" name="post" value=''>
                </div>
                <div class="toggleTwo mb-2" data-name="Follow Notification"
                    data-initialvalue="{{ $settings->follow_notifications ? 'true' : 'false' }}">
                    <input class="hidden hiddenToggle" type="text" name="follow" value=''>
                </div>
                <div id="notification-settings-buttons" class="hidden mt-8">
                    <a href="#" id="save-notification-button"
                        class="px-2.5 py-1.5 rounded-lg bg-purple-950 text-gray-300 hover:text-white hover:bg-purple-600 hover:shadow-2xl hover:shadow-purple-400">Save</a>
                    <a href="#" id="cancel-notification-button"
                        class="px-2.5 py-1.5 rounded-lg  text-gray-400 hover:text-white">Cancel</a>
                </div>
            </div>
        </aside>

    </section>
@endsection
