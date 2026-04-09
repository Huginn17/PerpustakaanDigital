<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Kepala Perpus | Panel</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="sm:hidden flex items-center justify-between p-4 bg-white border-b border-orange-100 sticky top-0 z-50">
        <span class="font-bold text-orange-600">Perpus<span class="text-slate-800">Admin</span></span>
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
            aria-controls="default-sidebar" type="button"
            class="p-2 text-orange-600 rounded-lg hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h14m-14 6h10" />
            </svg>
        </button>
    </div>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-sm"
        aria-label="Sidebar">
        <div class="h-full px-4 py-6 overflow-y-auto bg-white border-r border-orange-50 flex flex-col">

            <div class="flex items-center mb-10 px-2">
                <div
                    class="p-2.5 bg-gradient-to-br from-orange-500 to-orange-400 rounded-xl shadow-lg shadow-orange-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                    </svg>
                </div>
                <div class="ms-3 flex flex-col">
                    <span class="text-lg font-bold text-slate-800 leading-tight tracking-tight">Kepala</span>
                    <span class="text-xs font-medium text-orange-500 uppercase tracking-widest">Perpustakaan</span>
                </div>
            </div>

            <ul class="space-y-1.5 flex-1">
                <li>
                    <a href="{{ route('kepalaDashboard') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('kepalaDashboard') ? 'bg-orange-50 text-orange-600 font-semibold border border-orange-100' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="ms-3">Dashboard Overview</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kepala.buku.index') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('kepala.buku.*') ? 'bg-orange-50 text-orange-600 font-semibold border border-orange-100' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <span class="flex-1 ms-3">Katalog Buku</span>
                        <span
                            class="px-2 py-0.5 text-[10px] font-bold text-white bg-orange-500 rounded-md shadow-sm">PRO</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kepala.pengguna.index') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span class="flex-1 ms-3">Data Pengguna</span>
                        <span
                            class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">2</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.kepala') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="ms-3">Akun Saya</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('setting.index') }}"
                        class="flex items-center p-3 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-orange-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="ms-3">Pengaturan Sistem</span>
                    </a>
                </li>
            </ul>

            <div class="pt-4 mt-4 border-t border-orange-50">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center p-3 text-red-500 font-semibold rounded-xl hover:bg-red-50 transition-all duration-200 group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="ms-3">Keluar Aplikasi</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    
        <div class="p-6 sm:p-10">
            @yield('kepala_content')
        </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
