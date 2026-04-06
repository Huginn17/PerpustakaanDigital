@extends('kepala_perpus.layout.index')
@section('kepala_content')
    <div class="p-6 sm:ml-64 min-h-screen bg-gradient-to-br from-purple-100 via-white to-green-100">
        @php
            $relasiMap = [
                'anggota' => $user->anggota,
                'petugas' => $user->petugas,
                'kepala_perpustakaan' => $user->kepala_perpustakaan,
            ];
            $relasi = $relasiMap[$user->role] ?? null;
        @endphp
    
        <div class="max-w-5xl mx-auto mt-10">

            <!-- PROFILE CARD -->
            <div
                class="bg-gradient-to-r from-purple-500 via-pink-500 to-green-500 p-8 rounded-3xl shadow-xl text-white text-center relative overflow-hidden">

                <!-- glow -->
                <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>

                <div class="relative">
                    <!-- avatar -->
                    <div
                        class="mx-auto w-24 h-24 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold border-4 border-white shadow-lg">
                        {{ strtoupper(substr($user->username, 0, 1)) }}
                    </div>

                    <h2 class="mt-4 text-2xl font-bold">{{ $user->username }}</h2>
                    <p class="text-sm opacity-90">{{ $user->email }}</p>

                    <span class="inline-block mt-3 px-4 py-1 text-xs rounded-full bg-white/20">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </span>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="mt-10 grid md:grid-cols-2 gap-6">

                <!-- LEFT INFO -->
                <div class="space-y-5">

                    <div class="bg-blue-100 p-5 rounded-2xl shadow hover:scale-[1.02] transition">
                        <p class="text-xs text-blue-600">Username</p>
                        <p class="font-semibold text-gray-800">{{ $user->username }}</p>
                    </div>

                    <div class="bg-yellow-100 p-5 rounded-2xl shadow hover:scale-[1.02] transition">
                        <p class="text-xs text-yellow-600">Email</p>
                        <p class="font-semibold text-gray-800">{{ $user->email }}</p>
                    </div>

                </div>

                <!-- RIGHT DETAIL -->
                <div class="bg-white/70 backdrop-blur p-6 rounded-3xl shadow-lg">

                    <h3 class="text-lg font-semibold mb-5 text-gray-700">
                        📄 Informasi Detail
                    </h3>

                    @if ($relasi)
                        <div class="grid grid-cols-2 gap-4">

                            <div class="bg-green-100 p-4 rounded-xl hover:shadow-md transition">
                                <p class="text-xs text-green-600">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $relasi->nama_lengkap }}</p>
                            </div>

                            <div class="bg-pink-100 p-4 rounded-xl hover:shadow-md transition">
                                <p class="text-xs text-pink-600">Nomor Induk</p>
                                <p class="font-semibold text-gray-800">{{ $relasi->nomor_induk }}</p>
                            </div>

                            <div class="bg-purple-100 p-4 rounded-xl hover:shadow-md transition">
                                <p class="text-xs text-purple-600">Jenis Kelamin</p>
                                <p class="font-semibold text-gray-800">{{ $relasi->jenis_kelamin }}</p>
                            </div>

                            <div class="bg-orange-100 p-4 rounded-xl hover:shadow-md transition">
                                <p class="text-xs text-orange-600">Tanggal Lahir</p>
                                <p class="font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($relasi->tanggal_lahir)->format('d M Y') }}
                                </p>
                            </div>

                            <div class="col-span-2 bg-indigo-100 p-4 rounded-xl hover:shadow-md transition">
                                <p class="text-xs text-indigo-600">Alamat</p>
                                <p class="font-semibold text-gray-800">{{ $relasi->alamat }}</p>
                            </div>

                        </div>
                    @else
                        <p class="text-red-500">⚠️ Data tidak tersedia</p>
                    @endif

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 flex justify-center gap-4">

                <a href="{{ route('kepala.pengguna.index') }}"
                    class="px-6 py-2.5 bg-gray-300 hover:bg-gray-400 rounded-xl text-sm transition">
                    ← Kembali
                </a>

                <a href="{{ route('kepala.pengguna.edit', $user->id) }}"
                    class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl shadow hover:scale-105 transition">
                    ✏️ Edit
                </a>

            </div>

        </div>
    </div>
@endsection
