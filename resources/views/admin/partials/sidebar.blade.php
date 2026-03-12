<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="./images/logo/logo.svg" alt="Logo" />
                <img class="hidden dark:block" src="./images/logo/logo-dark.svg" alt="Logo" />
            </span>
            <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'" src="./images/logo/logo-icon.svg"
                alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav x-data="{ selected: $persist('Dashboard') }">

            <!-- ===================== -->
            <!-- MENU GROUP -->
            <!-- ===================== -->
            <div class="mb-6">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Menu
                    </span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a href="index.html" class="menu-item group"
                            :class="page === 'dashboard' ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="page === 'dashboard' ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                    fill="" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->
                </ul>
            </div>

            <!-- ===================== -->
            <!-- MASTER DATA GROUP -->
            <!-- ===================== -->
            <div class="mb-6">
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Master Data
                    </span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4">

                    <!-- Menu Item Users -->
                    <li>
                        <a href="users.html" class="menu-item group"
                            :class="page === 'users' ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="page === 'users' ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 3.25C9.92893 3.25 8.25 4.92893 8.25 7C8.25 9.07107 9.92893 10.75 12 10.75C14.0711 10.75 15.75 9.07107 15.75 7C15.75 4.92893 14.0711 3.25 12 3.25ZM9.75 7C9.75 5.75736 10.7574 4.75 12 4.75C13.2426 4.75 14.25 5.75736 14.25 7C14.25 8.24264 13.2426 9.25 12 9.25C10.7574 9.25 9.75 8.24264 9.75 7ZM12 12.25C8.96243 12.25 6.25 14.5 6.25 17.75C6.25 18.1642 6.58579 18.5 7 18.5H17C17.4142 18.5 17.75 18.1642 17.75 17.75C17.75 14.5 15.0376 12.25 12 12.25ZM7.78958 17C8.09645 14.9357 9.88236 13.75 12 13.75C14.1176 13.75 15.9036 14.9357 16.2104 17H7.78958Z"
                                    fill="" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M17.5 3.25C16.2574 3.25 15.25 4.25736 15.25 5.5C15.25 6.74264 16.2574 7.75 17.5 7.75C18.7426 7.75 19.75 6.74264 19.75 5.5C19.75 4.25736 18.7426 3.25 17.5 3.25ZM16.75 5.5C16.75 5.08579 17.0858 4.75 17.5 4.75C17.9142 4.75 18.25 5.08579 18.25 5.5C18.25 5.91421 17.9142 6.25 17.5 6.25C17.0858 6.25 16.75 5.91421 16.75 5.5ZM19 9.25C18.0748 9.25 17.2553 9.6517 16.6939 10.2908C17.3541 10.5942 17.9484 11.0283 18.4469 11.5604C18.6236 11.5205 18.8093 11.5 19 11.5C20.3765 11.5 21.5 12.405 21.5 13.75H20.75C20.3358 13.75 20 14.0858 20 14.5C20 14.9142 20.3358 15.25 20.75 15.25H22.25C22.6642 15.25 23 14.9142 23 14.5C23 11.6863 21.2091 9.25 19 9.25Z"
                                    fill="" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Users
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Users -->

                    <!-- Menu Item Categories -->
                    <li>
                        <a href="categories.html" class="menu-item group"
                            :class="page === 'categories' ? 'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="page === 'categories' ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.25 5C2.25 3.48122 3.48122 2.25 5 2.25H9C10.5188 2.25 11.75 3.48122 11.75 5V9C11.75 10.5188 10.5188 11.75 9 11.75H5C3.48122 11.75 2.25 10.5188 2.25 9V5ZM5 3.75C4.30964 3.75 3.75 4.30964 3.75 5V9C3.75 9.69036 4.30964 10.25 5 10.25H9C9.69036 10.25 10.25 9.69036 10.25 9V5C10.25 4.30964 9.69036 3.75 9 3.75H5ZM13.25 5.5C13.25 3.70507 14.7051 2.25 16.5 2.25C18.2949 2.25 19.75 3.70507 19.75 5.5C19.75 7.29493 18.2949 8.75 16.5 8.75C14.7051 8.75 13.25 7.29493 13.25 5.5ZM16.5 3.75C15.5335 3.75 14.75 4.5335 14.75 5.5C14.75 6.4665 15.5335 7.25 16.5 7.25C17.4665 7.25 18.25 6.4665 18.25 5.5C18.25 4.5335 17.4665 3.75 16.5 3.75ZM2.25 15C2.25 13.4812 3.48122 12.25 5 12.25H9C10.5188 12.25 11.75 13.4812 11.75 15V19C11.75 20.5188 10.5188 21.75 9 21.75H5C3.48122 21.75 2.25 20.5188 2.25 19V15ZM5 13.75C4.30964 13.75 3.75 14.3096 3.75 15V19C3.75 19.6904 4.30964 20.25 5 20.25H9C9.69036 20.25 10.25 19.6904 10.25 19V15C10.25 14.3096 9.69036 13.75 9 13.75H5ZM16.5 12.25C14.7051 12.25 13.25 13.7051 13.25 15.5C13.25 17.2949 14.7051 18.75 16.5 18.75C18.2949 18.75 19.75 17.2949 19.75 15.5C19.75 13.7051 18.2949 12.25 16.5 12.25ZM14.75 15.5C14.75 14.5335 15.5335 13.75 16.5 13.75C17.4665 13.75 18.25 14.5335 18.25 15.5C18.25 16.4665 17.4665 17.25 16.5 17.25C15.5335 17.25 14.75 16.4665 14.75 15.5Z"
                                    fill="" />
                            </svg>
                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Categories
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Categories -->

                </ul>
            </div>
            <!-- MASTER DATA GROUP -->

        </nav>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-800 py-5">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
        </form>

        <button onclick="confirmLogout()"
            class="menu-item group w-full menu-item-inactive transition-colors duration-200">
            <svg class="fill-current"
                width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.25 8C15.25 7.58579 15.5858 7.25 16 7.25H19C20.2426 7.25 21.25 8.25736 21.25 9.5V14.5C21.25 15.7426 20.2426 16.75 19 16.75H16C15.5858 16.75 15.25 16.4142 15.25 16C15.25 15.5858 15.5858 15.25 16 15.25H19C19.4142 15.25 19.75 14.9142 19.75 14.5V9.5C19.75 9.08579 19.4142 8.75 19 8.75H16C15.5858 8.75 15.25 8.41421 15.25 8Z"
                    fill="" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9.46967 7.46967C9.76256 7.17678 10.2374 7.17678 10.5303 7.46967L14.5303 11.4697C14.8232 11.7626 14.8232 12.2374 14.5303 12.5303L10.5303 16.5303C10.2374 16.8232 9.76256 16.8232 9.46967 16.5303C9.17678 16.2374 9.17678 15.7626 9.46967 15.4697L12.9393 12L9.46967 8.53033C9.17678 8.23744 9.17678 7.76256 9.46967 7.46967Z"
                    fill="" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M2.75 12C2.75 11.5858 3.08579 11.25 3.5 11.25H13.5C13.9142 11.25 14.25 11.5858 14.25 12C14.25 12.4142 13.9142 12.75 13.5 12.75H3.5C3.08579 12.75 2.75 12.4142 2.75 12Z"
                    fill="" />
            </svg>
            <span class="menu-item-text font-medium" :class="sidebarToggle ? 'lg:hidden' : ''">
                Logout
            </span>
        </button>
    </div>
</aside>

@push('scripts')
    <script>
        function confirmLogout() {
            // Blur konten halaman saat alert muncul
            document.querySelector('.flex.h-screen').style.filter = 'blur(4px)';

            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Kamu akan keluar dari sesi admin.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                backdrop: 'rgba(0,0,0,0.15)',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-lg px-5 py-2 text-sm font-medium',
                    cancelButton: 'rounded-lg px-5 py-2 text-sm font-medium',
                }
            }).then((result) => {
                // Hapus blur setelah alert ditutup
                document.querySelector('.flex.h-screen').style.filter = '';

                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
