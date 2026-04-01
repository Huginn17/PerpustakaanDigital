<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | PerpustakaanDigital</title>
    @vite('resources/css/app.css')
    <link rel="icon" sizes="512x512" type="image/png" href="{{ asset('images/logobuku.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-500 to-indigo-600 min-h-screen font-[Poppins]">

<div class="flex items-center justify-center min-h-screen px-4">

    <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden">

        <!-- KIRI (ILUSTRASI) -->
        <div class="hidden lg:flex w-1/2 relative">
            <img src="{{ asset('images/perpustakaan.jpg') }}" 
                 class="absolute inset-0 w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-black/60"></div>

            <div class="relative z-10 flex flex-col justify-center items-center text-white p-8 text-center">
                <img src="{{ asset('images/logobuku.png') }}" class="w-16 mb-4">

                <h2 class="text-2xl font-semibold mb-3">Selamat Datang</h2>

                <p class="text-sm mb-6">
                    Jelajahi ribuan buku menarik dan tingkatkan wawasanmu bersama kami
                </p>

                <a href="{{ route('HalRegister') }}" 
                   class="px-8 py-3 border border-white rounded-full hover:bg-white hover:text-black transition">
                    Daftar Sekarang
                </a>
            </div>
        </div>

        <!-- KANAN (FORM) -->
        <div class="w-full lg:w-1/2 p-10">

            <h2 class="text-2xl font-bold text-gray-700 text-center mb-2">
                Login Akun
            </h2>

            <p class="text-center text-gray-400 mb-6 text-sm">
                Masukkan username dan password Anda
            </p>

            <!-- ALERT -->
            @if (session('error'))
            <div class="mb-4 bg-red-100 text-red-600 p-2 rounded text-sm text-center">
                {{ session('error') }}
            </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('loginproses') }}" method="POST" class="space-y-5">
                @csrf

                <!-- USERNAME -->
                <div class="relative">
                    <input type="text" name="username" placeholder="Username"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 outline-none">
                    
                    <i class="ph ph-user absolute right-3 top-3 text-gray-400"></i>
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 outline-none">
                    
                    <i class="ph ph-lock absolute right-3 top-3 text-gray-400"></i>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-3 rounded-lg font-medium shadow-md hover:bg-blue-600 hover:shadow-lg transition duration-300">
                    Masuk
                </button>

                <p class="text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('HalRegister') }}" class="text-blue-500 font-medium hover:underline">
                        Daftar
                    </a>
                </p>

            </form>
        </div>

    </div>

</div>

</body>

</html>
