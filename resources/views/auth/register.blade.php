<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-pattern {
            background-color: #6366f1;
            background-image: radial-gradient(at 0% 0%, hsla(253, 16%, 7%, 1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(225, 39%, 30%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(339, 49%, 30%, 1) 0, transparent 50%);
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-0 md:p-6">

    <div
        class="flex flex-col md:flex-row w-full max-w-6xl min-h-[90vh] bg-white md:rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">

        <div class="flex w-full md:w-1/2 lg:w-2/5 bg-white items-center justify-center px-8 sm:px-12 py-12">
            <div class="w-full max-w-sm">

                <div class="flex items-center gap-3 mb-10">
                    <div class="bg-indigo-600 p-2 rounded-xl shadow-lg shadow-indigo-200">
                        <img src="{{ asset('images/logobuku.png') }}" alt="Logo"
                            class="h-8 w-8 brightness-0 invert">
                    </div>
                    <span class="font-extrabold text-2xl tracking-tighter text-slate-800 italic">PERPUS<span
                            class="text-indigo-600">.</span></span>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 leading-tight">Buat Akun Baru</h2>
                    <p class="text-slate-500 mt-2">Daftar sekarang untuk mulai meminjam buku favoritmu.</p>
                </div>

                <div class="flex p-1 bg-slate-100 rounded-2xl mb-8 w-fit">
                    <div
                        class="bg-white px-6 py-2 rounded-xl text-sm font-bold text-indigo-600 shadow-sm border border-slate-200 flex items-center gap-2">
                        <i class="ph-bold ph-user"></i> Anggota
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-100 text-rose-600 p-4 rounded-2xl mb-6 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('registerproses') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama
                            Pengguna</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="ph ph-user-circle-plus text-xl"></i>
                            </span>
                            <input type="text" name="username" placeholder="Masukan username"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-300">
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">E-mail</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="ph ph-envelope-simple text-xl"></i>
                            </span>
                            <input type="email" name="email" placeholder="nama@email.com"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Kata
                            Sandi</label>
                        <div class="relative group">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="ph ph-lock-key text-xl"></i>
                            </span>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-300">
                        </div>
                    </div>

                    <input type="hidden" name="role" value="anggota">

                    <button type="submit"
                        class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                        Daftar Akun <i class="ph-bold ph-arrow-right"></i>
                    </button>
                </form>

                <p class="text-center mt-8 text-slate-500 text-sm md:hidden">
                    Sudah punya akun? <a href="{{ route('HalLogin') }}"
                        class="text-indigo-600 font-bold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>

        <section
            class="relative hidden md:flex md:w-1/2 lg:w-3/5 bg-pattern items-center justify-center p-12 overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-500/20 rounded-full -ml-20 -mb-20 blur-3xl"></div>

            <div class="relative z-10 w-full max-w-lg text-center">
                <div class="mb-8 flex justify-center">
                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-[2rem] flex items-center justify-center shadow-2xl border border-white/30 animate-bounce">
                        <i class="ph-fill ph-books text-5xl text-white"></i>
                    </div>
                </div>

                <h2 class="text-4xl lg:text-5xl font-extrabold text-white mb-6 leading-tight">Jendela Dunia di Genggaman
                    Anda.</h2>
                <p class="text-indigo-100 text-lg mb-10 leading-relaxed opacity-90">
                    Bergabunglah dengan ribuan pembaca lainnya dan nikmati akses literasi tanpa batas.
                </p>

                <div class="inline-block p-1 bg-white/10 backdrop-blur-lg border border-white/20 rounded-[2rem]">
                    <div class="flex items-center gap-4 px-6 py-4">
                        <p class="text-white font-medium">Sudah punya akun?</p>
                        <a href="{{ route('HalLogin') }}"
                            class="px-8 py-2.5 bg-white text-indigo-900 rounded-full font-bold hover:bg-indigo-50 transition-all shadow-lg">
                            MASUK
                        </a>
                    </div>
                </div>
            </div>

            <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Background"
                class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay">
        </section>
    </div>

    {{-- =============== MODAL PELAMAR =============== --}}
    {{-- <div id="successModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
                <div class="relative bg-white rounded-2xl shadow-lg w-[90%] max-w-md p-8 text-center">
                    <button onclick="closeModal()"
                        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
                    <h2 class="text-2xl font-bold mb-3">Selamat!</h2>
                    <h2 class="text-xl font-semibold mb-3">Akun anda berhasil dibuat</h2>
                    <p class="text-gray-700 mb-8">Silakan login untuk melanjutkan ke areakerja.</p>
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('images/orang.png') }}" alt="Ilustrasi" class="w-30 h-28">
                    </div>
                    <div class="flex justify-center gap-6">
                        <button id="goLogin"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">Masuk</button>
                    </div>
                </div>
            </div> --}}


    {{-- <script>
            document.getElementById("registerForm").addEventListener("submit", async function(e) {
                e.preventDefault();

                document.querySelectorAll("#registerForm .error-message").forEach(el => el.textContent = "");

                let formData = new FormData(this);

                try {
                    let response = await fetch(this.action, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": this.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        if (data.success) {
                            document.getElementById("successModal").classList.remove("hidden");
                            document.getElementById("successModal").classList.add("flex");
                        }
                    } else if (response.status === 422) {
                        const errorData = await response.json();
                        Object.keys(errorData.errors).forEach(field => {
                            const el = document.querySelector(
                                `#registerForm .error-message[data-field="${field}"]`
                            );
                            if (el) el.textContent = errorData.errors[field][0];
                        });
                    } else {
                        alert("Terjadi kesalahan server.");
                    }

                } catch (err) {
                    alert("Gagal menghubungi server. Coba lagi.");
                }
            });

            document.getElementById("goLogin")?.addEventListener("click", function() {
                window.location.href = "/login";
            });

            document.getElementById("gooLogin")?.addEventListener("click", function() {
                window.location.href = "/login";
            });

            // tombol close modal
            function closeModal() {
                document.getElementById("successModal").classList.add("hidden");
                document.getElementById("successModal").classList.remove("flex");
                document.getElementById("successModal_perusahaan").classList.add("hidden");
                document.getElementById("successModal_perusahaan").classList.remove("flex");
            }
        </script> --}}

</body>

</html>
