    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - AreaKerja</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>

    <body class="bg-gray-100 min-h-screen flex flex-col">

        <!-- Container -->
        <div class="flex flex-col md:flex-row w-full min-h-screen">

            <!-- Form -->
            <div class="flex w-full md:w-3/5 bg-white items-center justify-center px-6 sm:px-10 py-10">

                <div class="w-full max-w-md mb-24">

                    <!-- Logo -->
                    <div class="flex items-center gap-2 mb-8 md:mb-14">
                        <img src="{{ asset('images/logobuku.png') }}" alt="Logo" class="h-12 w-12">
                        <span class="font-bold mb-1 text-blue-500">perpus</span>
                    </div>

                    <div class="pt-4">
                        <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Buat Akun</h2>
                    </div>

                    <div class="flex justify-center mb-6">
                        <div class="bg-gray-200 rounded-full p-1 flex space-x-1">
                            <div class="bg-blue-500 text-white px-6 py-2 rounded-full text-sm font-semibold">
                                Anggota
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div>
                        <form action="{{ route('registerproses') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 m-2">Nama Pengguna</label>
                                <input type="text" name="username" placeholder="Nama Pengguna"
                                    class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-red-500 text-sm mt-1 error-message" data-field="username"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 m-2">Email</label>
                                <input type="email" name="email" placeholder="E-mail"
                                    class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-red-500 text-sm mt-1 error-message" data-field="email"></p>
                            </div>


                            <div>
                                <label class="block text-sm font-medium text-gray-700 m-2">Kata Sandi</label>
                                <input type="password" name="password" placeholder="Kata Sandi"
                                    class="w-full px-4 py-3 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-red-500 text-sm mt-1 error-message" data-field="password"></p>
                            </div>

                            <input type="hidden" name="role" value="anggota">

                            <button type="submit"
                                class="w-full py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 mt-6">
                                Daftar
                            </button>
                        </form>
                    </div>
                </div>
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

            <section class="relative hidden md:flex md:w-2/5 lg:w-2/4 min:h-screen overflow-hidden">
                <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Background" class="w-full h-full object-cover">
                <div
                    class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center text-center text-white px-6 pb-56">
                    {{-- <h2 class="text-3xl font-semibold mb-4">Hallo, Jobseeker</h2> --}}
                    <p class="mb-6">Untuk tetap terhubung dengan kami, silakan masuk dengan informasi pribadi Anda.
                    </p>
                    <a href="{{ route('HalLogin') }}"
                        class="px-20 py-4 border border-white rounded-full hover:bg-white hover:text-black transition">MASUK</a>
                </div>
            </section>
        </div>

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
