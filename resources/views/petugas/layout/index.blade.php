<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Petugas Dashboard</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-orange-50/30"> <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
        aria-controls="default-sidebar" type="button"
        class="inline-flex items-center p-2 mt-3 ms-3 text-sm text-orange-600 rounded-lg sm:hidden hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-orange-200 transition-colors">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-xl"
        aria-label="Sidebar">
        <div class="h-full px-4 py-6 overflow-y-auto bg-white border-r border-orange-100 flex flex-col">

            <div class="flex items-center mb-10 px-2">
                <div class="p-2 bg-orange-500 rounded-xl shadow-lg shadow-orange-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <span class="ms-3 text-xl font-bold text-slate-800 tracking-tight">Admin<span
                        class="text-orange-500">Pustaka</span></span>
            </div>

            <ul class="space-y-2 font-medium flex-1">
                <li>
                    <a href="{{ route('petugasDashboard') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('petugasDashboard') ? 'bg-orange-50 text-orange-600 border border-orange-100' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('buku.index') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('buku.*') ? 'bg-orange-50 text-orange-600 border border-orange-100' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Manajemen Buku</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Pesan Masuk</span>
                        <span
                            class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-orange-500 rounded-full shadow-md shadow-orange-200">2</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.petugas') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <span class="ms-3 font-medium">Manajemen User</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('peminjaman.pengajuan') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="ms-3 font-medium">Daftar Peminjaman</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('laporan.index') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="ms-3 font-medium">Aktivitas Saya</span>
                    </a>
                </li>
            </ul>

            <div class="pt-4 mt-4 border-t border-orange-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center p-3 text-slate-500 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-red-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="ms-3 font-semibold">Log Out</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    
        <div class="p-4 sm:p-8">
            @yield('petugas')
        </div>
 

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>

</html>
