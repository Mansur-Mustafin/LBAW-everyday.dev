<div id="notification-container" class="fixed top-10 right-4 z-50 flex flex-col gap-2">
    <style>
        /* TODO: por nalgum lugar */
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

        .animate-slide-in {
            animation: slideInRight 0.5s forwards;
        }

        .animate-slide-out {
            animation: slideOutRight 0.5s forwards;
        }
    </style>
</div>
