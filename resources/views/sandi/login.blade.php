<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | PerpustakaanDigital</title>
    @vite('resources/css/app.css')
    <link rel="icon" sizes="512x512" type="image/png" href="{{ asset('images/logobuku.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fffaf5; /* Creamy white */
        }
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #fb923c 0%, #facc15 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.3;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="blob -top-20 -left-20"></div>
    <div class="blob -bottom-20 -right-20" style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); opacity: 0.1;"></div>

    <div class="w-full max-w-5xl flex flex-col lg:flex-row glass rounded-[2.5rem] shadow-2xl overflow-hidden border border-white">

        <div class="hidden lg:flex w-[45%] relative bg-orange-500 overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            
            <div class="relative z-10 p-12 flex flex-col justify-between w-full">
                <div class="flex items-center gap-2">
                    <div class="bg-white p-2 rounded-xl shadow-lg">
                        <img src="{{ asset('images/logobuku.png') }}" class="w-8">
                    </div>
                    <span class="text-white font-extrabold tracking-tight text-xl uppercase">E-Library</span>
                </div>

                <div class="text-white">
                    <h1 class="text-4xl font-black leading-tight mb-4">
                        Temukan Dunia <br> Dalam Genggaman.
                    </h1>
                    <p class="text-orange-100 text-sm mb-8 leading-relaxed">
                        Akses ribuan buku digital, jurnal, dan literatur terbaik untuk mendukung perjalanan intelektual Anda.
                    </p>
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-orange-500 shadow-lg" src="https://i.pravatar.cc/100?u=1" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-orange-500 shadow-lg" src="https://i.pravatar.cc/100?u=2" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-orange-500 shadow-lg" src="https://i.pravatar.cc/100?u=3" alt="">
                        <div class="w-10 h-10 rounded-full border-2 border-orange-500 shadow-lg bg-orange-400 flex items-center justify-center text-[10px] font-bold text-white uppercase">
                            +1k
                        </div>
                    </div>
                    <p class="text-[10px] text-orange-200 mt-3 font-bold uppercase tracking-widest">Bergabung dengan pembaca lainnya</p>
                </div>

                <div class="text-orange-200 text-xs font-medium">
                    © 2026 Perpustakaan Digital. All rights reserved.
                </div>
            </div>

            <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-orange-400 rounded-full opacity-50 shadow-inner"></div>
        </div>

        <div class="w-full lg:w-[55%] p-8 lg:p-16 flex flex-col justify-center bg-white/40">
            <div class="max-w-md mx-auto w-full">
                
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-gray-800">Selamat Datang</h2>
                    <p class="text-gray-500 font-medium mt-2 text-sm italic">Masuk untuk melanjutkan petualangan literasimu.</p>
                </div>

                @if (session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl flex items-center gap-3">
                    <i class="ph-bold ph-warning-circle text-red-500 text-xl"></i>
                    <p class="text-red-700 text-xs font-bold uppercase tracking-wide">{{ session('error') }}</p>
                </div>
                @endif

                <form action="{{ route('loginproses') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Username / Email</label>
                        <div class="relative mt-1 group">
                            <input type="text" name="login" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl px-5 py-4 focus:border-orange-500 focus:ring-0 outline-none transition-all duration-300 group-hover:border-gray-200"
                                placeholder="nama@email.com">
                            <i class="ph ph-user absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Password</label>
                        <div class="relative mt-1 group">
                            <input type="password" name="password" required
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl px-5 py-4 focus:border-orange-500 focus:ring-0 outline-none transition-all duration-300 group-hover:border-gray-200"
                                placeholder="••••••••">
                            <i class="ph ph-lock-simple absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="#" class="text-[11px] font-bold text-orange-600 hover:text-orange-700 uppercase tracking-wider">Lupa Password?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-orange-500 to-amber-500 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-orange-200 hover:shadow-orange-300 hover:-translate-y-1 active:scale-95 transition-all duration-300">
                        Masuk Sekarang
                    </button>

                    <div class="pt-8 text-center">
                        <p class="text-sm text-gray-500 font-medium">
                            Baru di sini? 
                            <a href="{{ route('HalRegister') }}" class="text-orange-600 font-black border-b-2 border-orange-100 hover:border-orange-500 transition-all">
                                Buat Akun Gratis
                            </a>
                        </p>
                    </div>
                </form>

            </div>
        </div>

    </div>

</body>
</html>