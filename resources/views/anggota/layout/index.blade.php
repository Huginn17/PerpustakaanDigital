<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Dashboard</title>
</head>
    
<body class="bg-gray-50">

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-orange-500 rounded-lg sm:hidden hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-orange-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-4 py-6 overflow-y-auto bg-white border-r border-orange-100 shadow-sm">
            
            <div class="flex items-center ps-2.5 mb-10">
                <div class="bg-orange-500 p-2 rounded-xl mr-3 shadow-lg shadow-orange-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="self-center text-xl font-bold whitespace-nowrap text-slate-800 tracking-tight">Pustaka<span class="text-orange-500">Orange.</span></span>
            </div>

            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('anggota.dashboard') ? 'bg-orange-50 text-orange-600' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('anggota.buku ') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Daftar Buku</span>
                        <span class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-semibold text-orange-800 bg-orange-200 rounded-full">New</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('peminjaman.ajukan.page') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                        <span class="inline-flex items-center justify-center w-5 h-5 ms-3 text-xs font-bold text-white bg-orange-500 rounded-full shadow-md">3</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.anggota') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Profile Saya</span>
                    </a>
                </li>

                <li class="pt-4 mt-4 border-t border-orange-50"></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                            class="w-full flex items-center p-3 text-red-500 rounded-xl hover:bg-red-50 transition-all duration-200 group text-left">
                            <svg class="w-5 h-5 transition duration-75 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="ms-3 font-semibold">Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>

            <div id="dropdown-cta" class="p-4 mt-12 rounded-2xl bg-orange-50 border border-orange-100" role="alert">
                <p class="mb-3 text-sm text-orange-800 font-medium">
                    Butuh bantuan akses perpustakaan?
                </p>
                <a class="text-xs text-orange-600 font-bold hover:underline" href="#">Hubungi Admin &rarr;</a>
            </div>
        </div>
    </aside>

        @yield('anggota')   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>