@extends('layouts.body.default')

@section('content')

<section
    class="flex flex-col laptop:border-x laptop:border-gray-700 self-center w-full laptop:m-auto laptop:max-w-[50.5rem] h-full">
    <section class="flex flex-col w-full laptop:w-[50.5rem] px-10 py-12 border-x border-gray-700">
        <div class="">
        
            <main class="container mx-auto px-4">
                <section class="mb-12">
                    <h2 class="text-4xl font-bold  mb-4">Main Features</h2>
                    <p class="text-lg ">Discover the features that make everyday.dev your ultimate hub for tech collaboration.</p>
                </section>
        
                <section class="space-y-12">
                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">1. Precision and Power in Search</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li><span class="font-bold">Exact Match & Full-Text Search:</span> Find what you need with unparalleled accuracy.</li>
                            <li><span class="font-bold">Filter Like a Pro:</span> Refine your search with attributes like tags,and authors.</li>
                        </ul>
                    </div>
        
                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">2. Stay Updated, Stay Engaged</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li><span class="font-bold">Top p-6 Recent News Feeds:</span> Catch the most relevant or recent stories.</li>
                            <li><span class="font-bold">Interactive Comments:</span> Share your insights or learn from others in engaging discussions.</li>
                        </ul>
                    </div>
        
                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">3. Moderation and Safety First</h3>
                        <ul class="list-disc list-inside space-y-2">
{{--                             <li><span class="font-bold">Report Inappropriate Content:</span> Help maintain a respectful platform.</li> --}}
                            <li><span class="font-bold">Content Moderation:</span> Our administrators actively review and omit inappropriate content, ensuring you only see safe, high-quality posts.</li>
                            <li><span class="font-bold">Appeal for Unblocks:</span> Ensuring fairness in moderation.</li>
                        </ul>
                    </div>

                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">4. Join the Conversation</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li><span class="font-bold">Create and Share News:</span> Publish stories and contribute to the community.</li>
                            <li><span class="font-bold">Vote and Comment:</span> Express your opinions and engage with content.</li>
                        </ul>
                    </div>
        
                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">5. Your Profile, Your Identity</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li><span class="font-bold">Customizable Profiles:</span> Showcase your interests with a personalized profile.</li>
                            <li><span class="font-bold">Bookmarking:</span> Save news items for future reading.</li>
                        </ul>
                    </div>
        
                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">6. For Developers, By Developers</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li><span class="font-bold">Rich Text Support:</span> Structure your posts elegantly and professionally.</li>
                            <li><span class="font-bold">Follow Users and Tags:</span> Build a network that resonates with your interests.</li>
                        </ul>
                    </div>
        
                    <div class=" shadow-md rounded-lg tablet:p-6">
                        <h3 class="text-2xl font-semibold text-purple-500 mb-3">7. Seamless Account Management</h3>
                        <ul class="list-disc list-inside space-y-2">
                            <li><span class="font-bold">Login, Registration, and Recovery:</span> Quick and secure account access.</li>
                            <li><span class="font-bold">Profile Editing:</span> Update your personal information effortlessly.</li>
                        </ul>
                    </div>
        
                </section>
            </main>
{{--             <div>
                <h2 class="text-xl font-semibold text-purple-700">1. Community-Driven News Feed</h2>
                <p class="text-gray-400 mt-2">
                    everyday.dev provides a platform where developers can share, discuss, and curate industry news.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">2. User Roles and Permissions*</h2>
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
                <h2 class="text-xl font-semibold text-purple-700">4. Advanced Search and Filtering*</h2>
                <p class="text-gray-400 mt-2">
                    Use full-text and exact search to find relevant news, and filter results based on your interests for a tailored experience.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">5. Responsive Design*</h2>
                <p class="text-gray-400 mt-2">
                    Enjoy seamless navigation and functionality across desktops, tablets, and smartphones with our responsive platform design.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">6. Profile and Personalization*</h2>
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
                    Tags organize news items, with admins managing their creation, editing, and deletion to ensure an optimal user experience. Authenticated users can follow tags and/or propose new ones, fostering community engagement and content curation.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">10. Google OAuth Integration</h2>
                <p class="text-gray-400 mt-2">
                    Seamlessly log in or register using Google OAuth for quick and secure access to the platform.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">11. News Items</h2>
                <p class="text-gray-400 mt-2">
                    A news item is a user-submitted update in the tech world, featuring details like the author, publication date, comments, and votes, encouraging community engagement.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">12. Comments and Votes</h2>
                <p class="text-gray-400 mt-2">
                    Engage with the community by commenting on or voting for news items, fostering meaningful discussions.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-purple-700">13. Blocked User</h2>
                <p class="text-gray-400 mt-2">
                    Blocked Users are users which have their account blocked. They can't access their personal information, and have to appeal for their account to be unblocked.
                </p>
            </div> --}}
        </div>
    </section>
</section>

@include('layouts.footer')

@endsection