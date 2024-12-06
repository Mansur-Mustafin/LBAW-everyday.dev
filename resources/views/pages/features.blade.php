@extends('layouts.app')

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
                    everyday.dev provides a platform where developers can share, discuss, and curate industry news, enhanced with AI-driven personalization.
                </p>
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
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">5. Responsive Design</h2>
                <p class="text-gray-400 mt-2">
                    Enjoy seamless navigation and functionality across desktops, tablets, and smartphones with our responsive platform design.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">6. Profile and Personalization</h2>
                <p class="text-gray-400 mt-2">
                    Authenticated users have profile pages to showcase their contributions and personalize their experience on the platform.
                </p>
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
                    Tags organize news items, with admins managing their creation and editing for optimal user experience.
                </p>
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
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">11. Comments and Votes</h2>
                <p class="text-gray-400 mt-2">
                    Engage with the community by commenting on or voting for news items, fostering meaningful discussions.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">12. Appeals for Blocked Users</h2>
                <p class="text-gray-400 mt-2">
                    Blocked users can appeal to regain access, ensuring fairness and transparency in moderation decisions.
                </p>
            </div>
        </div>
    </section>
</section>

@include('layouts.footer')

@endsection