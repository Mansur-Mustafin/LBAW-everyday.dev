@extends('layouts.body.default')

@section('content')

<section class="flex w-full h-full laptop:m-auto laptop:max-w-[64rem]">
    <section class="flex flex-col w-full laptop:w-[45rem] px-10 py-12 border-x border-gray-700">
        <h1 class="text-2xl font-bold">Our Main Features</h1>
        <p class="mt-4 text-gray-400 leading-relaxed">
            Discover the key features of everyday.dev, designed to empower developers and tech enthusiasts by offering a seamless, community-driven experience.
        </p>
        
        <div class="mt-8 space-y-6">
            <div>
                <h2 class="text-xl font-semibold text-purple-700">1. Community-Driven News Feed</h2>
                <p class="text-gray-400 mt-2">
                    Everyday.dev provides a platform where developers can share, discuss, and curate industry news.
                </p>
                <img src="{{ asset('assets/community.jpg') }}" alt="Community-Driven News Feed" class="mt-4 rounded-md shadow-md">
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">2. User Roles and Permissions</h2>
                <p class="text-gray-400 mt-2">
                    The platform supports Visitors, Authenticated Users, and Administrators, each with unique access and capabilities tailored to their roles.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">3. Reputation System</h2>
                <p class="text-gray-400 mt-2">
                    Build your reputation based on the quality of your posts and community engagement, encouraging meaningful contributions.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">4. Advanced Search and Filtering</h2>
                <p class="text-gray-400 mt-2">
                    Use full-text and exact search to find relevant news, and filter results based on your interests for a tailored experience.
                </p>
                <img src="{{ asset('assets/search.jpg') }}" alt="Advanced Search and Filtering" class="mt-4 rounded-md shadow-md w-full">
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">5. Responsive Design</h2>
                <p class="text-gray-400 mt-2">
                    Enjoy seamless navigation and functionality across desktops, tablets, and smartphones with our responsive platform design.
                </p>
                <img src="{{ asset('assets/responsive.jpg') }}" alt="Responsive Designn" class="mt-4 rounded-md shadow-md">
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">6. Profile and Personalization</h2>
                <p class="text-gray-400 mt-2">
                    Authenticated users have profile pages to showcase their contributions and personalize their experience on the platform.
                </p>
                <img src="{{ asset('assets/profileImages.png') }}" alt="Profile and Personalization" class="mt-4 rounded-md shadow-md">
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">7. Moderation and Appeals</h2>
                <p class="text-gray-400 mt-2">
                    Administrators can block users for misconduct, while blocked users can submit appeals for review, ensuring a fair and respectful community.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">8. Tag Management</h2>
                <p class="text-gray-400 mt-2">
                    Tags organize news items, with admins managing their creation, editing, and deletion to ensure an optimal user experience. Authenticated users can follow tags and/or propose new ones, fostering community engagement and content curation.
                </p>
                <img src="{{ asset('assets/tag.jpg') }}" alt="Tag" class="mt-4 rounded-md shadow-md w-full">
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">9. Dashboard for Insights</h2>
                <p class="text-gray-400 mt-2">
                    Administrators have access to a dashboard filled with useful statistics, graphics, and insights into platform activity.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">10. OAuth Integration</h2>
                <p class="text-gray-400 mt-2">
                    Seamlessly log in or register using OAuth for quick and secure access to the platform.
                </p>
                <img src="{{ asset('assets/Oauth.svg') }}" alt="Oauth" class="mt-4 rounded-md shadow-md w-2/3">
            </div>

            <div>
                <h2 cclass="text-xl font-semibold text-purple-700">11. News Items</h2>
                <p class="text-gray-400 mt-2">
                    A news item is a user-submitted update in the tech world, featuring details like the author, publication date, comments, and votes, encouraging community engagement.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">12. Comments and Votes</h2>
                <p class="text-gray-400 mt-2">
                    Engage with the community by commenting on or voting for news items, fostering meaningful discussions.
                </p>
                <img src="{{ asset('assets/comment.jpg') }}" alt="Comments" class="mt-4 rounded-md shadow-md">
            </div>

            <div>
                <h2 cclass="text-xl font-semibold text-purple-700">13. Blocked User</h2>
                <p class="text-gray-400 mt-2">
                    Blocked Users are users which have their account blocked. They can't access their personal information, and have to appeal for their account to be unblocked.
                </p>
            </div>
        </div>
    </section>
</section>

@include('layouts.footer')

@endsection