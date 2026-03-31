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

<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">

       
        <section class="relative lg:h-auto md:w-2/4 w-full hidden lg:block">

            <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Background"
                class="absolute inset-0 w-full h-full object-cover">

            
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Konten -->
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">

                <!-- Logo -->
                <div class="absolute top-6 left-6 flex items-center">
                    <img src="{{ asset('images/logobuku.png') }}" alt="Logo" class="h-12 w-12">
                    <span class="font-semibold mb-1">perpus</span>
                </div>

                <!-- Text -->
                <p class="text-sm mb-10">untuk tetap terhubung dengan kami, silakan<br> masuk dengan informasi pribadi
                    Anda</p>

                <!-- Button -->
                <a href="{{ route('HalRegister') }}"
                    class="px-20 py-4 border border-white rounded-full hover:bg-white hover:text-black transition">
                    DAFTAR
                </a>
            </div>
        </section>



        <!-- Kanan -->
        <div class="flex w-full lg:w-4/5 bg-white items-start justify-center min-h-screen py-10">

            <div class="w-full max-w-md p-8 min-h-screen flex flex-col justify-start">

                <div class="w-full flex flex-col">

                    <!-- Judul -->
                    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Masuk & Temukan Buku Favorit Anda</h2>

                    <p class="text-center text-gray-500 mb-6 text-sm">
                        gunakan email Anda untuk pendaftaran
                    </p>

                    <!-- Alert -->
                    @if (session('success'))
                        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Form Login -->
                    <form action="{{ route('loginproses') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                            <input type="text" id="username" name="username" placeholder="Nama Pengguna"
                                class="mt-2 block w-full border border-gray-700 rounded-lg p-2.5 focus:ring-orange-500 focus:border-orange-500" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Kata Sandi"
                                class="mt-2 block w-full border border-gray-700 rounded-lg p-2.5 focus:ring-orange-500 focus:border-orange-500" />
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="w-52 h-14 bg-blue-500 text-white py-2.5 rounded-full font-normal text-md hover:bg-orange-600 transition duration-300 hover:scale-95">
                                MASUK
                            </button>
                        </div>

                        <p class="text-center text-sm mt-4">
                            Tidak Memiliki Akun?
                            <a href="register" class="text-blue-500 font-medium">
                                Daftar Sekarang
                            </a>
                        </p>

                    </form>
                </div>

            </div>

        </div>
    </div>
</body>

</html>
