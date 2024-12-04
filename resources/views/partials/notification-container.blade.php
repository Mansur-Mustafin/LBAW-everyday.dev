<div id="notification-container" class="fixed top-10 right-4 z-50 flex flex-col gap-2">
    <style>
        /* Slide In from Right */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Slide Out to Right */
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Animation Classes */
        .animate-slide-in {
            animation: slideInRight 0.5s forwards;
        }

        .animate-slide-out {
            animation: slideOutRight 0.5s forwards;
        }
    </style>


    {{-- <div class="w-full max-w-xs p-4 text-white bg-black rounded-xl shadow">
        <div class="flex">
            <img class="w-8 h-8 rounded-full"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                alt="Profile Image" />
            <div class="ms-3 text-sm">
                <span class="mb-1 font-semibold text-gray-900 dark:text-white">Emilia Gates</span>
                <div class="mb-3">Hi Neil, thanks for sharing your thoughts regarding Flowbite.</div>
                <a href="#"
                    class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-white text-black  hover:bg-purple-950 hover:text-white">Open</a>
            </div>
            <button type="button" 
                class="ms-auto -mx-1.5 -my-1.5 justify-center items-center flex-shrink-0 rounded-lg p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div> --}}

</div>
